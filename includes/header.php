<?php
/**
 * Wspólny nagłówek strony: <head> (SEO, skrypty) + sidebar z menu i flagami.
 * Wymaga zmiennych ustawianych przez index.php: $lang, $slug, $page, $langCfg, $assetBase.
 */

if (!defined('EW_SITE')) {
    http_response_code(404);
    exit;
}

$isHome     = !empty($page['home']);
$navTag     = $isHome ? 'aside' : 'div';
$canonical  = absolute_url($lang, $slug);
$alternates = page_alternates($lang, $slug);
$siteUrl    = BASE_URL . BASE_PATH . '/';

/* Dane strukturalne schema.org (JSON-LD) */
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'     => 'ProfessionalService',
            '@id'       => $siteUrl . '#business',
            'name'      => $langCfg['business_name'],
            'url'       => $siteUrl,
            'telephone' => $contact['phone'],
            'email'     => $contact['email'],
            'address'   => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => $contact['street'],
                'postalCode'      => $contact['postcode'],
                'addressLocality' => $contact['city'],
                'addressCountry'  => 'PL',
            ],
            'sameAs'    => [$contact['facebook'], $contact['linkedin']],
            'founder'   => [
                '@type'    => 'Person',
                '@id'      => $siteUrl . '#person',
                'name'     => $contact['name'],
                'jobTitle' => $langCfg['job_title'],
                'sameAs'   => [$contact['facebook'], $contact['linkedin']],
            ],
        ],
        [
            '@type'      => 'WebSite',
            '@id'        => $siteUrl . '#website',
            'url'        => $siteUrl,
            'name'       => 'Ewa Wędrychowska - coaching',
            'publisher'  => ['@id' => $siteUrl . '#business'],
        ],
        [
            '@type'       => 'WebPage',
            'url'         => $canonical,
            'name'        => $page['title'],
            'description' => $page['description'],
            'inLanguage'  => $langCfg['html_lang'],
            'isPartOf'    => ['@id' => $siteUrl . '#website'],
        ],
    ],
];
if (!$isHome && empty($page['noindex'])) {
    $jsonLd['@graph'][] = [
        '@type'           => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Ewa Wędrychowska', 'item' => BASE_URL . page_url($lang, 'index')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $page['title'], 'item' => $canonical],
        ],
    ];
}
?>
<!DOCTYPE html>
<html lang="<?= e($langCfg['html_lang']) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Lora&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?= e($assetBase) ?>css/bootstrap.css?v=<?= ASSET_VERSION ?>">
    <link rel="stylesheet" type="text/css" href="<?= e($assetBase) ?>css/style.css?v=<?= ASSET_VERSION ?>">
    <meta name="description" content="<?= e($page['description']) ?>">
    <title><?= e($page['title']) ?></title>
    <link rel="icon" type="image/png" href="<?= e(BASE_PATH) ?>/favicon.png">
    <link rel="shortcut icon" type="image/png" href="<?= e(BASE_PATH) ?>/favicon.png">
<?php if (!empty($page['noindex'])): ?>
    <meta name="robots" content="noindex, nofollow">
<?php else: ?>
    <link rel="canonical" href="<?= e($canonical) ?>">
<?php endif; ?>
<?php foreach ($alternates as $altLang => $altSlug): ?>
    <link rel="alternate" hreflang="<?= e($languages[$altLang]['html_lang']) ?>" href="<?= e(absolute_url($altLang, $altSlug)) ?>">
<?php endforeach; ?>
<?php if ($alternates): ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(absolute_url('pl', $alternates['pl'])) ?>">
<?php endif; ?>
<?php if (!empty($page['cookies'])): ?>
    <script type="text/javascript" src="<?= e(BASE_PATH) ?>/whcookies.js?v=<?= ASSET_VERSION ?>"></script>
