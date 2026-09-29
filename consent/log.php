<?php
/**
 * Rejestr zgód cookies - dowód wyrażenia zgody (art. 7 ust. 1 RODO).
 *
 * consent.js wysyła tu (sendBeacon) każdy zapisany wybór. Wpisy trafiają do
 * plików CSV _backups/zgody/zgody-RRRR-MM.csv:
 *  - folder _backups jest na stałe chroniony w update.php (aktualizacje ani
 *    przywracanie kopii go nie usuwają),
 *  - dostęp z przeglądarki jest zablokowany (.htaccess) - pliki pobiera się przez FTP.
 * Zapisywane są: data, identyfikator zgody, wybór, adres podstrony,
 * skrócony (zanonimizowany) adres IP i przeglądarka. Wpisy starsze niż
 * KEEP_MONTHS miesięcy są usuwane automatycznie.
 *
 * Kod zgodny z PHP 5.4+.
 */

define('LOG_DIR', dirname(__DIR__) . '/_backups/zgody');
define('KEEP_MONTHS', 24);
define('MAX_FILE_BYTES', 10 * 1024 * 1024);

header('Content-Type: text/plain; charset=utf-8');
header('X-Robots-Tag: noindex');

function done($code) {
	http_response_code($code);
	exit;
}

if (!isset($_SERVER['REQUEST_METHOD']) || strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
	done(405);
}

/* Tylko żądania z tej samej domeny (strona i blog). */
$host = isset($_SERVER['HTTP_HOST']) ? strtolower(preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'])) : '';
foreach (array('HTTP_ORIGIN', 'HTTP_REFERER') as $h) {
	if (!empty($_SERVER[$h])) {
		$refHost = strtolower((string) parse_url($_SERVER[$h], PHP_URL_HOST));
		if ($refHost !== '' && $refHost !== $host) {
			done(403);
		}
	}
}

$id     = isset($_POST['id']) ? (string) $_POST['id'] : '';
$ver    = isset($_POST['v']) ? (string) $_POST['v'] : '';
$action = isset($_POST['a']) ? (string) $_POST['a'] : '';
$lang   = isset($_POST['l']) ? (string) $_POST['l'] : '';
$url    = isset($_POST['u']) ? (string) $_POST['u'] : '';

if (!preg_match('/^[a-f0-9]{8}-[a-f0-9]{8}-[a-f0-9]{8}$/', $id)
	|| !preg_match('/^\d{1,4}$/', $ver)
	|| !in_array($action, array('accept', 'reject', 'custom', 'withdraw'), true)
	|| !in_array($lang, array('pl', 'en', 'fr'), true)) {
	done(400);
}
$flags = array();
foreach (array('p', 's', 'm') as $k) {
	$v = isset($_POST[$k]) ? (string) $_POST[$k] : '';
	if ($v !== '0' && $v !== '1') {
		done(400);
	}
	$flags[$k] = $v;
}
$url = substr(preg_replace('/[^\w\-\/\.%~]/', '', $url), 0, 200);

/* IP skrócone: IPv4 bez ostatniego oktetu, IPv6 - tylko pierwsze 3 bloki. */
$ip = '';
foreach (array('HTTP_CF_CONNECTING_IP', 'REMOTE_ADDR') as $h) {
	if (!empty($_SERVER[$h]) && filter_var($_SERVER[$h], FILTER_VALIDATE_IP)) {
		$ip = $_SERVER[$h];
		break;
	}
}
if (strpos($ip, ':') !== false) {
	$ip = implode(':', array_slice(explode(':', $ip), 0, 3)) . '::';
} elseif ($ip !== '') {
	$ip = preg_replace('/\.\d+$/', '.0', $ip);
}
$ua = isset($_SERVER['HTTP_USER_AGENT']) ? substr(str_replace(array("\r", "\n", '"'), ' ', $_SERVER['HTTP_USER_AGENT']), 0, 250) : '';

/* Folder dziennika + blokada dostępu z sieci. */
if (!is_dir(LOG_DIR) && !@mkdir(LOG_DIR, 0755, true)) {
	done(500);
}
foreach (array(dirname(LOG_DIR), LOG_DIR) as $dir) {
	if (!file_exists($dir . '/.htaccess')) {
		@file_put_contents($dir . '/.htaccess', "Require all denied\nDeny from all\n");
	}
}

$file = LOG_DIR . '/zgody-' . date('Y-m') . '.csv';
if (file_exists($file) && filesize($file) > MAX_FILE_BYTES) {
	done(507);
}
$isNew = !file_exists($file);

$row = array(
	date('c'), $id, $ver, $action,
	$flags['p'], $flags['s'], $flags['m'],
	$lang, $url, $ip, $ua,
);
$fh = @fopen($file, 'ab');
if (!$fh) {
	done(500);
}
if (flock($fh, LOCK_EX)) {
	if ($isNew) {
		fputcsv($fh, array('data', 'id_zgody', 'wersja', 'akcja', 'preferencje', 'statystyczne', 'marketingowe', 'jezyk', 'podstrona', 'ip_skrocone', 'przegladarka'), ';');
	}
	fputcsv($fh, $row, ';');
	flock($fh, LOCK_UN);
}
fclose($fh);

/* Sprzątanie: usuń pliki starsze niż KEEP_MONTHS (raz na nowy miesiąc). */
if ($isNew) {
	$limit = date('Y-m', strtotime('-' . KEEP_MONTHS . ' months'));
	foreach ((array) glob(LOG_DIR . '/zgody-*.csv') as $old) {
		if (preg_match('/zgody-(\d{4}-\d{2})\.csv$/', $old, $m) && $m[1] < $limit) {
			@unlink($old);
		}
	}
}

done(204);
