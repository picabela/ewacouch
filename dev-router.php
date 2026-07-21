<?php
/**
 * Router do lokalnego testowania bez Apache (odwzorowuje reguly .htaccess):
 *   php -S localhost:8080 dev-router.php
 * Na serwerze produkcyjnym ten plik nie jest uzywany.
 */

/* Wbudowany serwer PHP startuje z katalogu strony, wiec bez podkatalogu */
define('BASE_PATH', '');

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/* sitemap.xml -> generator */
if ($path === '/sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    return true;
}

/* test przepisywania adresow -> diagnostyka */
if ($path === '/test-rewrite') {
    $_GET['rewrite'] = 'ok';
    require __DIR__ . '/diagnostyka.php';
    return true;
}

/* przekierowania ze starych adresow .html */
if (preg_match('#^(.*/)index\.html$#', $path, $m)) {
    header('Location: ' . $m[1], true, 301);
    return true;
}
if (preg_match('#\.html$#', $path)) {
    header('Location: ' . preg_replace('#\.html$#', '', $path), true, 301);
    return true;
}

/* blokada katalogow wewnetrznych */
if (preg_match('#^/(includes|templates)(/|$)#', $path)) {
    http_response_code(404);
    require __DIR__ . '/index.php';
    return true;
}

/* istniejace pliki statyczne serwuje wbudowany serwer */
$file = __DIR__ . $path;
if ($path !== '/' && is_file($file) && !preg_match('#/index\.php$#', $path)) {
    return false;
}

/* katalogi jezykowe i przyjazne adresy -> front controller */
require __DIR__ . '/index.php';
return true;
