<?php
/**
 * Diagnostyka instalacji strony.
 *
 * Otwórz w przeglądarce:  adres-strony/diagnostyka.php
 * Strona sama sprawdzi konfigurację serwera i powie, co ewentualnie naprawić.
 *
 * PO ROZWIĄZANIU PROBLEMU USUŃ TEN PLIK Z SERWERA.
 */

header('X-Robots-Tag: noindex, nofollow');
header('Content-Type: text/html; charset=UTF-8');

$results = array(); // [opis, ok|null, wskazówka przy błędzie]

/* --- 1. Wersja PHP --- */
$phpOk = version_compare(PHP_VERSION, '5.4.0', '>=');
$results[] = array(
    'Wersja PHP: <b>' . PHP_VERSION . '</b>',
    $phpOk,
    'Strona wymaga PHP 5.4 lub nowszego (zalecane 8.x). Zmień wersję PHP w panelu hostingu.'
);

/* --- 2. Czy pliki .htaccess są na serwerze --- */
foreach (array('.htaccess', 'includes/.htaccess', 'templates/.htaccess') as $f) {
    $exists = is_file(__DIR__ . '/' . $f);
    $results[] = array(
        'Plik <b>' . $f . '</b> wgrany na serwer',
        $exists,
        'Plik NIE został wgrany! To najczęstsza przyczyna błędu 404 na podstronach. '
        . 'Pliki zaczynające się od kropki są ukryte - włącz w programie FTP opcję '
        . '"pokaż ukryte pliki" (w FileZilla: Serwer -> Wymuś pokazywanie ukrytych plików) i wgraj go ponownie.'
    );
}

/* --- 3. Czy pliki strony są kompletne --- */
foreach (array('index.php', 'includes/config.php', 'includes/header.php', 'includes/footer.php', 'templates/pl/omnie.php') as $f) {
    $exists = is_file(__DIR__ . '/' . $f);
    $results[] = array(
        'Plik <b>' . $f . '</b> wgrany na serwer',
        $exists,
        'Brakuje pliku - wgraj ponownie wszystkie pliki i katalogi strony.'
    );
}

/* --- 4. Oprogramowanie serwera --- */
$server = isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '(nieznane)';
$isApacheLike = (stripos($server, 'apache') !== false || stripos($server, 'litespeed') !== false);
$results[] = array(
    'Serwer WWW: <b>' . htmlspecialchars($server, ENT_QUOTES, 'UTF-8') . '</b>',
    $isApacheLike ? true : null,
    'Serwer nie wygląda na Apache/LiteSpeed. Jeśli to czysty nginx, pliki .htaccess są ignorowane '
    . 'i przyjazne adresy trzeba skonfigurować w panelu hostingu lub u administratora.'
);

/* --- 5. Wykrywanie ścieżki instalacji (ta sama logika co w includes/config.php) --- */
define('EW_SITE', true);
$configOk = true;
$configError = '';
try {
    require __DIR__ . '/includes/config.php';
} catch (Throwable $e) {
    $configOk = false;
    $configError = $e->getMessage();
} catch (Exception $e) {
    $configOk = false;
    $configError = $e->getMessage();
}
$results[] = array(
    'Konfiguracja strony (includes/config.php) wczytuje się poprawnie',
    $configOk,
    'Błąd podczas wczytywania konfiguracji: ' . htmlspecialchars($configError, ENT_QUOTES, 'UTF-8')
);