<?php endif; ?>
<?php if (!empty($page['contact_form'])): ?>
    <style type="text/css" media="screen" charset="utf-8">
	@import url("<?= e($assetBase) ?>ajax_email/style.css?v=<?= ASSET_VERSION ?>");
</style>
    <script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function () {
			var form = document.getElementById('myForm');
			if (!form) return;
			form.addEventListener('submit', function (e) {
				e.preventDefault();
				var log = document.getElementById('log_res');
				var btn = form.querySelector('.submit');
				log.innerHTML = '';
				log.className = 'ajax-loading';
				btn.disabled = true;
				fetch(form.getAttribute('action'), { method: 'POST', body: new FormData(form) })
					.then(function (r) { return r.text(); })
					.then(function (html) {
						log.innerHTML = html;
						if (html.indexOf('form-ok') !== -1) form.reset();
					})
					.catch(function () {
						log.innerHTML = '<p class="form-error">' + <?= json_encode($langCfg['form_error'], JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT) ?> + '</p>';
					})
					.then(function () { log.className = ''; btn.disabled = false; });
			});
		});
	</script>
<?php endif; ?>
<?php if (!isset($page['ga']) || $page['ga']): ?>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?= GA_ID ?>', 'auto');
  ga('send', 'pageview');

</script>
<?php endif; ?>
    <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>

<body>
    <div class="main-body">
        <div class="container">
            <div class="row">
                <div class="main-page">

                    <<?= $navTag ?> class="main-navigation">

                                <div class="block-keep-ratio block-keep-ratio-2-1 block-width-full home">
                                    <a title="coaching Małopolska" href="<?= e(page_url($lang, 'index')) ?>" class="block-keep-ratio__content  main-menu-link">

                                    </a>
                                </div>

<?php if ($isHome): ?>
                              <h1 class="brand-name">  Ewa Wędrychowska</h1>

                               <p class="brand-tagline"> <?= $langCfg['h2'] ?></p>
<?php else: ?>
                              <p class="brand-name">  Ewa Wędrychowska</p>

                               <p class="brand-tagline"> <?= $langCfg['h2'] ?></p>
<?php endif; ?>

                                    <nav id="nav">
      <ul>
<?php foreach ($langCfg['nav'] as $navItem):
        list($navSlug, $navLabel, $navTitle) = $navItem;
        $isExternal = $navSlug[0] === '/';
        $href       = $isExternal ? BASE_PATH . $navSlug : page_url($lang, $navSlug);
        $titleAttr  = $navTitle !== null ? ' title="' . e($navTitle) . '"' : '';
        $activeAttr = (!$isExternal && $navSlug === $slug) ? ' class="active"' : '';
        $label      = $langCfg['nav_span'] ? '<span>' . e($navLabel) . '</span>' : e($navLabel);
?>
        <li><a<?= $titleAttr ?> href="<?= e($href) ?>"<?= $activeAttr ?>><?= $label ?></a></li>
<?php endforeach; ?>
      </ul>
    </nav>
      <div class="flagi">
<?php
    /* Przełącznik języków: bieżący język jako tekst, pozostałe jako linki */
    $flags = [];
    foreach ($languages as $flagLang => $flagCfg) {
        $flagLabel = strtoupper($flagLang === 'pl' ? 'PL' : ($flagLang === 'en' ? 'EN' : 'FR'));
        if ($flagLang === $lang) {
            $flags[] = $flagLabel;
        } else {
            $altSlug = isset($page['alt'][$flagLang]) ? $page['alt'][$flagLang] : null;
            $flagHref = $altSlug !== null ? page_url($flagLang, $altSlug) : '#';
            $flags[] = '<a href="' . e($flagHref) . '">' . $flagLabel . '</a>';
        }
    }
    echo '                           ' . implode(' &nbsp;  &nbsp; ', $flags);
?>
                             </div>

                    </<?= $navTag ?>> <!-- main-navigation -->

                    <div class="content-main">
                        <div class="row margin-b-30">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
