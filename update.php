<?php
/**
 * ============================================================
 *  PANEL AKTUALIZACJI STRONY
 * ============================================================
 *  Umieść ten plik w katalogu głównym strony (tam gdzie index.html).
 *  Otwórz w przeglądarce: https://twoja-domena.pl/update.php
 *
 *  Co potrafi:
 *   - pobiera najnowszą wersję strony z GitHuba i nadpisuje pliki
 *   - przed każdą aktualizacją robi spakowaną kopię zapasową (ZIP)
 *     do folderu _backups (trzymane jest 5 ostatnich kopii)
 *   - pozwala ręcznie utworzyć kopię, przywrócić ją lub usunąć
 *
 *  WAŻNE: przed pierwszym użyciem zmień hasło poniżej!
 * ============================================================
 */

/* ----------------------- KONFIGURACJA ----------------------- */

// Hasło dostępu do panelu - KONIECZNIE ZMIEŃ przed wgraniem na serwer!
define('UPDATE_PASSWORD', 'zmien-to-haslo');

// Repozytorium GitHub i gałąź, z której pobierane są aktualizacje
define('GITHUB_REPO',   'picabela/ewacouch');
define('GITHUB_BRANCH', 'main');

// Folder na kopie zapasowe i maksymalna liczba przechowywanych kopii
define('BACKUP_DIR',  __DIR__ . '/_backups');
define('MAX_BACKUPS', 5);

// Ścieżki, których aktualizacja/przywracanie/kopia NIGDY nie dotyka
$GLOBALS['PROTECTED_PATHS'] = array(
	'_backups',    // folder kopii zapasowych
	'.git',        // repozytorium git (jeśli jest)
	'blog',        // blog (osobna instalacja, nie ma go w repozytorium)
	'update.php',  // ten plik (żeby aktualizacja nie wyzerowała hasła)
);

/* ------------------- KONIEC KONFIGURACJI -------------------- */

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '0');
set_time_limit(300);
session_start();

// zgodność ze starszymi wersjami PHP (przed 7.0)
if (!function_exists('random_bytes')) {
	function random_bytes($len) { return openssl_random_pseudo_bytes($len); }
}
if (!function_exists('hash_equals')) {
	function hash_equals($a, $b) { return (string) $a === (string) $b; }
}

function is_protected_path($relPath) {
	$relPath = ltrim(str_replace('\\', '/', $relPath), '/');
	foreach ($GLOBALS['PROTECTED_PATHS'] as $p) {
		if ($relPath === $p || strpos($relPath, $p . '/') === 0) {
			return true;
		}
	}
	return false;
}

function ensure_backup_dir() {
	if (!is_dir(BACKUP_DIR)) {
		if (!mkdir(BACKUP_DIR, 0755, true)) {
			return 'Nie można utworzyć folderu ' . basename(BACKUP_DIR) . ' - sprawdź uprawnienia.';
		}
	}
	// blokada dostępu z przeglądarki do plików kopii
	if (!file_exists(BACKUP_DIR . '/.htaccess')) {
		file_put_contents(BACKUP_DIR . '/.htaccess', "Require all denied\nDeny from all\n");
	}
	if (!file_exists(BACKUP_DIR . '/index.html')) {
		file_put_contents(BACKUP_DIR . '/index.html', '');
	}
	return true;
}

/** Tworzy kopię zapasową ZIP całej strony (bez ścieżek chronionych). */
function create_backup(&$error) {
	$ok = ensure_backup_dir();
	if ($ok !== true) { $error = $ok; return false; }

	if (!class_exists('ZipArchive')) {
		$error = 'Brak rozszerzenia PHP "zip" na serwerze - skontaktuj się z hostingiem.';
		return false;
	}

	$file = BACKUP_DIR . '/kopia_' . date('Y-m-d_H-i-s') . '.zip';
	$zip  = new ZipArchive();
	if ($zip->open($file, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
		$error = 'Nie można utworzyć pliku kopii zapasowej.';
		return false;
	}

	$root = realpath(__DIR__);
	$iter = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS),
		RecursiveIteratorIterator::SELF_FIRST
	);

	$count = 0;
	foreach ($iter as $item) {
		$rel = str_replace('\\', '/', substr($item->getPathname(), strlen($root) + 1));
		if ($rel === '' || is_protected_path($rel)) { continue; }
		if ($item->isDir()) {
			$zip->addEmptyDir($rel);
		} else {
			$zip->addFile($item->getPathname(), $rel);
			$count++;
		}
	}
	$zip->close();

	if ($count === 0) {
		@unlink($file);
		$error = 'Kopia zapasowa jest pusta - nic nie zostało spakowane.';
		return false;
	}

	rotate_backups();
	return basename($file);
}

