/*
 * Zgody cookies - inicjalizacja Google Consent Mode v2.
 *
 * Ten kod jest wstawiany INLINE w <head> PRZED Google Tag Managerem
 * (strona: includes/header.php, blog: wtyczka ew-zgody-cookies).
 * Ustawia domyślny stan zgód (wszystko odrzucone poza bezpieczeństwem),
 * a jeśli użytkownik już wcześniej wybrał - od razu przywraca jego wybór,
 * zanim GTM uruchomi jakikolwiek tag.
 *
 * UWAGA: kopia tego pliku jest we wtyczce WordPress
 * (wordpress-plugin/ew-zgody-cookies/consent-init.js) - zmieniaj oba naraz.
 */
window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }
(function () {
	gtag('consent', 'default', {
		ad_storage: 'denied',
		ad_user_data: 'denied',
		ad_personalization: 'denied',
		analytics_storage: 'denied',
		functionality_storage: 'denied',
		personalization_storage: 'denied',
		security_storage: 'granted',
		wait_for_update: 500
	});
	gtag('set', 'ads_data_redaction', true);

	var m = document.cookie.match(/(?:^|;\s*)ew_consent=([^;]+)/);
	if (!m) { return; }
	try {
		var c = JSON.parse(decodeURIComponent(m[1]));
		var g = function (on) { return on ? 'granted' : 'denied'; };
		gtag('consent', 'update', {
			ad_storage: g(c.m),
			ad_user_data: g(c.m),
			ad_personalization: g(c.m),
			analytics_storage: g(c.s),
			functionality_storage: g(c.p),
			personalization_storage: g(c.p)
		});
		if (c.m) { gtag('set', 'ads_data_redaction', false); }
	} catch (e) { /* uszkodzone ciasteczko - zostaje stan domyślny */ }
})();
