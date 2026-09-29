<?php
/**
 * Plugin Name: EW Zgody Cookies (Consent Mode v2)
 * Description: Okno zgód cookies i Google Consent Mode v2 wspólne ze stroną główną ewedrychowska-coaching.pl. Baner, wygląd i wykaz cookies są wczytywane ze strony głównej, więc blog zawsze ma tę samą wersję, a zgoda wyrażona na stronie obowiązuje też na blogu (i odwrotnie).
 * Version: 1.0.0
 * Author: Ewa Wędrychowska
 * Requires at least: 4.7
 * Requires PHP: 5.4
 * License: GPL-2.0-or-later
 * Text Domain: ew-zgody-cookies
 */

if (!defined('ABSPATH')) {
	exit;
}

define('EWC_PLUGIN_VERSION', '1.0.0');
define('EWC_PLUGIN_DIR', dirname(__FILE__));

/* Adresy polityki prywatności na stronie głównej (ścieżki względem domeny). */
function ewc_policy_paths() {
	return array(
		'pl' => '/polityka-prywatnosci',
		'en' => '/eng/privacy-policy',
		'fr' => '/fr/politique-de-confidentialite',
	);
}

/* ------------------------------------------------------------------
 * Ustawienia
 * ------------------------------------------------------------------ */

function ewc_defaults() {
	return array(
		'site_url'   => '',              // puste = domena bloga, np. https://ewedrychowska-coaching.pl
		'gtm_id'     => 'GTM-TMX8NZXM',  // puste = nie wstawiaj GTM
		'lang'       => 'auto',
		'policy_url' => '',              // puste = polityka na stronie głównej w języku bloga
		'log'        => '1',
	);
}

function ewc_settings() {
	$saved = get_option('ewc_settings', array());
	return wp_parse_args(is_array($saved) ? $saved : array(), ewc_defaults());
}

/** Adres strony głównej (protokół + domena), z której wczytywany jest skrypt zgód. */
function ewc_site_url() {
	$s = ewc_settings();
	if ($s['site_url'] !== '') {
		return untrailingslashit($s['site_url']);
	}
	$p = wp_parse_url(home_url('/'));
	$url = (isset($p['scheme']) ? $p['scheme'] : 'https') . '://' . (isset($p['host']) ? $p['host'] : '');
	if (isset($p['port'])) {
		$url .= ':' . $p['port'];
	}
	return $url;
}

function ewc_lang() {
	$s = ewc_settings();
	$lang = $s['lang'] !== 'auto' ? $s['lang'] : substr(get_locale(), 0, 2);
	return in_array($lang, array('pl', 'en', 'fr'), true) ? $lang : 'pl';
}

function ewc_policy_url() {
	$s = ewc_settings();
	if ($s['policy_url'] !== '') {
		return $s['policy_url'];
	}
	$paths = ewc_policy_paths();
	return ewc_site_url() . $paths[ewc_lang()];
}

function ewc_gtm_id() {
	$s = ewc_settings();
	$id = strtoupper(trim($s['gtm_id']));
	return preg_match('/^GTM-[A-Z0-9]+$/', $id) ? $id : '';
}

/**
 * Pliki strony głównej na tym samym serwerze (blog leży zwykle w podkatalogu
 * /blog strony). Jeśli są dostępne, wtyczka czyta z nich kod inicjalizacji
 * i datę zmiany skryptu - dzięki temu po aktualizacji strony blog od razu
 * dostaje nową wersję (bez starej kopii w pamięci przeglądarki).
 */
function ewc_main_site_file($name) {
	$f = dirname(untrailingslashit(ABSPATH)) . '/consent/' . $name;
	return is_readable($f) ? $f : '';
}

/* ------------------------------------------------------------------
 * Wstawienie kodu na stronę bloga
 * ------------------------------------------------------------------ */

/**
 * Kod Consent Mode musi być w <head> PRZED Google Tag Managerem. Motyw bloga
 * ma GTM wpisany na sztywno zaraz po <head>, więc zwykłe wp_head byłoby za
 * późno - dlatego kod jest dopisywany bezpośrednio za znacznikiem <head>.
 */
add_action('template_redirect', 'ewc_start_buffer', 0);
function ewc_start_buffer() {
	if (is_admin() || is_feed() || is_robots() || is_trackback() || (defined('DOING_AJAX') && DOING_AJAX)) {
		return;
	}
	ob_start('ewc_filter_html');
}

