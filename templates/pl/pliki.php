<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }
/*
 * Polityka prywatności i plików cookies (PL).
 * Znaczniki ewc-policy-start / ewc-policy-end wyznaczają treść, którą
 * wtyczka bloga (shortcode [ew_polityka_prywatnosci]) pobiera i wyświetla
 * na WordPressie - dzięki temu polityka jest w jednym miejscu.
 * Wykaz plików cookie generuje consent/consent.js w <div data-ewc-declaration>.
 */
$mail  = e($contact['email']);
$phone = e($contact['phone']);
$addr  = e($contact['street'] . ', ' . $contact['postcode'] . ' ' . $contact['city']);
?>
                                <div class="banner-podstrona">

                                        <div class="desc2">

                                     <div class="odnosnik"> <a class="kont" href="<?= e(page_url($lang, 'kontakt')) ?>"> umów się na sesję wstępną   <br>bezpośrednią lub on-line  <span class="pom">&#8658;</span></a> </div>
<h1 class="tytul">Polityka prywatności i plików cookies</h1>

<div class="polityka">
<!--ewc-policy-start-->
<p class="polityka-meta">Obowiązuje od 29 września 2026 r.</p>

<p>W tym dokumencie wyjaśniam, jakie dane osobowe przetwarzam w związku z korzystaniem ze strony ewedrychowska-coaching.pl (w tym z bloga pod adresem ewedrychowska-coaching.pl/blog), w jakich celach i na jakiej podstawie, komu mogą być przekazywane oraz jakie prawa Ci przysługują. Opisuję tu również pliki cookie i sposób zarządzania zgodami.</p>

<h2 class="polityka-h2">1. Administrator danych</h2>
<p>Administratorem Twoich danych osobowych jest <strong>Ewa Wędrychowska</strong>, <?= $addr ?> (dalej: „Administrator”). We wszystkich sprawach dotyczących danych osobowych możesz się ze mną skontaktować:</p>
<ul class="polityka-lista">
	<li>e-mail: <a href="mailto:<?= $mail ?>"><?= $mail ?></a>,</li>
	<li>telefon: <?= $phone ?>,</li>
	<li>pisemnie na adres: <?= $addr ?>.</li>
</ul>

<h2 class="polityka-h2">2. Cele, podstawy i okres przetwarzania danych</h2>

<h3 class="polityka-h3">2.1. Formularz kontaktowy, e-mail i telefon</h3>
<dl class="polityka-dl">
	<dt>Dane</dt><dd>imię i nazwisko, adres e-mail, numer telefonu (opcjonalnie), treść wiadomości oraz inne informacje, które zdecydujesz się przekazać.</dd>
	<dt>Cel</dt><dd>odpowiedź na wiadomość, umówienie sesji wstępnej, przygotowanie oferty.</dd>
	<dt>Podstawa prawna</dt><dd>art. 6 ust. 1 lit. b RODO (działania na Twoje żądanie przed zawarciem umowy) oraz art. 6 ust. 1 lit. f RODO (prawnie uzasadniony interes – prowadzenie korespondencji).</dd>
	<dt>Okres</dt><dd>przez czas prowadzenia korespondencji, a następnie nie dłużej niż 12 miesięcy od jej zakończenia, chyba że dojdzie do zawarcia umowy (wtedy stosuje się pkt 2.2).</dd>
</dl>

<h3 class="polityka-h3">2.2. Świadczenie usług (coaching, doradztwo zawodowe, Extended DISC®)</h3>
<dl class="polityka-dl">
	<dt>Dane</dt><dd>dane identyfikacyjne i kontaktowe, dane do rozliczeń (np. nazwa firmy, NIP), informacje niezbędne do przeprowadzenia sesji lub badania.</dd>
	<dt>Cel</dt><dd>zawarcie i wykonanie umowy, rozliczenia, wypełnienie obowiązków podatkowych i rachunkowych, ustalenie, dochodzenie lub obrona roszczeń.</dd>
	<dt>Podstawa prawna</dt><dd>art. 6 ust. 1 lit. b RODO (umowa), art. 6 ust. 1 lit. c RODO (obowiązki prawne), art. 6 ust. 1 lit. f RODO (roszczenia).</dd>
	<dt>Okres</dt><dd>przez czas trwania umowy, a następnie do upływu okresu przedawnienia roszczeń; dokumenty księgowe – przez 5 lat od końca roku, w którym upłynął termin płatności podatku.</dd>
