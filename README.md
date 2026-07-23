# ewedrychowska-coaching.pl

Strona Ewy Wędrychowskiej (coaching kariery, doradztwo zawodowe) przeniesiona
ze statycznego HTML na PHP. Wygląd strony pozostał bez zmian - zmienił się
wyłącznie kod (backend) oraz adresy URL na przyjazne SEO.

---

## Zakres wykonanych prac 

Poniżej zestawienie wszystkich wprowadzonych zmian i nowych funkcji. Całość
została wykonana **bez zmiany wyglądu strony** - dotychczasowy layout, kolory
i treści pozostały nienaruszone.

### 1. Uporządkowanie i modernizacja strony
- Przeniesienie strony ze statycznego HTML na **nowoczesny system PHP z szablonami**
  - jedna wspólna „ramka" (menu, nagłówek, stopka) dla wszystkich podstron;
  zmiany wprowadza się w jednym miejscu, a nie w kilkunastu plikach osobno.
- **Przyjazne adresy URL** (bez końcówki `.html`) z automatycznym
  przekierowaniem **301** ze starych adresów - bez utraty pozycji w Google.
- Rok w stopce aktualizowany automatycznie; dodany **favicon** (ikona w karcie
  przeglądarki).

### 2. Formularz kontaktowy (PL / EN / FR)
- Działający formularz na stronie kontaktu we wszystkich trzech językach
  (imię, e-mail, telefon, wiadomość), wysyłany **bez przeładowania strony**.
- **Ochrona antyspamowa** (ukryta pułapka na boty) oraz walidacja pól.
- Poprawna obsługa polskich znaków i nagłówek „Reply-To" - można odpowiadać
  wprost z poczty.

### 3. Sekcja FAQ (najczęściej zadawane pytania)
- Nowa zakładka **FAQ** w menu, podzielona na **7 sekcji tematycznych** (oferta
  i kontakt, coaching kariery, executive coaching, rozwój lidera po awansie,
  life coaching, metoda pracy, Extended Disc).
- Wygodna **rozwijana „harmonijka"** - pytania rozwijają się po kliknięciu sekcji.
- **Linkowanie wewnętrzne** do odpowiednich podstron oferty (lepsza nawigacja i SEO).
- **Dane strukturalne FAQ** (schema.org) - Google może pokazywać pytania
  i odpowiedzi bezpośrednio w wynikach wyszukiwania.
- FAQ dostępne również w wersji **angielskiej i francuskiej**.

### 4. Pełna wielojęzyczność i przetłumaczone adresy
- Wersje **angielska i francuska** z przetłumaczoną treścią (w tym FAQ).
- **Przetłumaczone adresy URL** w każdym języku (np. `/eng/about-me`,
  `/fr/coaching-de-carriere`) - lepsze dla SEO i czytelności; stare adresy
  automatycznie przekierowane (301).

### 5. SEO (widoczność w Google)
- Poprawna **struktura nagłówków** (jeden `H1` na stronie, logiczna hierarchia).
- **Mapa strony** (`sitemap.xml`) generowana automatycznie po dodaniu podstron.
- **Dane strukturalne** (schema.org / JSON-LD), **canonical** oraz **hreflang**
  (pl / en / fr) na każdej podstronie.
- Osobne, dopracowane tytuły (`title`) i opisy (`meta description`) stron.

### 6. Wydajność i szybkość (Google PageSpeed, zwłaszcza telefony)
- **Kompresja głównego zdjęcia** strony głównej o ok. **66%** (bez widocznej
  różnicy jakości) - szybsze ładowanie i lepszy wynik LCP.
- Obrazki z **rezerwacją miejsca** (koniec „przeskakiwania" treści przy
  ładowaniu), leniwym ładowaniem oraz priorytetem dla elementu głównego.
- **Optymalizacja czcionek** (tekst widoczny od razu, mniej blokowania
  renderowania), dłuższy **cache** plików, usunięcie zbędnego, nieaktywnego
  kodu (stare Universal Analytics).