function ewc_init_js() {
	$file = ewc_main_site_file('consent-init.js');
	if ($file === '') {
		$file = EWC_PLUGIN_DIR . '/consent-init.js';
	}
	$js = (string) @file_get_contents($file);
	return trim(preg_replace('#/\*.*?\*/#s', '', $js));
}

function ewc_gtm_head($id) {
	return "<!-- Google Tag Manager -->\n<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':\n"
		. "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],\n"
		. "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=\n"
		. "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);\n"
		. "})(window,document,'script','dataLayer','" . $id . "');</script>\n<!-- End Google Tag Manager -->";
}

function ewc_gtm_body($id) {
	return '<!-- Google Tag Manager (noscript) --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id='
		. esc_attr($id) . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
}

function ewc_filter_html($html) {
	if (stripos($html, '<head') === false || strpos($html, 'id="ewc-init"') !== false) {
		return $html;
	}
	$head = '<script id="ewc-init">' . ewc_init_js() . '</script>';

	/* GTM dodajemy tylko, jeśli motyw/inna wtyczka jeszcze go nie wstawiła. */
	$gtm = ewc_gtm_id();
	$addGtm = $gtm !== '' && strpos($html, $gtm) === false;
	if ($addGtm) {
		$head .= "\n" . ewc_gtm_head($gtm);
	}

	$html = preg_replace_callback('/<head\b[^>]*>/i', function ($m) use ($head) {
		return $m[0] . "\n" . $head;
	}, $html, 1);

	if ($addGtm) {
		$body = ewc_gtm_body($gtm);
		$html = preg_replace_callback('/<body\b[^>]*>/i', function ($m) use ($body) {
			return $m[0] . "\n" . $body;
		}, $html, 1);
	}
	return $html;
}

/* Skrypt banera (ten sam plik co na stronie głównej). */
add_action('wp_footer', 'ewc_footer_script', 5);
function ewc_footer_script() {
	$s = ewc_settings();
	$site = ewc_site_url();
	$main = ewc_main_site_file('consent.js');
	/* wersja = data zmiany pliku na stronie (lub numer tygodnia, gdy plik jest na innym serwerze) */
	$ver = $main !== '' ? filemtime($main) : date('oW');
	printf(
		'<script defer src="%s" data-lang="%s" data-policy="%s" data-log="%s"></script>' . "\n",
		esc_url($site . '/consent/consent.js?v=' . $ver),
		esc_attr(ewc_lang()),
		esc_url(ewc_policy_url()),
		$s['log'] === '1' ? esc_url($site . '/consent/log.php') : ''
	);
}

/* ------------------------------------------------------------------
 * Shortcody
 * ------------------------------------------------------------------ */

/* [ew_ustawienia_cookies tekst="Ustawienia cookies"] - odnośnik otwierający panel zgód */
add_shortcode('ew_ustawienia_cookies', 'ewc_sc_settings_link');
function ewc_sc_settings_link($atts) {
	$labels = array('pl' => 'Ustawienia cookies', 'en' => 'Cookie settings', 'fr' => 'Paramètres des cookies');
	$atts = shortcode_atts(array('tekst' => $labels[ewc_lang()]), $atts, 'ew_ustawienia_cookies');
	return '<a href="#ustawienia-cookies" data-ewc-open>' . esc_html($atts['tekst']) . '</a>';
}

/* [ew_deklaracja_cookies] - wykaz plików cookie i stan zgody */
add_shortcode('ew_deklaracja_cookies', 'ewc_sc_declaration');
function ewc_sc_declaration() {
	return '<div data-ewc-declaration></div>';
}

/*
 * [ew_polityka_prywatnosci] - pełna treść polityki pobrana ze strony głównej
 * (jedno źródło - zmiany na stronie od razu widać na blogu). Kopia jest
 * odświeżana co 12 godzin; gdy strona główna jest chwilowo niedostępna,
 * wyświetlana jest ostatnia pobrana wersja.
 */
add_shortcode('ew_polityka_prywatnosci', 'ewc_sc_policy');
function ewc_sc_policy() {
	$lang = ewc_lang();
	$key = 'ewc_policy_' . $lang;
	$html = get_transient($key);
	if ($html === false) {
		$html = ewc_fetch_policy();
		if ($html !== '') {
			set_transient($key, $html, 12 * HOUR_IN_SECONDS);
			update_option($key . '_backup', $html, false);
		} else {
			$html = (string) get_option($key . '_backup', '');
			set_transient($key, $html, HOUR_IN_SECONDS); // ponowna próba za godzinę
		}
	}
	if ($html === '') {
		return '<p><a href="' . esc_url(ewc_policy_url()) . '">' . esc_html(ewc_policy_url()) . '</a></p>';
	}
	return '<div class="ewc-policy">' . $html . '</div>';
}