/** Usuwa najstarsze kopie ponad limit MAX_BACKUPS. */
function rotate_backups() {
	$files = glob(BACKUP_DIR . '/kopia_*.zip');
	if ($files === false) { return; }
	sort($files); // nazwy zawierają datę, więc sortowanie = chronologia
	while (count($files) > MAX_BACKUPS) {
		@unlink(array_shift($files));
	}
}

function list_backups() {
	if (!is_dir(BACKUP_DIR)) { return array(); }
	$files = glob(BACKUP_DIR . '/kopia_*.zip');
	if ($files === false) { return array(); }
	rsort($files); // najnowsze na górze
	$out = array();
	foreach ($files as $f) {
		$out[] = array(
			'name' => basename($f),
			'size' => filesize($f),
			'time' => filemtime($f),
		);
	}
	return $out;
}

/** Pobiera plik z adresu URL (curl albo file_get_contents). */
function http_download($url, $saveTo = null) {
	if (function_exists('curl_init')) {
		$ch = curl_init($url);
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_MAXREDIRS      => 5,
			CURLOPT_TIMEOUT        => 120,
			CURLOPT_USERAGENT      => 'site-updater',
			CURLOPT_SSL_VERIFYPEER => true,
		));
		$data = curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($data === false || $code >= 400) { return false; }
	} else {
		$ctx = stream_context_create(array('http' => array(
			'timeout'       => 120,
			'user_agent'    => 'site-updater',
			'follow_location' => 1,
		)));
		$data = @file_get_contents($url, false, $ctx);
		if ($data === false) { return false; }
	}
	if ($saveTo !== null) {
		return file_put_contents($saveTo, $data) !== false;
	}
	return $data;
}

/**
 * Rozpakowuje ZIP na stronę.
 * $stripRoot = true dla paczek z GitHuba (mają dodatkowy folder nadrzędny).
 */
function apply_zip($zipPath, $stripRoot, &$error) {
	if (!class_exists('ZipArchive')) {
		$error = 'Brak rozszerzenia PHP "zip" na serwerze.';
		return false;
	}
	$zip = new ZipArchive();
	if ($zip->open($zipPath) !== true) {
		$error = 'Nie można otworzyć pliku ZIP.';
		return false;
	}

	$written = 0;
	for ($i = 0; $i < $zip->numFiles; $i++) {
		$entry = str_replace('\\', '/', $zip->getNameIndex($i));

		if ($stripRoot) {
			$pos = strpos($entry, '/');
			if ($pos === false) { continue; } // sam folder nadrzędny
			$entry = substr($entry, $pos + 1);
		}
		if ($entry === '' || substr($entry, -1) === '/') { // katalog
			$rel = rtrim($entry, '/');
			if ($rel !== '' && !is_protected_path($rel) && strpos($rel, '..') === false) {
				@mkdir(__DIR__ . '/' . $rel, 0755, true);
			}
			continue;
		}
		// bezpieczeństwo: bez wychodzenia poza katalog strony i bez ścieżek chronionych
		if (strpos($entry, '..') !== false || is_protected_path($entry)) { continue; }

		$target = __DIR__ . '/' . $entry;
		$dir = dirname($target);
		if (!is_dir($dir)) { @mkdir($dir, 0755, true); }

		$in = $zip->getStream($zip->getNameIndex($i));
		if ($in === false) { continue; }
		$out = @fopen($target, 'wb');
		if ($out === false) { fclose($in); continue; }
		stream_copy_to_stream($in, $out);
		fclose($in);
		fclose($out);
		$written++;
	}
	$zip->close();

	if ($written === 0) {
		$error = 'Nie zapisano żadnego pliku - paczka może być pusta lub brak uprawnień do zapisu.';
		return false;
	}
	return $written;
}

