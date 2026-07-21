# Instrukcja: formularz kontaktowy i panel aktualizacji

## Formularz kontaktowy

Formularz znajduje się na stronach kontakt (PL, EN, FR) i wysyła wiadomości
na adres ustawiony w pliku `ajax_email/send.php` (zmienna `$to`).
Wysyłka działa przez funkcję `mail()` PHP — na większości hostingów działa
od razu, bez konfiguracji.

Formularz ma wbudowaną ochronę antyspamową (ukryte pole-pułapkę na boty)
oraz walidację pól. Wersje językowe EN i FR mają własne kopie skryptu
w `eng/ajax_email/` i `fr/ajax_email/`.

## Panel aktualizacji (update.php)

### Pierwsze uruchomienie

1. Otwórz plik `update.php` w edytorze.
2. W linii `define('UPDATE_PASSWORD', 'zmien-to-haslo');` wpisz własne,
   trudne hasło (panel jest zablokowany, dopóki hasło jest domyślne).
3. Wgraj plik do katalogu głównego strony na serwerze (tam gdzie `index.html`).
4. Otwórz w przeglądarce: `https://twoja-domena.pl/update.php`.

### Co robi panel

- **Aktualizuj z GitHuba** — pobiera najnowszą wersję strony z repozytorium
  (`picabela/ewacouch`, gałąź `main`) i nadpisuje pliki na serwerze.
  **Przed każdą aktualizacją automatycznie tworzy kopię zapasową.**
- **Utwórz kopię zapasową** — ręcznie pakuje całą stronę do pliku ZIP
  w folderze `_backups`. Przechowywanych jest maksymalnie **5 ostatnich kopii**
  (najstarsze są usuwane automatycznie).
- **Przywróć** — przywraca stronę z wybranej kopii zapasowej.
- **Usuń** — kasuje wybraną kopię.

Panel pokazuje też, jaka wersja jest zainstalowana i czy na GitHubie
jest nowsza.

### Czego aktualizacja nigdy nie rusza

- `_backups/` — folder kopii zapasowych (dodatkowo zabezpieczony przed
  dostępem z przeglądarki plikiem `.htaccess`),
- `blog/` — blog to osobna instalacja, nie ma go w repozytorium,
- `update.php` — sam panel (żeby aktualizacja nie wyzerowała hasła).

### Typowy scenariusz pracy

1. Wprowadzasz zmiany na GitHubie (edycja plików w repozytorium).
2. Wchodzisz na `update.php`, logujesz się.
3. Klikasz **Aktualizuj z GitHuba** — gotowe.
4. Jeśli coś poszło nie tak — klikasz **Przywróć** przy ostatniej kopii.
