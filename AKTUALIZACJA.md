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
3. Wgraj plik do katalogu głównego strony na serwerze (tam gdzie `index.php`).
4. Otwórz w przeglądarce: `https://twoja-domena.pl/update.php`.

### Co robi panel

- **Aktualizuj z GitHuba** — pobiera najnowszą wersję strony z repozytorium
  (`picabela/ewacouch`, gałąź `main`) i nadpisuje pliki na serwerze.
  **Przed każdą aktualizacją automatycznie tworzy kopię zapasową.**
- **Utwórz kopię zapasową** — ręcznie pakuje całą stronę do pliku ZIP
  w folderze `_backups`.
- **Limit kopii** — w polu „Przechowuj ostatnich kopii" ustawiasz, ile kopii
  ma być trzymanych (1–100). Gdy liczba przekroczy limit, najstarsze są
  usuwane automatycznie. Ustawienie zapisuje się w `_backups/settings.json`
  i przetrwa aktualizacje.
- **Pobierz** — ściąga wybraną kopię ZIP na dysk (np. na wszelki wypadek).
- **Przywróć** — doprowadza stronę **dokładnie** do stanu z wybranej kopii:
  nadpisuje zmienione pliki, dodaje brakujące i **usuwa nadmiarowe** (te,
  których w kopii nie było). Dzięki temu na serwerze nie zostają śmieci.
  **Przed przywróceniem robiona jest automatyczna kopia bezpieczeństwa**
  obecnego stanu, więc operację można cofnąć — po przywróceniu starszej
  kopii możesz w każdej chwili przywrócić nowszą.
- **Usuń** — kasuje wybraną kopię.

Panel pokazuje też **numer wersji** strony (np. `1.0`) oraz wersję, z której
pochodzi każda kopia zapasowa (kolumna „Wersja").

### Pliki chronione (menedżer)

Na dole panelu jest lista plików i folderów z katalogu głównego z polami do
zaznaczenia. **Zaznaczone = chronione** — aktualizacja, kopie i przywracanie
ich nie dotykają (nie nadpiszą ani nie usuną). Zaznacz tu wszystko, co wgrałeś
ręcznie przez FTP, a co nie należy do strony (np. `faktura.pdf`), żeby
przywracanie starszej wersji nie skasowało tych plików.

Pozycje z kłódką (`_backups`, `.git`, `update.php`) są chronione zawsze i nie
da się ich odznaczyć. Wybór zapisuje się w `_backups/settings.json` i przetrwa
aktualizacje.

Uwaga: plik oznaczony jako chroniony **nie jest zapisywany w kopiach** (skoro
narzędzie ma go nie dotykać). Jeśli chcesz, żeby jakiś plik był objęty kopiami
zapasowymi, zostaw go bez ochrony.

### Numery wersji i powrót do starszej wersji na GitHubie

Numery wersji i przypisane im stany repozytorium są w pliku `wersje.json`.
Jeśli chcesz trwale wrócić do starszej wersji (nie tylko na serwerze, ale też
tak, żeby kolejne „Aktualizuj z GitHuba" nie przywróciło nowszej), podaj
numer wersji z panelu osobie zarządzającej repozytorium (lub Claude'owi) —
na podstawie `wersje.json` można cofnąć gałąź `main` do dokładnie tego stanu.

### Czego aktualizacja nigdy nie rusza

- `_backups/` — folder kopii zapasowych (dodatkowo zabezpieczony przed
  dostępem z przeglądarki plikiem `.htaccess`),
- `blog/` — blog to osobna instalacja, nie ma go w repozytorium,
- `update.php` — sam panel (żeby aktualizacja nie wyzerowała hasła).

### Typowy scenariusz pracy

1. Wprowadzasz zmiany na GitHubie (edycja plików w repozytorium).
2. Wchodzisz na `update.php`, logujesz się.
3. Klikasz **Aktualizuj z GitHuba** — gotowe.
4. Jeśli coś poszło nie tak — klikasz **Przywróć** przy ostatniej dobrej kopii.
   Strona wróci dokładnie do tamtego stanu, a obecny stan i tak zostanie
   zapisany jako kopia bezpieczeństwa (możesz go później przywrócić).