### 7. Dostępność (WCAG) i gotowość pod agenty AI
- Znacznik **`<main>`**, opisy linków i obrazków (`aria-label`, `alt`) - strona
  lepiej odczytywana przez czytniki ekranu i narzędzia AI.
- Bezpieczne linki otwierane w nowej karcie (`rel="noopener"`).

### 8. Analityka
- Wpięty **Google Tag Manager** (kontener `GTM-TMX8NZXM`) - dalsze tagi
  (Google Analytics 4, piksele, zdarzenia) konfiguruje się już w panelu GTM,
  bez ingerencji w kod strony.

### 9. Panel aktualizacji i kopie zapasowe (dla właściciela strony)
- **`update.php`** - panel chroniony hasłem do **aktualizacji strony z GitHuba
  jednym kliknięciem**.
- **Automatyczne kopie zapasowe** (ZIP) przed każdą aktualizacją; konfigurowalny
  limit kopii; **pobieranie** i **bezpieczne przywracanie** dowolnej kopii
  (z automatyczną kopią bezpieczeństwa - operację zawsze można cofnąć).
- **Menedżer plików chronionych** - pliki wgrane ręcznie (np. dokumenty) można
  oznaczyć jako nietykalne, żeby aktualizacja ich nie usuwała.
- **Numery wersji** strony - każdą zmianę można w razie potrzeby przywrócić do
  wcześniejszego stanu (historia w pliku `wersje.json`).

> Szczegółowa historia kolejnych wersji znajduje się w pliku `wersje.json`,
> a instrukcja obsługi panelu aktualizacji w `AKTUALIZACJA.md`.

---

## Struktura projektu

```
index.php            front controller - obsługuje wszystkie przyjazne adresy URL
sitemap.php          dynamicznie generowana mapa strony (dostępna pod /sitemap.xml)
robots.txt           wskazówki dla robotów + adres sitemapy
.htaccess            przyjazne URL-e, przekierowania 301 z *.html, kompresja, cache
dev-router.php       router do lokalnego testowania (php -S localhost:8080 dev-router.php)
diagnostyka.php      strona diagnostyczna instalacji (otwórz /diagnostyka.php na serwerze)
update.php           panel aktualizacji strony z GitHuba (opis w AKTUALIZACJA.md)
whcookies.js         pasek informacji o cookies (tylko polska strona główna)
wersje.json          rejestr wersji strony (numer -> commit); pokazywany w update.php
AKTUALIZACJA.md      instrukcja obsługi panelu aktualizacji i kopii zapasowych

includes/
  config.php         CAŁA konfiguracja: adres strony, dane kontaktowe, Google Tag
                     Manager (GTM_ID), menu, przetłumaczone adresy (slug) i rejestr
                     podstron (title, description itd.)
  header.php         wspólny <head> (SEO: canonical, hreflang, JSON-LD) + menu boczne
  footer.php         wspólna stopka

templates/
  pl/  en/  fr/      treść podstron (jeden plik = jedna podstrona)
  404.php            strona błędu 404 (wspólna, wielojęzyczna)

css/ images/         zasoby wersji polskiej
eng/ fr/             zasoby wersji angielskiej i francuskiej (css, images, ajax_email)
ajax_email/          skrypt wysyłki e-maili (formularz kontaktowy)
```

## Adresy URL

Stare adresy `*.html` są przekierowywane (301) na nowe, przyjazne adresy.
Dodatkowo adresy podstron w wersji angielskiej i francuskiej są przetłumaczone
(dawne polskie adresy w tych wersjach również są przekierowane 301):

| stary adres                 | nowy adres              |
|-----------------------------|-------------------------|
| `/index.html`               | `/`                     |
| `/omnie.html`               | `/omnie`                |
| `/eng/omnie` (lub `.html`)  | `/eng/about-me`         |
| `/eng/kontakt`              | `/eng/contact`          |
| `/fr/coaching-kariery`      | `/fr/coaching-de-carriere` |
| `/fr/kontakt`               | `/fr/contact`           |

