=== EW Zgody Cookies (Consent Mode v2) ===
Requires at least: 4.7
Tested up to: 7.1
Requires PHP: 5.4
Stable tag: 1.1.0
License: GPL-2.0-or-later

Okno zgód cookies i Google Consent Mode v2 dla bloga – wspólne ze stroną
główną ewedrychowska-coaching.pl.

== Jak to działa ==

* Baner, panel ustawień, wygląd i wykaz plików cookie są wczytywane ze strony
  głównej (/consent/consent.js i consent.css). Blog zawsze ma więc tę samą
  wersję co strona – aktualizujesz tylko stronę główną.
* Zgoda jest zapisywana w ciasteczku ew_consent dla całej domeny, więc
  wybór dokonany na stronie obowiązuje też na blogu (i odwrotnie).
* Domyślne zgody Consent Mode v2 są wstawiane zaraz za znacznikiem <head>,
  czyli PRZED Google Tag Managerem wpisanym w motywie – nie trzeba edytować
  plików motywu. Jeśli motyw nie ma GTM, wtyczka doda kontener z ustawień.
* Każdy wybór trafia do rejestru zgód strony głównej (_backups/zgody/).

== Instalacja ==

Gotowy plik do wgrania: wordpress-plugin/ew-zgody-cookies.zip w repozytorium
(na GitHubie: otwórz plik -> przycisk „Download raw file”).
Przetestowana na WordPress 7.1.2 z PHP 8.4 oraz zgodna ze starszym WP 4.7 / PHP 5.6.

1. Kokpit bloga → Wtyczki → Dodaj nową → Wyślij wtyczkę na serwer →
   wybierz plik ew-zgody-cookies.zip → Zainstaluj → Włącz.
2. Wtyczki → wyłącz starą wtyczkę „Cookie Consent” (uk-cookie-consent),
   żeby nie było dwóch pasków.
3. (Opcjonalnie) Ustawienia → Zgody cookies – domyślne wartości są już
   poprawne dla tego bloga.
4. (Opcjonalnie) Strony → Dodaj nową „Polityka prywatności”, w treści wpisz
   [ew_polityka_prywatnosci]. Strona pokaże tę samą politykę co strona
   główna (bez indeksowania w Google, żeby nie dublować treści).
5. (Opcjonalnie) Wygląd → Menu → „Własne odnośniki”: adres
   #ustawienia-cookies, tekst „Ustawienia cookies”.

== Shortcody ==

[ew_polityka_prywatnosci]  – pełna polityka prywatności ze strony głównej
[ew_ustawienia_cookies]    – odnośnik otwierający okno zgód
[ew_deklaracja_cookies]    – wykaz plików cookie z aktualnym stanem zgody

== Uwaga dla programisty ==

consent-init.js w tym folderze to kopia pliku /consent/consent-init.js ze
strony głównej. Wtyczka używa pliku ze strony, jeśli znajdzie go na serwerze
(blog w podkatalogu /blog), a kopii tylko awaryjnie – przy zmianach aktualizuj
oba pliki.