</dl>
<p>Informacje przekazywane w trakcie sesji są poufne – pracuję zgodnie z Kodeksem Etyki ICF.</p>

<h3 class="polityka-h3">2.3. Newsletter (blog)</h3>
<dl class="polityka-dl">
	<dt>Dane</dt><dd>adres e-mail oraz imię, jeśli je podasz.</dd>
	<dt>Cel</dt><dd>wysyłka newslettera z informacjami o nowych wpisach i materiałach.</dd>
	<dt>Podstawa prawna</dt><dd>Twoja zgoda – art. 6 ust. 1 lit. a RODO.</dd>
	<dt>Okres</dt><dd>do czasu wycofania zgody (link „wypisz się” w każdej wiadomości lub kontakt ze mną).</dd>
</dl>
<p>Wysyłkę newslettera obsługuje w moim imieniu UAB „MailerLite” z siedzibą w Wilnie (Litwa).</p>

<h3 class="polityka-h3">2.4. Statystyki i marketing (pliki cookie – za Twoją zgodą)</h3>
<dl class="polityka-dl">
	<dt>Dane</dt><dd>identyfikatory zapisane w plikach cookie, informacje o urządzeniu i przeglądarce, odwiedzone podstrony, źródło wejścia na stronę, przybliżona lokalizacja (kraj, miasto).</dd>
	<dt>Cel</dt><dd>zbiorcze statystyki odwiedzin i rozwój strony (Google Analytics); działania marketingowe – wyłącznie wtedy, gdy zostaną uruchomione i wyrazisz na nie zgodę.</dd>
	<dt>Podstawa prawna</dt><dd>Twoja zgoda – art. 6 ust. 1 lit. a RODO w związku z art. 399 ustawy z dnia 12 lipca 2024 r. – Prawo komunikacji elektronicznej.</dd>
	<dt>Okres</dt><dd>do wycofania zgody, nie dłużej niż czas ważności plików cookie podany w wykazie (pkt 6). Dane w Google Analytics są przechowywane nie dłużej niż 14 miesięcy.</dd>
</dl>

<h3 class="polityka-h3">2.5. Bezpieczeństwo i prawidłowe działanie strony</h3>
<dl class="polityka-dl">
	<dt>Dane</dt><dd>adres IP, data i godzina wizyty, informacje o przeglądarce i systemie, adres wywołanej podstrony (logi serwera), a także dane analizowane przez Cloudflare w celu ochrony przed atakami i botami.</dd>
	<dt>Cel</dt><dd>zapewnienie bezpieczeństwa, dostępności i poprawnego działania strony.</dd>
	<dt>Podstawa prawna</dt><dd>art. 6 ust. 1 lit. f RODO (prawnie uzasadniony interes).</dd>
	<dt>Okres</dt><dd>przez okres przechowywania logów przez dostawców, nie dłużej niż 12 miesięcy.</dd>
</dl>

<h3 class="polityka-h3">2.6. Rejestr zgód na pliki cookie</h3>
<dl class="polityka-dl">
	<dt>Dane</dt><dd>losowy identyfikator zgody, data i godzina, dokonany wybór, adres podstrony, skrócony (zanonimizowany) adres IP, informacje o przeglądarce.</dd>
	<dt>Cel</dt><dd>wykazanie, że zgoda została wyrażona lub wycofana (art. 7 ust. 1 RODO).</dd>
	<dt>Podstawa prawna</dt><dd>art. 6 ust. 1 lit. c RODO (obowiązek prawny) oraz art. 6 ust. 1 lit. f RODO.</dd>
	<dt>Okres</dt><dd>24 miesiące od zapisania wyboru.</dd>
</dl>

<h3 class="polityka-h3">2.7. Profile w mediach społecznościowych</h3>
<p>Na stronie znajdują się wyłącznie odnośniki do moich profili na Facebooku i LinkedIn – nie osadzam wtyczek tych serwisów, więc do momentu kliknięcia odnośnika nie otrzymują one od strony żadnych danych. Po przejściu do serwisu obowiązują zasady prywatności Meta Platforms Ireland Ltd. oraz LinkedIn Ireland Unlimited Company. Jeśli napiszesz do mnie przez te serwisy, przetwarzam Twoje dane w celu odpowiedzi (art. 6 ust. 1 lit. f RODO). W zakresie statystyk mojego profilu na Facebooku jestem współadministratorem danych razem z Meta Platforms Ireland Ltd.</p>

