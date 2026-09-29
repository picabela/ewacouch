/*
 * Zgody cookies (Google Consent Mode v2) - baner, panel ustawień,
 * deklaracja plików cookie i rejestr zgód.
 *
 * Jeden plik obsługuje stronę główną (PL/EN/FR) i blog WordPress.
 * Wymaga wcześniejszego, inline'owego consent-init.js (domyślne zgody
 * ustawione przed Google Tag Managerem).
 *
 * Wczytanie:
 *   <script defer src="/consent/consent.js?v=1"
 *           data-lang="pl"                      (pl | en | fr, domyślnie <html lang>)
 *           data-policy="/polityka-prywatnosci" (link do polityki prywatności)
 *           data-log="/consent/log.php"></script> (rejestr zgód; "" = wyłączony)
 *
 * Otwieranie ustawień z dowolnego miejsca:
 *   <a href="#ustawienia-cookies">...</a>  albo  element z atrybutem data-ewc-open,
 *   albo z JS: window.ewConsent.open()
 * Deklaracja cookies (np. w polityce prywatności): <div data-ewc-declaration></div>
 *
 * Zdarzenia w dataLayer (do wyzwalaczy w GTM):
 *   ew_consent_update  - po każdym zapisaniu wyboru (+ obiekt ew_consent)
 *   ew_consent_ready   - przy wejściu na stronę, gdy wybór jest już zapisany
 *   cookie_consent_preferences / _statistics / _marketing - dla przyznanych kategorii
 */
