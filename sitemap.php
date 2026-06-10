<?php
/**
 * Dynamiczna mapa strony (sitemap.xml).
 * Generowana z rejestru podstron w includes/config.php - po dodaniu
 * nowej podstrony sitemap aktualizuje sie automatycznie.
 * Adres /sitemap.xml jest przepisywany na ten plik w .htaccess.
 */

define('EW_SITE', true);

require __DIR__ . '/includes/config.php';

header('Content-Type: application/xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($pages as $lang => $langPages): ?>
<?php foreach ($langPages as $slug => $page):
    if (!empty($page['noindex'])) {
        continue;
    }
    $template = __DIR__ . '/templates/' . $lang . '/' . $slug . '.php';
    $lastmod  = is_file($template) ? date('Y-m-d', filemtime($template)) : date('Y-m-d');
    $isHome   = !empty($page['home']);
?>
    <url>
        <loc><?= e(absolute_url($lang, $slug)) ?></loc>
        <lastmod><?= $lastmod ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority><?= $isHome ? '1.0' : '0.8' ?></priority>
<?php foreach (page_alternates($lang, $slug) as $altLang => $altSlug): ?>
        <xhtml:link rel="alternate" hreflang="<?= e($languages[$altLang]['html_lang']) ?>" href="<?= e(absolute_url($altLang, $altSlug)) ?>"/>
<?php endforeach; ?>
    </url>
<?php endforeach; ?>
<?php endforeach; ?>
</urlset>