/** Informacja o najnowszej wersji na GitHubie (commit). */
function remote_version() {
	$json = http_download('https://api.github.com/repos/' . GITHUB_REPO . '/commits/' . GITHUB_BRANCH);
	if ($json === false) { return null; }
	$data = json_decode($json, true);
	if (!is_array($data) || empty($data['sha'])) { return null; }
	return array(
		'sha'     => substr($data['sha'], 0, 7),
		'date'    => isset($data['commit']['author']['date']) ? $data['commit']['author']['date'] : '',
		'message' => isset($data['commit']['message']) ? strtok($data['commit']['message'], "\n") : '',
	);
}

function local_version() {
	$f = __DIR__ . '/.version.json';
	if (!file_exists($f)) { return null; }
	$data = json_decode(file_get_contents($f), true);
	return is_array($data) ? $data : null;
}

function format_size($bytes) {
	if ($bytes >= 1048576) { return number_format($bytes / 1048576, 1, ',', ' ') . ' MB'; }
	if ($bytes >= 1024)    { return number_format($bytes / 1024, 0, ',', ' ') . ' KB'; }
	return $bytes . ' B';
}

function flash($type, $msg) {
	$_SESSION['upd_flash'][] = array($type, $msg);
}

function redirect_self() {
	header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
	exit;
}

/* ----------------------- LOGIKA ----------------------- */

$passwordNotSet = (UPDATE_PASSWORD === 'zmien-to-haslo' || UPDATE_PASSWORD === '');

// logowanie / wylogowanie
if (isset($_POST['do_login']) && !$passwordNotSet) {
	if (hash_equals(UPDATE_PASSWORD, (string) $_POST['password'])) {
		$_SESSION['upd_auth'] = true;
		$_SESSION['upd_csrf'] = bin2hex(random_bytes(16));
	} else {
		sleep(2); // spowolnienie prób zgadywania hasła
		flash('error', 'Nieprawidłowe hasło.');
	}
	redirect_self();
}
if (isset($_POST['do_logout'])) {
	session_destroy();
	redirect_self();
}

$authed = !empty($_SESSION['upd_auth']);

// akcje (tylko po zalogowaniu i z poprawnym tokenem CSRF)
if ($authed && $_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['do_logout'])) {
	$csrfOk = isset($_POST['csrf']) && hash_equals($_SESSION['upd_csrf'], (string) $_POST['csrf']);
	if (!$csrfOk) {
		flash('error', 'Sesja wygasła - spróbuj ponownie.');
		redirect_self();
	}

	// --- ręczna kopia zapasowa ---
	if (isset($_POST['do_backup'])) {
		$err = '';
		$name = create_backup($err);
		if ($name) { flash('ok', 'Utworzono kopię zapasową: ' . $name); }
		else       { flash('error', 'Błąd kopii zapasowej: ' . $err); }
		redirect_self();
	}

	// --- aktualizacja z GitHuba ---
	if (isset($_POST['do_update'])) {
		$err = '';
		$backup = create_backup($err);
		if (!$backup) {
			flash('error', 'Aktualizacja przerwana - nie udało się utworzyć kopii zapasowej: ' . $err);
			redirect_self();
		}
		flash('ok', 'Utworzono kopię zapasową przed aktualizacją: ' . $backup);

		$tmp = BACKUP_DIR . '/tmp_aktualizacja.zip';
		$url = 'https://codeload.github.com/' . GITHUB_REPO . '/zip/refs/heads/' . GITHUB_BRANCH;
		if (!http_download($url, $tmp)) {
			flash('error', 'Nie udało się pobrać nowej wersji z GitHuba. Sprawdź połączenie z internetem na serwerze.');
			redirect_self();
		}

		$written = apply_zip($tmp, true, $err);
		@unlink($tmp);
		if ($written === false) {
			flash('error', 'Błąd podczas rozpakowywania aktualizacji: ' . $err .
				' Możesz przywrócić kopię zapasową ' . $backup . ' poniżej.');
			redirect_self();
		}

		$remote = remote_version();
		file_put_contents(__DIR__ . '/.version.json', json_encode(array(
			'sha'        => $remote ? $remote['sha'] : '',
			'message'    => $remote ? $remote['message'] : '',
			'updated_at' => date('Y-m-d H:i:s'),
		)));

		flash('ok', 'Aktualizacja zakończona - zaktualizowano ' . $written . ' plików.');
		redirect_self();
	}

	// --- przywracanie kopii ---
	if (isset($_POST['do_restore'])) {
		$name = basename((string) $_POST['backup']);
		$file = BACKUP_DIR . '/' . $name;
		if (!preg_match('/^kopia_[\w\-]+\.zip$/', $name) || !file_exists($file)) {
			flash('error', 'Nie znaleziono wskazanej kopii zapasowej.');
			redirect_self();
		}
		$err = '';
		$written = apply_zip($file, false, $err);
		if ($written === false) { flash('error', 'Błąd przywracania: ' . $err); }
		else { flash('ok', 'Przywrócono kopię ' . $name . ' (' . $written . ' plików).'); }
		redirect_self();
	}

	// --- usuwanie kopii ---
	if (isset($_POST['do_delete'])) {
		$name = basename((string) $_POST['backup']);
		$file = BACKUP_DIR . '/' . $name;
		if (preg_match('/^kopia_[\w\-]+\.zip$/', $name) && file_exists($file) && unlink($file)) {
			flash('ok', 'Usunięto kopię ' . $name . '.');
		} else {
			flash('error', 'Nie udało się usunąć kopii.');
		}
		redirect_self();
	}
}