<h3 class="polityka-h3">2.8. Czcionki Google Fonts</h3>
<p>Aby strona wyświetlała się spójnie, kroje pisma są pobierane z serwerów Google (Google Fonts). Przeglądarka łączy się wtedy z Google i przekazuje m.in. adres IP. Podstawą jest mój prawnie uzasadniony interes w czytelnej i spójnej prezentacji strony (art. 6 ust. 1 lit. f RODO).</p>

<h2 class="polityka-h2">3. Odbiorcy danych</h2>
<p>Dane mogą być przekazywane wyłącznie podmiotom, które pomagają mi prowadzić stronę i działalność, na podstawie umów powierzenia przetwarzania danych lub przepisów prawa:</p>
<ul class="polityka-lista">
	<li>dostawcy hostingu (serwer strony i obsługa poczty formularza),</li>
	<li>Cloudflare, Inc. – sieć dostarczania treści i ochrona przed atakami,</li>
	<li>Google Ireland Limited / Google LLC – poczta e-mail (Gmail), Google Tag Manager, Google Analytics, Google Fonts,</li>
	<li>UAB „MailerLite” – obsługa newslettera,</li>
	<li>podmiotom świadczącym usługi księgowe i prawne,</li>
	<li>organom publicznym – wyłącznie gdy wynika to z przepisów prawa.</li>
</ul>

<h2 class="polityka-h2">4. Przekazywanie danych poza Europejski Obszar Gospodarczy</h2>
<p>Google i Cloudflare mogą przetwarzać dane także w Stanach Zjednoczonych. Podstawą przekazania jest decyzja Komisji Europejskiej z 10 lipca 2023 r. stwierdzająca odpowiedni stopień ochrony w ramach EU-US Data Privacy Framework (w którym uczestniczą obie firmy), a uzupełniająco – standardowe klauzule umowne zatwierdzone przez Komisję Europejską.</p>

<h2 class="polityka-h2">5. Pliki cookie i zarządzanie zgodami</h2>

<h3 class="polityka-h3">5.1. Czym są pliki cookie</h3>
<p>Pliki cookie to niewielkie pliki tekstowe zapisywane w Twoim urządzeniu podczas korzystania ze strony. Pozwalają m.in. zapamiętać Twoje ustawienia, zapewnić bezpieczeństwo i – za Twoją zgodą – tworzyć statystyki odwiedzin. Pliki cookie dzielę na cztery kategorie: niezbędne, preferencje, statystyczne i marketingowe. Pliki niezbędne nie wymagają zgody, pozostałe zapisuję tylko wtedy, gdy się na nie zgodzisz.</p>

<h3 class="polityka-h3">5.2. Jak działa zgoda (Google Consent Mode v2)</h3>
<p>Przy pierwszej wizycie wyświetla się okno, w którym możesz zaakceptować wszystkie pliki cookie, odrzucić wszystkie (poza niezbędnymi) lub wybrać poszczególne kategorie. Do czasu podjęcia decyzji zapisywane są wyłącznie pliki niezbędne.</p>
<p>Strona korzysta z trybu uzyskiwania zgody Google (Consent Mode v2). Narzędzia Google otrzymują informację o Twoim wyborze w czterech obszarach: przechowywanie danych analitycznych, przechowywanie danych reklamowych, przekazywanie danych użytkownika do celów reklamowych oraz personalizacja reklam. Bez Twojej zgody narzędzia te nie zapisują plików cookie analitycznych ani reklamowych; mogą jedynie przesyłać ograniczone sygnały bez identyfikatorów (np. informację o wyświetleniu strony), służące do zbiorczego modelowania statystyk.</p>
<p>Twój wybór jest zapamiętywany na 12 miesięcy i obowiązuje zarówno na stronie, jak i na blogu. Po tym czasie lub po istotnej zmianie wykazu plików cookie poproszę o zgodę ponownie.</p>