if ($configOk) {
    $results[] = array(
        'Wykryty podkatalog instalacji (BASE_PATH): <b>' . (BASE_PATH === '' ? '(katalog główny domeny)' : htmlspecialchars(BASE_PATH, ENT_QUOTES, 'UTF-8')) . '</b>'
        . '<br><small>DOCUMENT_ROOT: ' . htmlspecialchars(isset($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '(brak)', ENT_QUOTES, 'UTF-8')
        . ' &nbsp;|&nbsp; katalog strony: ' . htmlspecialchars(__DIR__, ENT_QUOTES, 'UTF-8')
        . ' &nbsp;|&nbsp; SCRIPT_NAME: ' . htmlspecialchars(isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '(brak)', ENT_QUOTES, 'UTF-8') . '</small>',
        null,
        ''
    );
    $exampleUrl = page_url('pl', 'omnie');
    $results[] = array(
        'Przykładowy adres podstrony generowany przez stronę: <b><a href="' . e($exampleUrl) . '">' . e($exampleUrl) . '</a></b>'
        . '<br><small>Jeśli ten link daje błąd 404, a test przepisywania adresów poniżej wypada poprawnie, ścieżka jest źle wykryta - wpisz ją ręcznie w includes/config.php (BASE_PATH).</small>',
        null,
        ''
    );
}

/* --- 6. Test mod_rewrite (kliknięcie w link) --- */
$rewriteTested = isset($_GET['rewrite']) && $_GET['rewrite'] === 'ok';

?><!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="robots" content="noindex, nofollow">
<title>Diagnostyka instalacji</title>
<style>
body{font-family:Arial,sans-serif;max-width:900px;margin:30px auto;padding:0 15px;color:#333}
h1{font-size:22px} h2{font-size:17px;margin-top:30px}
.item{padding:9px 12px;margin:6px 0;border-radius:4px;border:1px solid #ddd}
.ok{background:#e8f7e8;border-color:#b6dfb6} .bad{background:#fdeaea;border-color:#f0b9b9}
.info{background:#f4f4f4}
.hint{margin-top:6px;font-size:14px;color:#a33}
.big{display:inline-block;margin:8px 0;padding:10px 18px;background:#75a3c9;color:#fff;border-radius:4px;text-decoration:none}
.badge{font-weight:bold;margin-right:8px}
small{color:#666}
</style>
</head>
<body>
<h1>Diagnostyka instalacji strony</h1>
<p>Po rozwiązaniu problemu <b>usuń plik diagnostyka.php z serwera</b>.</p>

<h2>1. Testy automatyczne</h2>
<?php foreach ($results as $r): list($label, $ok, $hint) = $r; ?>
    <div class="item <?php echo $ok === null ? 'info' : ($ok ? 'ok' : 'bad'); ?>">
        <span class="badge"><?php echo $ok === null ? 'ℹ' : ($ok ? '✔' : '✘'); ?></span> <?php echo $label; ?>
        <?php if ($ok === false && $hint !== ''): ?><div class="hint"><?php echo $hint; ?></div><?php endif; ?>
        <?php if ($ok === null && $hint !== ''): ?><div class="hint" style="color:#666"><?php echo $hint; ?></div><?php endif; ?>
    </div>
<?php endforeach; ?>

<h2>2. Test przepisywania adresów (.htaccess + mod_rewrite)</h2>
<?php if ($rewriteTested): ?>
    <div class="item ok"><span class="badge">✔</span> <b>Przepisywanie adresów DZIAŁA.</b>
    Ten adres (<code>test-rewrite</code>) został poprawnie przepisany przez .htaccess na plik PHP.
    Jeśli podstrony nadal pokazują 404, problemem jest wykrywanie ścieżki - sprawdź sekcję BASE_PATH powyżej.</div>
<?php else: ?>
    <p>Kliknij poniższy przycisk:</p>
    <p><a class="big" href="test-rewrite">Uruchom test przepisywania adresów</a></p>
    <div class="item info">
        <b>Jeśli po kliknięciu wróci ta strona z zielonym komunikatem</b> - przepisywanie działa.<br>
        <b>Jeśli zobaczysz błąd 404</b> - serwer nie wykonuje reguł z pliku .htaccess. Przyczyny:
        <ul>
            <li>plik <code>.htaccess</code> nie został wgrany (patrz test powyżej),</li>
            <li>hosting ma wyłączoną obsługę .htaccess (opcja <code>AllowOverride</code>) - do włączenia w panelu hostingu lub przez pomoc techniczną,</li>
            <li>serwer nie ma modułu <code>mod_rewrite</code> - napisz do pomocy technicznej hostingu.</li>
        </ul>
    </div>
<?php endif; ?>

</body>
</html>