function ewc_fetch_policy() {
	$url = ewc_policy_url();
	$args = array('timeout' => 10, 'redirection' => 3, 'user-agent' => 'EW-Zgody-Cookies/' . EWC_PLUGIN_VERSION . '; ' . home_url('/'));
	$res = wp_remote_get($url, $args);
	if (is_wp_error($res)) {
		/* Starsze serwery mogą nie ufać nowszym certyfikatom - pobieramy własną,
		   publiczną stronę, a treść i tak jest oczyszczana poniżej (wp_kses). */
		$args['sslverify'] = false;
		$res = wp_remote_get($url, $args);
	}
	if (is_wp_error($res) || (int) wp_remote_retrieve_response_code($res) !== 200) {
		return '';
	}
	$body = wp_remote_retrieve_body($res);
	if (!preg_match('/<!--ewc-policy-start-->(.*?)<!--ewc-policy-end-->/s', $body, $m)) {
		return '';
	}
	$html = preg_replace('#<noscript>.*?</noscript>#s', '', $m[1]);

	/* Odnośniki względne -> pełne adresy strony głównej. */
	$site = ewc_site_url();
	$html = preg_replace('/(href|src)="\/(?!\/)/', '$1="' . $site . '/', $html);

	/* Tylko bezpieczne znaczniki (+ kontener wykazu cookies). */
	$allowed = wp_kses_allowed_html('post');
	$allowed['div']['data-ewc-declaration'] = true;
	$allowed['div']['class'] = true;
	return trim(wp_kses($html, $allowed));
}

/* Strona bloga z kopią polityki: bez indeksowania, kanoniczny adres = strona główna. */
add_action('wp', 'ewc_policy_page_seo');
function ewc_policy_page_seo() {
	if (!is_singular()) {
		return;
	}
	$post = get_post();
	if (!$post || !has_shortcode($post->post_content, 'ew_polityka_prywatnosci')) {
		return;
	}
	remove_action('wp_head', 'rel_canonical');
	add_action('wp_head', function () {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
		echo '<link rel="canonical" href="' . esc_url(ewc_policy_url()) . '">' . "\n";
	}, 1);
}

/* ------------------------------------------------------------------
 * Panel: Ustawienia -> Zgody cookies
 * ------------------------------------------------------------------ */

add_action('admin_menu', 'ewc_admin_menu');
function ewc_admin_menu() {
	add_options_page('Zgody cookies', 'Zgody cookies', 'manage_options', 'ew-zgody-cookies', 'ewc_admin_page');
}

add_action('admin_init', 'ewc_admin_init');
function ewc_admin_init() {
	register_setting('ewc_settings_group', 'ewc_settings', 'ewc_sanitize');
}

function ewc_sanitize($in) {
	$in = is_array($in) ? $in : array();
	$out = ewc_defaults();
	$out['site_url'] = isset($in['site_url']) ? esc_url_raw(untrailingslashit(trim($in['site_url']))) : '';
	$out['gtm_id'] = isset($in['gtm_id']) ? strtoupper(sanitize_text_field($in['gtm_id'])) : '';
	$out['lang'] = isset($in['lang']) && in_array($in['lang'], array('auto', 'pl', 'en', 'fr'), true) ? $in['lang'] : 'auto';
	$out['policy_url'] = isset($in['policy_url']) ? esc_url_raw(trim($in['policy_url'])) : '';
	$out['log'] = !empty($in['log']) ? '1' : '0';
	foreach (array('pl', 'en', 'fr') as $l) {
		delete_transient('ewc_policy_' . $l); // nowe ustawienia = świeża kopia polityki
	}
	return $out;
}