<h3 class="polityka-h3">5.3. Zmiana lub wycofanie zgody</h3>
<p>Zgodę możesz w każdej chwili zmienić lub wycofać – przyciskiem „Zmień ustawienia” w pkt 6, odnośnikiem „Ustawienia cookies” w stopce strony albo ikoną w lewym dolnym rogu ekranu. Wycofanie zgody nie wpływa na zgodność z prawem przetwarzania, którego dokonano przed jej wycofaniem.</p>
<p>Pliki cookie możesz też zablokować lub usunąć w ustawieniach przeglądarki: <a href="https://support.google.com/chrome/answer/95647?hl=pl" target="_blank" rel="noopener">Chrome</a>, <a href="https://support.mozilla.org/pl/kb/W%C5%82%C4%85czanie%20i%20wy%C5%82%C4%85czanie%20obs%C5%82ugi%20ciasteczek" target="_blank" rel="noopener">Firefox</a>, <a href="https://support.apple.com/pl-pl/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a>, <a href="https://support.microsoft.com/pl-pl/microsoft-edge/usuwanie-plik%C3%B3w-cookie-w-przegl%C4%85darce-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Edge</a>, <a href="https://help.opera.com/pl/latest/web-preferences/#cookies" target="_blank" rel="noopener">Opera</a>. Zablokowanie plików niezbędnych może utrudnić korzystanie ze strony.</p>

<h2 class="polityka-h2">6. Wykaz plików cookie i Twoja zgoda</h2>
<div data-ewc-declaration></div>
<noscript><p>Aby zobaczyć aktualny wykaz plików cookie i zmienić ustawienia zgody, włącz w przeglądarce obsługę JavaScript.</p></noscript>

<h2 class="polityka-h2">7. Twoje prawa</h2>
<p>W związku z przetwarzaniem danych przysługuje Ci prawo do:</p>
<ul class="polityka-lista">
	<li>dostępu do swoich danych i otrzymania ich kopii (art. 15 RODO),</li>
	<li>sprostowania danych (art. 16 RODO),</li>
	<li>usunięcia danych (art. 17 RODO),</li>
	<li>ograniczenia przetwarzania (art. 18 RODO),</li>
	<li>przenoszenia danych (art. 20 RODO),</li>
	<li>sprzeciwu wobec przetwarzania opartego na prawnie uzasadnionym interesie (art. 21 RODO),</li>
	<li>wycofania zgody w dowolnym momencie, bez wpływu na zgodność z prawem wcześniejszego przetwarzania,</li>
	<li>wniesienia skargi do Prezesa Urzędu Ochrony Danych Osobowych (ul. Stawki 2, 00-193 Warszawa, <a href="https://uodo.gov.pl" target="_blank" rel="noopener">uodo.gov.pl</a>).</li>
</ul>
<p>Aby skorzystać ze swoich praw, napisz na <a href="mailto:<?= $mail ?>"><?= $mail ?></a> lub skorzystaj z <a href="<?= e(page_url($lang, 'kontakt')) ?>">formularza kontaktowego</a>.</p>

<h2 class="polityka-h2">8. Dobrowolność podania danych i zautomatyzowane decyzje</h2>
<p>Podanie danych jest dobrowolne, ale niezbędne do udzielenia odpowiedzi na wiadomość lub zawarcia umowy. Nie podejmuję decyzji w sposób wyłącznie zautomatyzowany, w tym nie stosuję profilowania wywołującego wobec Ciebie skutki prawne (art. 22 RODO).</p>

<h2 class="polityka-h2">9. Bezpieczeństwo danych</h2>
<p>Strona korzysta z szyfrowanego połączenia (HTTPS). Stosuję środki techniczne i organizacyjne odpowiednie do ryzyka, aby chronić dane przed nieuprawnionym dostępem, utratą lub zmianą.</p>

<h2 class="polityka-h2">10. Zmiany polityki prywatności</h2>
<p>Polityka może być aktualizowana, np. w związku ze zmianą przepisów lub wykorzystywanych narzędzi. Aktualna wersja jest zawsze dostępna na tej stronie, a data jej obowiązywania znajduje się na początku dokumentu. Jeśli zmiana będzie dotyczyć plików cookie wymagających zgody, poproszę Cię o nią ponownie.</p>
<!--ewc-policy-end-->
</div>

                                        </div>

                                </div>
