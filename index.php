<?php
/**
 * Front controller - wszystkie przyjazne adresy URL trafiają tutaj
 * (przekierowuje je .htaccess). Na podstawie adresu wybiera język
 * i podstronę, po czym składa stronę z nagłówka, szablonu treści i stopki.
 */

define('EW_SITE', true);

require __DIR__ . '/includes/config.php';

$path = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/', PHP_URL_PATH);
$path = rawurldecode($path);

/* Ścieżka względem katalogu instalacji (strona może być w podkatalogu) */
$rel = $path;
if (BASE_PATH !== '' && strpos($path, BASE_PATH) === 0) {
    $rel = substr($path, strlen(BASE_PATH));
}
if ($rel === '') {
    $rel = '/';
}

/* Bezpośrednie wejście na index.php -> katalog */
if (preg_match('#^(.*/)index\.php$#', $rel, $m)) {
    header('Location: ' . BASE_PATH . $m[1], true, 301);
    exit;
}

/* Adresy z ukośnikiem na końcu (poza katalogami językowymi) -> wersja bez ukośnika */
if ($rel !== '/' && substr($rel, -1) === '/' && !preg_match('#^/(eng|fr)/$#', $rel)) {
    header('Location: ' . BASE_PATH . rtrim($rel, '/'), true, 301);
    exit;
}

/* Rozpoznanie języka i podstrony, np. /eng/omnie -> en + omnie */
$segments = array_values(array_filter(explode('/', trim($rel, '/')), 'strlen'));

$lang = 'pl';
if (isset($segments[0]) && in_array($segments[0], ['eng', 'fr'], true)) {
    $lang = $segments[0] === 'eng' ? 'en' : 'fr';
    array_shift($segments);
}

$slug = isset($segments[0]) ? $segments[0] : 'index';

/* Nieznany adres lub zagnieżdżona ścieżka -> strona 404 */
if (count($segments) > 1 || !isset($pages[$lang][$slug]) || $slug === '404') {
    http_response_code(404);
    $slug = '404';
}

$page      = $pages[$lang][$slug];
$langCfg   = $languages[$lang];
$assetBase = asset_base($lang);

$template = $slug === '404'
    ? __DIR__ . '/templates/404.php'
    : __DIR__ . '/templates/' . $lang . '/' . $slug . '.php';

require __DIR__ . '/includes/header.php';
require $template;
require __DIR__ . '/includes/footer.php';
