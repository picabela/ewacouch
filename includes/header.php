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

/* Dane strukturalne schema.org (JSON-LD) */
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'     => 'ProfessionalService',
            '@id'       => BASE_URL . '/#business',
            'name'      => 'Ewa Wędrychowska - coaching kariery, doradztwo zawodowe',
            'url'       => BASE_URL . '/',
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
                '@id'      => BASE_URL . '/#person',
                'name'     => $contact['name'],
                'jobTitle' => 'Coach kariery, doradca zawodowy',
                'sameAs'   => [$contact['facebook'], $contact['linkedin']],
            ],
        ],
        [
            '@type'      => 'WebSite',
            '@id'        => BASE_URL . '/#website',
            'url'        => BASE_URL . '/',
            'name'       => 'Ewa Wędrychowska - coaching',
            'publisher'  => ['@id' => BASE_URL . '/#business'],
        ],
        [
            '@type'       => 'WebPage',
            'url'         => $canonical,
            'name'        => $page['title'],
            'description' => $page['description'],
            'inLanguage'  => $langCfg['html_lang'],
            'isPartOf'    => ['@id' => BASE_URL . '/#website'],
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
    <link rel="stylesheet" type="text/css" href="<?= e($assetBase) ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= e($assetBase) ?>css/style.css">
    <meta name="description" content="<?= e($page['description']) ?>">
    <title><?= e($page['title']) ?></title>
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
    <script type="text/javascript" src="/whcookies.js"></script>
<?php endif; ?>
<?php if (!empty($page['contact_form'])): ?>
    <style type="text/css" media="screen" charset="utf-8">
	@import url("<?= e($assetBase) ?>ajax_email/style.css");
</style>
    <script type="text/javascript" src="<?= e($assetBase) ?>ajax_email/mootools.js"></script>
    <script type="text/javascript">
		window.addEvent('domready', function(){
			$('myForm').addEvent('submit', function(e) {

			new Event(e).stop();
			var log = $('log_res').empty().addClass('ajax-loading');
			this.send({
				update: log,
				onComplete: function() {
					log.removeClass('ajax-loading');
				}
			});
			});
		});
	</script>
<?php endif; ?>
<?php if ($page['ga'] ?? true): ?>
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

                              <h3>  Ewa Wędrychowska</h3>

                               <h2> <?= $langCfg['h2'] ?></h2>

                                    <nav id="nav">
      <ul>
<?php foreach ($langCfg['nav'] as [$navSlug, $navLabel, $navTitle]):
        $isExternal = $navSlug[0] === '/';
        $href       = $isExternal ? $navSlug : page_url($lang, $navSlug);
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
            $altSlug = $page['alt'][$flagLang] ?? null;
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