(function () {
	'use strict';

	/* Zwiększ, gdy zmieni się lista narzędzi/cookies - wszyscy zostaną zapytani ponownie. */
	var VERSION = 1;
	var COOKIE = 'ew_consent';
	var DAYS = 365;
	var CATS = ['necessary', 'preferences', 'statistics', 'marketing'];

	var script = document.currentScript || (function () {
		var s = document.getElementsByTagName('script');
		return s[s.length - 1];
	})();
	var src = script.getAttribute('src') || '';
	var base = src.replace(/consent\.js(\?.*)?$/, '');
	var assetQuery = src.indexOf('?') !== -1 ? src.slice(src.indexOf('?')) : '';

	var T = {
		pl: {
			bannerTitle: 'Dbam o Twoją prywatność',
			bannerText: 'Używam plików cookie, aby strona działała poprawnie i bezpiecznie. Za Twoją zgodą korzystam także z plików cookie preferencji, statystycznych i marketingowych (m.in. Google Analytics), które pomagają mi rozwijać stronę. Swoją decyzję możesz w każdej chwili zmienić.',
			policy: 'Polityka prywatności',
			accept: 'Akceptuję wszystkie',
			reject: 'Odrzuć wszystkie',
			customize: 'Dostosuj',
			save: 'Zapisz wybór',
			modalTitle: 'Ustawienia plików cookie',
			modalIntro: 'Wybierz, na które kategorie plików cookie się zgadzasz. Pliki niezbędne są zawsze aktywne, bo bez nich strona nie mogłaby działać. Więcej informacji znajdziesz w dokumencie',
			alwaysOn: 'Zawsze aktywne',
			showCookies: 'Pokaż pliki cookie',
			none: 'Obecnie strona nie używa plików cookie tego typu.',
			th: ['Nazwa', 'Dostawca', 'Cel', 'Ważność'],
			statusTitle: 'Twoja obecna zgoda',
			statusNone: 'Nie wybrano jeszcze ustawień plików cookie.',
			consentId: 'Identyfikator zgody',
			consentDate: 'Data',
			change: 'Zmień ustawienia',
			withdraw: 'Wycofaj zgodę',
			close: 'Zamknij',
			widget: 'Ustawienia plików cookie',
			saved: 'Zapisano ustawienia plików cookie.',
			noscript: 'Aby zobaczyć listę plików cookie i zmienić ustawienia, włącz JavaScript.',
			dur: { session: 'sesja', m30: '30 minut', d347: '347 dni', y1: '1 rok', y2: '2 lata' },
			cat: {
				necessary: ['Niezbędne', 'Umożliwiają podstawowe funkcje strony, takie jak zapamiętanie Twojej decyzji dotyczącej plików cookie oraz ochrona przed atakami i botami. Nie wymagają zgody.'],
				preferences: ['Preferencje', 'Pozwalają zapamiętać Twoje wybory, np. dane wpisane w formularzu komentarza na blogu, dzięki czemu nie musisz podawać ich ponownie.'],
				statistics: ['Statystyczne', 'Pomagają zrozumieć, jak odwiedzający korzystają ze strony (np. które podstrony są najczęściej czytane), na podstawie zbiorczych statystyk. Korzystam z Google Analytics.'],
				marketing: ['Marketingowe', 'Służą do mierzenia skuteczności reklam i wyświetlania dopasowanych treści w innych serwisach. Obejmują też zgodę na przekazywanie Google danych reklamowych i personalizację reklam.']
			}
		},
		en: {
			bannerTitle: 'Your privacy matters',
			bannerText: 'I use cookies to keep this website working properly and securely. With your consent I also use preference, statistics and marketing cookies (including Google Analytics), which help me improve the website. You can change your decision at any time.',
			policy: 'Privacy policy',
			accept: 'Accept all',
			reject: 'Reject all',
			customize: 'Customise',
			save: 'Save my choices',
			modalTitle: 'Cookie settings',
			modalIntro: 'Choose which categories of cookies you agree to. Necessary cookies are always active, as the website cannot work without them. More information can be found in the',
			alwaysOn: 'Always active',
			showCookies: 'Show cookies',
			none: 'This website does not currently use cookies of this type.',
			th: ['Name', 'Provider', 'Purpose', 'Expiry'],
			statusTitle: 'Your current consent',
			statusNone: 'You have not chosen your cookie settings yet.',
			consentId: 'Consent ID',
			consentDate: 'Date',
			change: 'Change settings',
			withdraw: 'Withdraw consent',
			close: 'Close',
			widget: 'Cookie settings',
			saved: 'Your cookie settings have been saved.',
			noscript: 'Please enable JavaScript to see the list of cookies and change your settings.',
			dur: { session: 'session', m30: '30 minutes', d347: '347 days', y1: '1 year', y2: '2 years' },
			cat: {
				necessary: ['Necessary', 'Enable basic functions of the website, such as remembering your cookie choices and protecting the site against attacks and bots. They do not require consent.'],
				preferences: ['Preferences', 'Remember your choices, e.g. the details entered in the blog comment form, so that you do not have to enter them again.'],
				statistics: ['Statistics', 'Help me understand how visitors use the website (e.g. which pages are read most often) through aggregated statistics. I use Google Analytics.'],
				marketing: ['Marketing', 'Used to measure the effectiveness of advertising and to show relevant content on other websites. This also covers consent to sending advertising data to Google and ad personalisation.']
			}
		},
		fr: {
			bannerTitle: 'Votre vie privée compte',
			bannerText: 'J’utilise des cookies pour assurer le bon fonctionnement et la sécurité du site. Avec votre accord, j’utilise également des cookies de préférences, statistiques et marketing (notamment Google Analytics), qui m’aident à améliorer le site. Vous pouvez modifier votre choix à tout moment.',
			policy: 'Politique de confidentialité',
			accept: 'Tout accepter',
			reject: 'Tout refuser',
			customize: 'Personnaliser',
			save: 'Enregistrer mes choix',
			modalTitle: 'Paramètres des cookies',
			modalIntro: 'Choisissez les catégories de cookies que vous acceptez. Les cookies nécessaires sont toujours actifs, car le site ne peut pas fonctionner sans eux. Plus d’informations dans la',
			alwaysOn: 'Toujours actifs',
			showCookies: 'Afficher les cookies',
			none: 'Le site n’utilise actuellement aucun cookie de ce type.',
			th: ['Nom', 'Fournisseur', 'Finalité', 'Durée'],
			statusTitle: 'Votre consentement actuel',
			statusNone: 'Vous n’avez pas encore choisi vos paramètres de cookies.',
			consentId: 'Identifiant du consentement',
			consentDate: 'Date',
			change: 'Modifier les paramètres',
			withdraw: 'Retirer mon consentement',
			close: 'Fermer',
			widget: 'Paramètres des cookies',
			saved: 'Vos paramètres de cookies ont été enregistrés.',
			noscript: 'Veuillez activer JavaScript pour voir la liste des cookies et modifier vos paramètres.',
			dur: { session: 'session', m30: '30 minutes', d347: '347 jours', y1: '1 an', y2: '2 ans' },
			cat: {
				necessary: ['Nécessaires', 'Permettent les fonctions de base du site, comme la mémorisation de vos choix concernant les cookies et la protection contre les attaques et les robots. Ils ne nécessitent pas de consentement.'],
				preferences: ['Préférences', 'Mémorisent vos choix, par exemple les informations saisies dans le formulaire de commentaire du blog, pour que vous n’ayez pas à les saisir à nouveau.'],
				statistics: ['Statistiques', 'M’aident à comprendre comment les visiteurs utilisent le site (par ex. quelles pages sont les plus lues) grâce à des statistiques agrégées. J’utilise Google Analytics.'],
				marketing: ['Marketing', 'Servent à mesurer l’efficacité des publicités et à afficher des contenus adaptés sur d’autres sites. Cela inclut le consentement à l’envoi de données publicitaires à Google et à la personnalisation des annonces.']
			}
		}
	};

	/*
	 * Wykaz plików cookie. p = dostawca, e = klucz ważności (T.dur),
	 * del = wzorzec nazw usuwanych po odmowie zgody (tylko cookies dostępne z JS).
	 */
	var SITE = location.hostname.replace(/^www\./, '');
	var COOKIES = {
		necessary: [
			{ n: 'ew_consent', p: SITE, e: 'y1', d: {
				pl: 'Zapamiętuje Twoje ustawienia plików cookie.',
				en: 'Stores your cookie settings.',
				fr: 'Mémorise vos paramètres de cookies.' } },
			{ n: '__cf_bm', p: 'Cloudflare', e: 'm30', d: {
				pl: 'Odróżnia ruch ludzi od botów, chroniąc stronę przed atakami.',
				en: 'Distinguishes humans from bots to protect the website against attacks.',
				fr: 'Distingue les humains des robots afin de protéger le site contre les attaques.' } },
			{ n: 'cf_clearance', p: 'Cloudflare', e: 'm30', d: {
				pl: 'Potwierdza przejście weryfikacji bezpieczeństwa (tylko gdy została wyświetlona).',
				en: 'Confirms that a security check has been passed (only if one was shown).',
				fr: 'Confirme la réussite d’une vérification de sécurité (uniquement si elle a été affichée).' } },
			{ n: 'wordpress_test_cookie', p: SITE + ' (blog)', e: 'session', d: {
				pl: 'Sprawdza, czy przeglądarka obsługuje pliki cookie.',
				en: 'Checks whether the browser accepts cookies.',
				fr: 'Vérifie si le navigateur accepte les cookies.' } },
			{ n: 'wordpress_*, wp-settings-*', p: SITE + ' (blog)', e: 'y1', d: {
				pl: 'Sesja i ustawienia zalogowanego administratora bloga. Nie są zapisywane u odwiedzających.',
				en: 'Session and settings of the logged-in blog administrator. Not set for visitors.',
				fr: 'Session et paramètres de l’administrateur connecté du blog. Non déposés chez les visiteurs.' } }
		],
		preferences: [
			{ n: 'comment_author_*', p: SITE + ' (blog)', e: 'd347', del: /^comment_author_/, d: {
				pl: 'Zapamiętują imię, e-mail i adres strony podane w komentarzu – tylko jeśli zaznaczysz tę opcję.',
				en: 'Remember the name, e-mail and website entered in a comment – only if you tick this option.',
				fr: 'Mémorisent le nom, l’e-mail et le site saisis dans un commentaire – uniquement si vous cochez cette option.' } }
		],
		statistics: [
			{ n: '_ga', p: 'Google', e: 'y2', del: /^_ga$/, d: {
				pl: 'Rozróżnia odwiedzających na potrzeby statystyk Google Analytics.',
				en: 'Distinguishes visitors for Google Analytics statistics.',
				fr: 'Distingue les visiteurs pour les statistiques Google Analytics.' } },
			{ n: '_ga_*', p: 'Google', e: 'y2', del: /^_ga_/, d: {
				pl: 'Przechowuje stan sesji na potrzeby statystyk Google Analytics.',
				en: 'Stores the session state for Google Analytics statistics.',
				fr: 'Conserve l’état de la session pour les statistiques Google Analytics.' } }
		],
		marketing: []
	};
	/* Nazwy usuwane po odmowie, nawet jeśli narzędzie nie jest (jeszcze) opisane w wykazie. */
	var EXTRA_DEL = { marketing: [/^_gcl_/, /^_fbp$/, /^_uet/] };

	var lang = (script.getAttribute('data-lang') || document.documentElement.getAttribute('lang') || 'pl').slice(0, 2).toLowerCase();
	if (!T[lang]) { lang = 'pl'; }
	var t = T[lang];
	var policyUrl = script.getAttribute('data-policy') || '';
	var logUrl = script.hasAttribute('data-log') ? script.getAttribute('data-log') : base + 'log.php';

	var state = readState();
	var ui = {};
	var lastFocus = null;

	/* ---------- stan zgody (ciasteczko) ---------- */

	function readState() {
		var m = document.cookie.match(/(?:^|;\s*)ew_consent=([^;]+)/);
		if (!m) { return null; }
		try {
			var c = JSON.parse(decodeURIComponent(m[1]));
			return (c && typeof c === 'object' && c.id) ? c : null;
		} catch (e) { return null; }
	}

	function writeState(c) {
		document.cookie = COOKIE + '=' + encodeURIComponent(JSON.stringify(c)) +
			'; path=/; max-age=' + (DAYS * 86400) + '; SameSite=Lax' +
			(location.protocol === 'https:' ? '; Secure' : '');
	}

	function newId() {
		var b = new Uint8Array(12), out = '', i;
		if (window.crypto && crypto.getRandomValues) {
			crypto.getRandomValues(b);
		} else {
			for (i = 0; i < b.length; i++) { b[i] = Math.floor(Math.random() * 256); }
		}
		for (i = 0; i < b.length; i++) { out += ('0' + b[i].toString(16)).slice(-2); }
		return out.replace(/^(.{8})(.{8})(.{8})$/, '$1-$2-$3');
	}

	function granted(cat) {
		if (cat === 'necessary') { return true; }
		return !!(state && state[cat.charAt(0)]);
	}

	/* ---------- Consent Mode / dataLayer ---------- */

	function push(obj) {
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push(obj);
	}

	function signalGoogle() {
		var g = function (on) { return on ? 'granted' : 'denied'; };
		if (typeof window.gtag === 'function') {
			window.gtag('consent', 'update', {
				ad_storage: g(state.m),
				ad_user_data: g(state.m),
				ad_personalization: g(state.m),
				analytics_storage: g(state.s),
				functionality_storage: g(state.p),
				personalization_storage: g(state.p)
			});
			window.gtag('set', 'ads_data_redaction', !state.m);
		}
	}

	function pushCategoryEvents() {
		if (state.p) { push({ event: 'cookie_consent_preferences' }); }
		if (state.s) { push({ event: 'cookie_consent_statistics' }); }
		if (state.m) { push({ event: 'cookie_consent_marketing' }); }
	}

	function consentObj() {
		return { preferences: !!state.p, statistics: !!state.s, marketing: !!state.m, id: state.id };
	}

	/* ---------- usuwanie cookies kategorii bez zgody ---------- */

	function deleteCookie(name) {
		var host = location.hostname, parts = host.split('.'), domains = ['', host], paths = ['/'];
		for (var i = parts.length - 2; i > 0; i--) { domains.push('.' + parts.slice(i).join('.')); }
		var seg = location.pathname.split('/')[1];
		if (seg) { paths.push('/' + seg, '/' + seg + '/'); }
		for (var d = 0; d < domains.length; d++) {
			for (var p = 0; p < paths.length; p++) {
				document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=' + paths[p] +
					(domains[d] ? '; domain=' + domains[d] : '');
			}
		}
	}

	function cleanupDenied() {
		var names = document.cookie.split(';').map(function (c) { return c.split('=')[0].trim(); });
		CATS.forEach(function (cat) {
			if (granted(cat)) { return; }
			var patterns = (COOKIES[cat] || []).filter(function (c) { return c.del; }).map(function (c) { return c.del; })
				.concat(EXTRA_DEL[cat] || []);
			names.forEach(function (n) {
				for (var i = 0; i < patterns.length; i++) {
					if (patterns[i].test(n)) { deleteCookie(n); break; }
				}
			});
		});
	}

	/* ---------- zapis wyboru ---------- */

	function save(p, s, m, action) {
		var hadStats = state && state.s;
		state = { v: VERSION, id: state && state.id ? state.id : newId(), t: Date.now(), p: p ? 1 : 0, s: s ? 1 : 0, m: m ? 1 : 0 };
		writeState(state);
		signalGoogle();
		push({ event: 'ew_consent_update', ew_consent: consentObj() });
		pushCategoryEvents();
		cleanupDenied();
		sendLog(action);
		hideBanner();
		closeModal();
		showWidget();
		renderDeclarations();
		announce(t.saved);
		/* Po cofnięciu zgody na statystyki odświeżamy stronę, żeby już
		   załadowane skrypty analityczne na pewno przestały działać. */
		if (hadStats && !state.s) { setTimeout(function () { location.reload(); }, 400); }
	}

	function sendLog(action) {
		if (!logUrl) { return; }
		var body = 'id=' + encodeURIComponent(state.id) + '&v=' + VERSION +
			'&p=' + state.p + '&s=' + state.s + '&m=' + state.m +
			'&a=' + encodeURIComponent(action || '') +
			'&u=' + encodeURIComponent(location.pathname) + '&l=' + lang;
		try {
			if (navigator.sendBeacon) {
				navigator.sendBeacon(logUrl, new Blob([body], { type: 'application/x-www-form-urlencoded' }));
			} else {
				var x = new XMLHttpRequest();
				x.open('POST', logUrl, true);
				x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				x.send(body);
			}
		} catch (e) { /* rejestr jest pomocniczy - brak zapisu nie blokuje strony */ }
	}

	/* ---------- budowa interfejsu ---------- */

	function el(tag, attrs, html) {
		var n = document.createElement(tag);
		for (var k in attrs) { if (attrs.hasOwnProperty(k)) { n.setAttribute(k, attrs[k]); } }
		if (html != null) { n.innerHTML = html; }
		return n;
	}

	function esc(s) {
		return String(s).replace(/[&<>"]/g, function (c) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c];
		});
	}

	function policyLink() {
		return policyUrl ? '<a href="' + esc(policyUrl) + '">' + esc(t.policy) + '</a>' : esc(t.policy);
	}

	var LEAF = '<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false">' +
		'<path fill="currentColor" d="M12 2.2a9.8 9.8 0 1 0 9.8 10.1 3.4 3.4 0 0 1-3.9-3.3 3.4 3.4 0 0 1-3.6-3.4A3.3 3.3 0 0 1 12 2.2z"/>' +
		'<circle cx="8.2" cy="9.3" r="1.35" fill="#fff"/><circle cx="8.8" cy="15.2" r="1.35" fill="#fff"/>' +
		'<circle cx="14.6" cy="15.6" r="1.35" fill="#fff"/><circle cx="12.4" cy="11.6" r=".95" fill="#fff"/></svg>';

	function buildBanner() {
		var b = el('div', { 'class': 'ewc-banner', role: 'region', 'aria-labelledby': 'ewc-b-title', hidden: '' },
			'<div class="ewc-banner__icon">' + LEAF + '</div>' +
			'<div class="ewc-banner__body">' +
				'<p class="ewc-banner__title" id="ewc-b-title">' + esc(t.bannerTitle) + '</p>' +
				'<p class="ewc-banner__text">' + esc(t.bannerText) + ' ' + policyLink() + '</p>' +
				'<div class="ewc-actions">' +
					'<button type="button" class="ewc-btn ewc-btn--solid" data-ewc="accept">' + esc(t.accept) + '</button>' +
					'<button type="button" class="ewc-btn ewc-btn--solid" data-ewc="reject">' + esc(t.reject) + '</button>' +
					'<button type="button" class="ewc-btn ewc-btn--line" data-ewc="settings">' + esc(t.customize) + '</button>' +
				'</div>' +
			'</div>');
		document.body.appendChild(b);
		return b;
	}

	function cookieTable(cat) {
		var list = COOKIES[cat] || [];
		if (!list.length) { return '<p class="ewc-none">' + esc(t.none) + '</p>'; }
		var h = '<table class="ewc-table"><thead><tr>';
		t.th.forEach(function (x) { h += '<th scope="col">' + esc(x) + '</th>'; });
		h += '</tr></thead><tbody>';
		list.forEach(function (c) {
			h += '<tr>' +
				'<td data-label="' + esc(t.th[0]) + '"><code>' + esc(c.n) + '</code></td>' +
				'<td data-label="' + esc(t.th[1]) + '">' + esc(c.p) + '</td>' +
				'<td data-label="' + esc(t.th[2]) + '">' + esc(c.d[lang] || c.d.pl) + '</td>' +
				'<td data-label="' + esc(t.th[3]) + '">' + esc(t.dur[c.e]) + '</td></tr>';
		});
		return h + '</tbody></table>';
	}

	function buildModal() {
		var cats = '';
		CATS.forEach(function (cat) {
			var id = 'ewc-cat-' + cat, n = (COOKIES[cat] || []).length;
			var ctrl = cat === 'necessary'
				? '<span class="ewc-badge">' + esc(t.alwaysOn) + '</span>'
				: '<label class="ewc-switch"><input type="checkbox" data-cat="' + cat + '" aria-labelledby="' + id + '">' +
				  '<span class="ewc-switch__track" aria-hidden="true"></span></label>';
			cats += '<div class="ewc-cat">' +
				'<div class="ewc-cat__head"><span class="ewc-cat__title" id="' + id + '">' + esc(t.cat[cat][0]) + '</span>' + ctrl + '</div>' +
				'<p class="ewc-cat__desc">' + esc(t.cat[cat][1]) + '</p>' +
				'<details class="ewc-cat__more"><summary>' + esc(t.showCookies) + ' (' + n + ')</summary>' + cookieTable(cat) + '</details>' +
				'</div>';
		});
		var m = el('div', { 'class': 'ewc-modal', hidden: '' },
			'<div class="ewc-modal__backdrop" data-ewc="close"></div>' +
			'<div class="ewc-modal__box" role="dialog" aria-modal="true" aria-labelledby="ewc-m-title" tabindex="-1">' +
				'<div class="ewc-modal__head">' +
					'<p class="ewc-modal__title" id="ewc-m-title">' + esc(t.modalTitle) + '</p>' +
					'<button type="button" class="ewc-x" data-ewc="close" aria-label="' + esc(t.close) + '">&times;</button>' +
				'</div>' +
				'<div class="ewc-modal__body">' +
					'<p class="ewc-modal__intro">' + esc(t.modalIntro) + ' ' + policyLink() + '.</p>' +
					cats +
					'<p class="ewc-modal__status" data-ewc-status></p>' +
				'</div>' +
				'<div class="ewc-modal__foot">' +
					'<button type="button" class="ewc-btn ewc-btn--solid" data-ewc="accept">' + esc(t.accept) + '</button>' +
					'<button type="button" class="ewc-btn ewc-btn--solid" data-ewc="reject">' + esc(t.reject) + '</button>' +
					'<button type="button" class="ewc-btn ewc-btn--line" data-ewc="save">' + esc(t.save) + '</button>' +
				'</div>' +
			'</div>');
		document.body.appendChild(m);
		return m;
	}

	function buildWidget() {
		var w = el('button', { type: 'button', 'class': 'ewc-widget', 'data-ewc': 'settings', 'aria-label': t.widget, title: t.widget, hidden: '' }, LEAF);
		document.body.appendChild(w);
		return w;
	}

	function formatDate(ts) {
		try {
			return new Date(ts).toLocaleString(lang === 'en' ? 'en-GB' : lang, { dateStyle: 'medium', timeStyle: 'short' });
		} catch (e) { return new Date(ts).toLocaleString(); }
	}

	function statusHtml() {
		if (!state) { return esc(t.statusNone); }
		var on = CATS.filter(granted).map(function (c) { return t.cat[c][0]; }).join(', ');
		return '<strong>' + esc(t.statusTitle) + ':</strong> ' + esc(on) + '<br>' +
			esc(t.consentId) + ': <code>' + esc(state.id) + '</code> &middot; ' + esc(t.consentDate) + ': ' + esc(formatDate(state.t));
	}

	/* Deklaracja cookies w treści strony (np. polityka prywatności). */
	function renderDeclarations() {
		var nodes = document.querySelectorAll('[data-ewc-declaration]');
		for (var i = 0; i < nodes.length; i++) {
			var h = '<div class="ewc-decl__status"><p>' + statusHtml() + '</p><p class="ewc-decl__btns">' +
				'<button type="button" class="ewc-btn ewc-btn--solid" data-ewc="settings">' + esc(t.change) + '</button>' +
				(state && (state.p || state.s || state.m)
					? ' <button type="button" class="ewc-btn ewc-btn--line" data-ewc="withdraw">' + esc(t.withdraw) + '</button>' : '') +
				'</p></div>';
			CATS.forEach(function (cat) {
				h += '<h3 class="ewc-decl__h">' + esc(t.cat[cat][0]) + ' (' + (COOKIES[cat] || []).length + ')</h3>' +
					'<p class="ewc-decl__p">' + esc(t.cat[cat][1]) + '</p>' + cookieTable(cat);
			});
			nodes[i].className = (nodes[i].className.replace(/\bewc-decl\b/, '') + ' ewc-decl').trim();
			nodes[i].innerHTML = h;
		}
	}

	function announce(msg) {
		if (!ui.live) {
			ui.live = el('div', { 'class': 'ewc-sr', 'aria-live': 'polite' });
			document.body.appendChild(ui.live);
		}
		ui.live.textContent = '';
		setTimeout(function () { ui.live.textContent = msg; }, 50);
	}

	/* ---------- pokazywanie / ukrywanie ---------- */

	function showBanner() { ui.banner.hidden = false; ui.widget.hidden = true; }
	function hideBanner() { ui.banner.hidden = true; }
	function showWidget() { ui.widget.hidden = false; }

	function openModal() {
		lastFocus = document.activeElement;
		var boxes = ui.modal.querySelectorAll('input[data-cat]');
		for (var i = 0; i < boxes.length; i++) { boxes[i].checked = granted(boxes[i].getAttribute('data-cat')); }
		ui.modal.querySelector('[data-ewc-status]').innerHTML = statusHtml();
		ui.modal.hidden = false;
		document.documentElement.classList.add('ewc-lock');
		ui.modal.querySelector('.ewc-modal__box').focus();
	}

	function closeModal() {
		if (ui.modal.hidden) { return; }
		ui.modal.hidden = true;
		document.documentElement.classList.remove('ewc-lock');
		if (lastFocus && lastFocus.focus && document.contains(lastFocus)) { lastFocus.focus(); }
	}

	function trapFocus(e) {
		if (ui.modal.hidden || e.key !== 'Tab') { return; }
		var f = ui.modal.querySelectorAll('a[href], button, input, summary');
		f = Array.prototype.filter.call(f, function (n) { return n.offsetParent !== null; });
		if (!f.length) { return; }
		var first = f[0], last = f[f.length - 1];
		if (e.shiftKey && (document.activeElement === first || document.activeElement === ui.modal.querySelector('.ewc-modal__box'))) {
			e.preventDefault(); last.focus();
		} else if (!e.shiftKey && document.activeElement === last) {
			e.preventDefault(); first.focus();
		}
	}

	/* ---------- obsługa zdarzeń ---------- */

	function onClick(e) {
		var n = e.target;
		while (n && n !== document) {
			if (n.nodeType === 1) {
				if (n.hasAttribute('data-ewc-open') || /#(ustawienia-cookies|cookie-settings|parametres-cookies)$/.test(n.getAttribute('href') || '')) {
					e.preventDefault(); openModal(); return;
				}
				var a = n.getAttribute('data-ewc');
				if (a) {
					if (a === 'accept') { save(1, 1, 1, 'accept'); }
					else if (a === 'reject') { save(0, 0, 0, 'reject'); }
					else if (a === 'withdraw') { save(0, 0, 0, 'withdraw'); }
					else if (a === 'settings') { openModal(); }
					else if (a === 'close') { closeModal(); }
					else if (a === 'save') {
						var v = {};
						var boxes = ui.modal.querySelectorAll('input[data-cat]');
						for (var i = 0; i < boxes.length; i++) { v[boxes[i].getAttribute('data-cat')] = boxes[i].checked; }
						save(v.preferences, v.statistics, v.marketing, 'custom');
					}
					return;
				}
			}
			n = n.parentNode;
		}
	}

	function onKey(e) {
		if (e.key === 'Escape' && ui.modal && !ui.modal.hidden) { closeModal(); }
		trapFocus(e);
	}

	/* ---------- start ---------- */

	function loadCss(cb) {
		if (document.getElementById('ewc-css')) { cb(); return; }
		var l = el('link', { id: 'ewc-css', rel: 'stylesheet', href: base + 'consent.css' + assetQuery });
		var done = false, fire = function () { if (!done) { done = true; cb(); } };
		l.onload = fire; l.onerror = fire;
		setTimeout(fire, 3000);
		document.head.appendChild(l);
	}

	function start() {
		ui.banner = buildBanner();
		ui.modal = buildModal();
		ui.widget = buildWidget();
		document.addEventListener('click', onClick);
		document.addEventListener('keydown', onKey);
		renderDeclarations();

		if (!state || state.v !== VERSION) {
			showBanner();
		} else {
			showWidget();
			push({ event: 'ew_consent_ready', ew_consent: consentObj() });
			pushCategoryEvents();
			cleanupDenied();
		}
	}

	window.ewConsent = {
		open: function () { if (ui.modal) { openModal(); } },
		get: function () { return state ? consentObj() : null; }
	};

	function boot() { loadCss(start); }
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();