$flashes = isset($_SESSION['upd_flash']) ? $_SESSION['upd_flash'] : array();
unset($_SESSION['upd_flash']);

$backups = $authed ? list_backups() : array();
$local   = $authed ? local_version() : null;
$remote  = $authed ? remote_version() : null;
$csrf    = isset($_SESSION['upd_csrf']) ? $_SESSION['upd_csrf'] : '';

function e($s) { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Panel aktualizacji strony</title>
<style>
	body { font-family: Arial, sans-serif; background: #f2f4f7; margin: 0; padding: 20px; color: #333; }
	.box { max-width: 760px; margin: 0 auto; background: #fff; border-radius: 8px;
	       box-shadow: 0 1px 4px rgba(0,0,0,.15); padding: 25px 30px; }
	h1 { font-size: 22px; margin: 0 0 5px; color: #2c5777; }
	h2 { font-size: 16px; margin: 25px 0 10px; border-bottom: 1px solid #e0e0e0; padding-bottom: 5px; }
	.sub { color: #888; font-size: 13px; margin: 0 0 20px; }
	.msg { padding: 10px 14px; border-radius: 5px; margin: 8px 0; font-size: 14px; }
	.msg.ok { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
	.msg.error { background: #fdecea; color: #c62828; border: 1px solid #ef9a9a; }
	.warn { background: #fff8e1; border: 1px solid #ffe082; color: #8d6e00;
	        padding: 12px 15px; border-radius: 5px; font-size: 14px; }
	table { width: 100%; border-collapse: collapse; font-size: 14px; }
	th, td { text-align: left; padding: 8px 6px; border-bottom: 1px solid #eee; }
	th { color: #777; font-weight: normal; font-size: 12px; text-transform: uppercase; }
	input[type=password] { padding: 8px 10px; border: 1px solid #ccc; border-radius: 4px; width: 220px; }
	button { background: #2c5777; color: #fff; border: 0; border-radius: 4px;
	         padding: 9px 16px; font-size: 14px; cursor: pointer; }
	button:hover { background: #38709a; }
	button.small { padding: 5px 10px; font-size: 12px; }
	button.danger { background: #b23b3b; }
	button.danger:hover { background: #c94f4f; }
	button.gray { background: #888; }
	.actions { display: flex; gap: 10px; flex-wrap: wrap; margin: 10px 0; }
	.ver { font-size: 14px; line-height: 1.7; }
	.ver code { background: #eef2f6; padding: 1px 6px; border-radius: 3px; }
	.logout { float: right; }
	form.inline { display: inline; }
</style>
</head>
<body>
<div class="box">

<?php if ($passwordNotSet): ?>
	<h1>Panel aktualizacji strony</h1>
	<div class="warn">
		<strong>Panel jest zablokowany.</strong><br>
		Przed pierwszym użyciem otwórz plik <code>update.php</code> w edytorze i w linii
		<code>define('UPDATE_PASSWORD', 'zmien-to-haslo');</code> wpisz własne, trudne hasło.
	</div>

<?php elseif (!$authed): ?>
	<h1>Panel aktualizacji strony</h1>
	<p class="sub">Podaj hasło, aby kontynuować.</p>
	<?php foreach ($flashes as $f): ?>
		<div class="msg <?php echo e($f[0]); ?>"><?php echo e($f[1]); ?></div>
	<?php endforeach; ?>
	<form method="post">
		<input type="password" name="password" autofocus>
		<button type="submit" name="do_login" value="1">Zaloguj</button>
	</form>

<?php else: ?>
	<form method="post" class="inline logout">
		<button type="submit" name="do_logout" value="1" class="small gray">Wyloguj</button>
	</form>
	<h1>Panel aktualizacji strony</h1>
	<p class="sub">Repozytorium: <?php echo e(GITHUB_REPO); ?> (gałąź: <?php echo e(GITHUB_BRANCH); ?>)</p>

	<?php foreach ($flashes as $f): ?>
		<div class="msg <?php echo e($f[0]); ?>"><?php echo e($f[1]); ?></div>
	<?php endforeach; ?>

	<h2>Wersja strony</h2>
	<div class="ver">
		<?php if ($local): ?>
			Zainstalowana: <code><?php echo e($local['sha'] ? $local['sha'] : 'nieznana'); ?></code>
			(aktualizacja: <?php echo e($local['updated_at']); ?>)
			<?php if (!empty($local['message'])): ?> - <?php echo e($local['message']); ?><?php endif; ?><br>
		<?php else: ?>
			Zainstalowana: <code>nieznana</code> (jeszcze nie aktualizowano przez ten panel)<br>
		<?php endif; ?>
		<?php if ($remote): ?>
			Najnowsza na GitHubie: <code><?php echo e($remote['sha']); ?></code>
			<?php if ($remote['message']): ?> - <?php echo e($remote['message']); ?><?php endif; ?>
			<?php if ($local && $local['sha'] === $remote['sha']): ?>
				<br><strong style="color:#2e7d32">Strona jest aktualna.</strong>
			<?php elseif ($local): ?>
				<br><strong style="color:#b26a00">Dostępna jest nowsza wersja.</strong>
			<?php endif; ?>
		<?php else: ?>
			Najnowsza na GitHubie: <em>nie udało się sprawdzić</em>
		<?php endif; ?>
	</div>

	<h2>Działania</h2>
	<div class="actions">
		<form method="post" class="inline"
		      onsubmit="return confirm('Pobrać najnowszą wersję z GitHuba?\nNajpierw automatycznie zostanie utworzona kopia zapasowa.');">
			<input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
			<button type="submit" name="do_update" value="1">Aktualizuj z GitHuba</button>
		</form>
		<form method="post" class="inline">
			<input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
			<button type="submit" name="do_backup" value="1" class="gray">Utwórz kopię zapasową</button>
		</form>
	</div>
	<p class="sub">Aktualizacja nie dotyka folderów: <?php echo e(implode(', ', $GLOBALS['PROTECTED_PATHS'])); ?>.</p>

	<h2>Kopie zapasowe (max <?php echo MAX_BACKUPS; ?>)</h2>
	<?php if (!$backups): ?>
		<p class="sub">Brak kopii zapasowych.</p>
	<?php else: ?>
		<table>
			<tr><th>Plik</th><th>Data</th><th>Rozmiar</th><th></th></tr>
			<?php foreach ($backups as $b): ?>
			<tr>
				<td><?php echo e($b['name']); ?></td>
				<td><?php echo date('Y-m-d H:i', $b['time']); ?></td>
				<td><?php echo format_size($b['size']); ?></td>
				<td style="white-space:nowrap; text-align:right;">
					<form method="post" class="inline"
					      onsubmit="return confirm('Przywrócić stronę z kopii <?php echo e($b['name']); ?>?\nObecne pliki zostaną nadpisane.');">
						<input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
						<input type="hidden" name="backup" value="<?php echo e($b['name']); ?>">
						<button type="submit" name="do_restore" value="1" class="small">Przywróć</button>
					</form>
					<form method="post" class="inline"
					      onsubmit="return confirm('Usunąć kopię <?php echo e($b['name']); ?>?');">
						<input type="hidden" name="csrf" value="<?php echo e($csrf); ?>">
						<input type="hidden" name="backup" value="<?php echo e($b['name']); ?>">
						<button type="submit" name="do_delete" value="1" class="small danger">Usuń</button>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
<?php endif; ?>

</div>
</body>
</html>