Przetłumaczone adresy konfiguruje pole `slug` w rejestrze `$pages`
(`includes/config.php`); wewnętrzne nazwy plików szablonów pozostają bez zmian.

## SEO

- **Przyjazne URL-e** bez rozszerzeń + przekierowania 301 ze starych adresów
- **robots.txt** z adresem sitemapy
- **sitemap.xml** generowana automatycznie z rejestru podstron (`sitemap.php`)
- **Dane strukturalne** schema.org (JSON-LD): ProfessionalService, WebSite,
  WebPage, BreadcrumbList - na każdej podstronie; dodatkowo **FAQPage** na
  stronie FAQ (możliwość wyświetlenia pytań i odpowiedzi w wynikach Google)
- **Canonical** i **hreflang** (pl/en/fr + x-default) na każdej podstronie
- Poprawna **struktura nagłówków** (jeden `H1`, hierarchia `H2`/`H3`)
- Przetłumaczone, przyjazne adresy URL dla wersji EN/FR
- Tagi `title` i `meta description` dopasowane do każdej podstrony
- Strona 404 z poprawnym kodem odpowiedzi i `noindex`

## Jak edytować

- **Treść podstrony** - edytuj odpowiedni plik w `templates/<język>/`.
- **Title / description / nowa podstrona** - rejestr `$pages`
  w `includes/config.php` (sitemapa i hreflang zaktualizują się same;
  dla nowej podstrony dodaj też plik szablonu w `templates/`).
- **Telefon, e-mail, adres** - tablica `$contact` w `includes/config.php`
  (używana na stronach kontaktu, w stopce i danych strukturalnych).
- **Pozycje menu** - tablice `nav` w `includes/config.php`.
- **Domena / podkatalog** - wykrywane automatycznie. W razie potrzeby można
  je wpisać na stałe (`BASE_URL`, `BASE_PATH` na początku
  `includes/config.php`). Adres sitemapy w `robots.txt` jest wpisany ręcznie -
  zmień go, jeśli zmieni się domena.

## Uruchomienie lokalne

```
php -S localhost:8080 dev-router.php
```

## Wdrożenie

Wymagany serwer Apache z `mod_rewrite` i PHP (7.4+).

1. Wgraj **wszystkie** pliki - łącznie z ukrytymi plikami `.htaccess`
   (w katalogu głównym oraz w `includes/` i `templates/`). Klienty FTP
   często domyślnie ukrywają pliki zaczynające się od kropki!
2. Strona może działać w katalogu głównym domeny **lub w podkatalogu**
   (np. `domena.pl/testowe/`) - podkatalog i domena wykrywane są
   automatycznie, niczego nie trzeba zmieniać.
3. `robots.txt` i `sitemap.xml` są brane pod uwagę przez Google tylko
   z katalogu głównego domeny - w podkatalogu testowym to bez znaczenia.
4. Po upewnieniu się, że domena ma certyfikat SSL, warto odkomentować
   blok wymuszający `https` na końcu pliku `.htaccess`.

## Rozwiązywanie problemów

Jeśli po wgraniu strona nie działa (błąd 404/500 na podstronach), otwórz
w przeglądarce **`adres-strony/diagnostyka.php`** - strona sama sprawdzi
serwer (PHP, pliki .htaccess, mod_rewrite, wykrywanie ścieżki) i powie,
co naprawić. Po rozwiązaniu problemu usuń plik `diagnostyka.php` z serwera.

Najczęstsze przyczyny: brak wgranego pliku `.htaccess` (ukryte pliki
w kliencie FTP!) lub wyłączona obsługa `.htaccess` na hostingu (opcja
`AllowOverride` - do włączenia w panelu hostingu lub u administratora).
