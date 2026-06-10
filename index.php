<?php
/**
 * Front controller - wszystkie przyjazne adresy URL trafiają tutaj
 * (przekierowuje je .htaccess). Na podstawie adresu wybiera język
 * i podstronę, po czym składa stronę z nagłówka, szablonu treści i stopki.
 */

define('EW_SITE', true);

require __DIR__ . '/includes/config.php';

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path = rawurldecode($path);

/* Bezpośrednie wejście na index.php -> strona główna */
if (preg_match('#^(/(?:eng|fr))?/index\.php$#', $path, $m)) {
    header('Location: ' . ($m[1] ?? '') . '/', true, 301);
    exit;
}

/* Adresy z ukośnikiem na końcu (poza katalogami językowymi) -> wersja bez ukośnika */
if ($path !== '/' && substr($path, -1) === '/' && !preg_match('#^/(eng|fr)/$#', $path)) {
    header('Location: ' . rtrim($path, '/'), true, 301);
    exit;
}

/* Rozpoznanie języka i podstrony, np. /eng/omnie -> en + omnie */
$segments = array_values(array_filter(explode('/', trim($path, '/')), 'strlen'));

$lang = 'pl';
if (isset($segments[0]) && in_array($segments[0], ['eng', 'fr'], true)) {
    $lang = $segments[0] === 'eng' ? 'en' : 'fr';
    array_shift($segments);
}

$slug = $segments[0] ?? 'index';

/* Nieznany adres lub zagnieżdżona ścieżka -> strona 404 */
if (count($segments) > 1 || !isset($pages[$lang][$slug]) || $slug === '404') {
    http_response_code(404);
    $slug = '404';
}

$page      = $pages[$lang][$slug];
$langCfg   = $languages[$lang];
$assetBase = $langCfg['asset_base'];

$template = $slug === '404'
    ? __DIR__ . '/templates/404.php'
    : __DIR__ . '/templates/' . $lang . '/' . $slug . '.php';

require __DIR__ . '/includes/header.php';
require $template;
require __DIR__ . '/includes/footer.php';
