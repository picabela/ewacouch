# ewedrychowska-coaching.pl

Strona Ewy Wędrychowskiej (coaching kariery, doradztwo zawodowe) przeniesiona
ze statycznego HTML na PHP. Wygląd strony pozostał bez zmian - zmienił się
wyłącznie kod (backend) oraz adresy URL na przyjazne SEO.

## Struktura projektu

```
index.php            front controller - obsługuje wszystkie przyjazne adresy URL
sitemap.php          dynamicznie generowana mapa strony (dostępna pod /sitemap.xml)
robots.txt           wskazówki dla robotów + adres sitemapy
.htaccess            przyjazne URL-e, przekierowania 301 z *.html, kompresja, cache
dev-router.php       router do lokalnego testowania (php -S localhost:8080 dev-router.php)
whcookies.js         pasek informacji o cookies (tylko polska strona główna)

includes/
  config.php         CAŁA konfiguracja: adres strony, dane kontaktowe, Google
                     Analytics, menu i rejestr podstron (title, description itd.)
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

Stare adresy `*.html` są przekierowywane (301) na nowe, przyjazne adresy:

| stary adres            | nowy adres        |
|------------------------|-------------------|
| `/index.html`          | `/`               |
| `/omnie.html`          | `/omnie`          |
| `/eng/kontakt.html`    | `/eng/kontakt`    |
| `/fr/coaching-kariery.html` | `/fr/coaching-kariery` |

## SEO

- **Przyjazne URL-e** bez rozszerzeń + przekierowania 301 ze starych adresów
- **robots.txt** z adresem sitemapy
- **sitemap.xml** generowana automatycznie z rejestru podstron (`sitemap.php`)
- **Dane strukturalne** schema.org (JSON-LD): ProfessionalService, WebSite,
  WebPage, BreadcrumbList - na każdej podstronie
- **Canonical** i **hreflang** (pl/en/fr + x-default) na każdej podstronie
- Tagi `title` i `meta description` przeniesione 1:1 ze starej strony
- Strona 404 z poprawnym kodem odpowiedzi i `noindex`

## Jak edytować

- **Treść podstrony** - edytuj odpowiedni plik w `templates/<język>/`.
- **Title / description / nowa podstrona** - rejestr `$pages`
  w `includes/config.php` (sitemapa i hreflang zaktualizują się same;
  dla nowej podstrony dodaj też plik szablonu w `templates/`).
- **Telefon, e-mail, adres** - tablica `$contact` w `includes/config.php`
  (używana na stronach kontaktu, w stopce i danych strukturalnych).
- **Pozycje menu** - tablice `nav` w `includes/config.php`.
- **Domena** - stała `BASE_URL` w `includes/config.php` oraz adres sitemapy
  w `robots.txt`.

## Uruchomienie lokalne

```
php -S localhost:8080 dev-router.php
```

## Wdrożenie

Wymagany serwer Apache z `mod_rewrite` i PHP (7.4+). Wystarczy wgrać pliki
do katalogu głównego domeny. Po upewnieniu się, że domena ma certyfikat SSL,
warto odkomentować blok wymuszający `https` na końcu pliku `.htaccess`.