function ewc_admin_page() {
	if (!current_user_can('manage_options')) {
		return;
	}
	$s = ewc_settings();
	$mainJs = ewc_main_site_file('consent.js');
	?>
	<div class="wrap">
		<h1>Zgody cookies (Consent Mode v2)</h1>
		<p>Okno zgód, wykaz plików cookie i jego wygląd są wczytywane ze strony głównej:
			<code><?php echo esc_html(ewc_site_url() . '/consent/consent.js'); ?></code>.
			Zmiany wprowadzone na stronie głównej od razu obowiązują też na blogu.</p>
		<p>Stan: <?php echo $mainJs !== ''
			? '<strong style="color:#1a7f37">pliki strony głównej znalezione na serwerze</strong>'
			: '<strong style="color:#b35900">nie znaleziono plików strony na dysku – skrypt będzie ładowany z adresu powyżej</strong>'; ?>.</p>

		<form method="post" action="options.php">
			<?php settings_fields('ewc_settings_group'); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="ewc-site">Adres strony głównej</label></th>
					<td><input type="url" id="ewc-site" class="regular-text" name="ewc_settings[site_url]" value="<?php echo esc_attr($s['site_url']); ?>" placeholder="<?php echo esc_attr(ewc_site_url()); ?>">
						<p class="description">Zostaw puste – zostanie użyta domena bloga.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="ewc-gtm">Google Tag Manager</label></th>
					<td><input type="text" id="ewc-gtm" class="regular-text" name="ewc_settings[gtm_id]" value="<?php echo esc_attr($s['gtm_id']); ?>" placeholder="GTM-XXXXXXX">
						<p class="description">Jeśli motyw ma już ten kontener wpisany na sztywno, wtyczka nie doda go drugi raz – ustawi tylko zgody przed nim. Puste = nie wstawiaj GTM.</p></td>
				</tr>
				<tr>
					<th scope="row"><label for="ewc-lang">Język okna zgód</label></th>
					<td><select id="ewc-lang" name="ewc_settings[lang]">
						<?php foreach (array('auto' => 'automatycznie (język WordPressa)', 'pl' => 'polski', 'en' => 'angielski', 'fr' => 'francuski') as $v => $label) : ?>
							<option value="<?php echo esc_attr($v); ?>" <?php selected($s['lang'], $v); ?>><?php echo esc_html($label); ?></option>
						<?php endforeach; ?>
					</select></td>
				</tr>
				<tr>
					<th scope="row"><label for="ewc-policy">Polityka prywatności</label></th>
					<td><input type="url" id="ewc-policy" class="regular-text" name="ewc_settings[policy_url]" value="<?php echo esc_attr($s['policy_url']); ?>" placeholder="<?php echo esc_attr(ewc_policy_url()); ?>">
						<p class="description">Zostaw puste – link prowadzi do polityki na stronie głównej.</p></td>
				</tr>
				<tr>
					<th scope="row">Rejestr zgód</th>
					<td><label><input type="checkbox" name="ewc_settings[log]" value="1" <?php checked($s['log'], '1'); ?>>
						Zapisuj zgody w rejestrze strony głównej (<code>_backups/zgody/</code>)</label></td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>

		<h2>Shortcody</h2>
		<ul style="list-style:disc;padding-left:20px">
			<li><code>[ew_polityka_prywatnosci]</code> – pełna polityka prywatności pobrana ze strony głównej (np. na stronę „Polityka prywatności” bloga).</li>
			<li><code>[ew_ustawienia_cookies]</code> – odnośnik „Ustawienia cookies” otwierający okno zgód (np. w widżecie stopki).</li>
			<li><code>[ew_deklaracja_cookies]</code> – sam wykaz plików cookie z aktualnym stanem zgody.</li>
		</ul>
		<p>Odnośnik do ustawień możesz też dodać w <em>Wygląd → Menu</em> jako „Własny odnośnik” z adresem <code>#ustawienia-cookies</code>.</p>
	</div>
	<?php
}

/* Link „Ustawienia” na liście wtyczek. */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) {
	array_unshift($links, '<a href="' . esc_url(admin_url('options-general.php?page=ew-zgody-cookies')) . '">Ustawienia</a>');
	return $links;
});

/* Ostrzeżenie o starej wtyczce z paskiem cookies, która dublowałaby okno zgód. */
add_action('admin_notices', 'ewc_old_plugin_notice');
function ewc_old_plugin_notice() {
	if (!current_user_can('activate_plugins')) {
		return;
	}
	foreach ((array) get_option('active_plugins', array()) as $p) {
		if (strpos($p, 'uk-cookie-consent/') === 0 || strpos($p, 'cookie-notice/') === 0 || strpos($p, 'cookie-law-info/') === 0) {
			echo '<div class="notice notice-warning"><p><strong>Zgody cookies:</strong> wyłącz starą wtyczkę z paskiem cookies (<code>'
				. esc_html(dirname($p)) . '</code>) w <a href="' . esc_url(admin_url('plugins.php')) . '">Wtyczkach</a> – nowe okno zgód ją zastępuje.</p></div>';
			return;
		}
	}
}
