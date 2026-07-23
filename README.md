# Uniwersalny panel aktualizacji z GitHuba (`update.php`)

Jeden plik PHP, który wgrywasz do **dowolnego** projektu na serwerze. Pozwala
**jednym kliknięciem** pobrać najnowszą wersję projektu z repozytorium GitHub,
z **automatycznymi kopiami zapasowymi** i **bezpiecznym przywracaniem**.
Nie wymaga bazy danych, Composera ani niczego poza PHP.

> Ten sam mechanizm działa produkcyjnie na stronie ewedrychowska-coaching.pl —
> tutaj jest wydzielony jako niezależne, uniwersalne narzędzie do wielokrotnego
> użytku.

---

## Wymagania

- **PHP 5.4+** z rozszerzeniem **`zip`** (klasa `ZipArchive`).
- Serwer z **dostępem do internetu** (do pobrania paczki z GitHuba).
- Prawo zapisu w katalogu projektu (do nadpisywania plików i tworzenia `_backups`).

Repozytorium GitHub może być **publiczne** (działa od razu). Dla prywatnego
patrz sekcja „Repozytoria prywatne" poniżej.

## Instalacja (3 kroki)

1. Skopiuj **`update.php`** do katalogu głównego projektu (tam, gdzie
   `index.php` / `index.html`).
2. Otwórz plik w edytorze i uzupełnij **konfigurację** na górze:
   ```php
   define('UPDATE_PASSWORD', 'twoje-trudne-haslo');   // KONIECZNIE zmień
   define('GITHUB_REPO',   'wlasciciel/repozytorium'); // np. 'jan/moja-strona'
   define('GITHUB_BRANCH', 'main');                    // gałąź do pobierania
   ```
   Dopóki hasło jest domyślne (`zmien-to-haslo`), panel jest **zablokowany**.
3. Wejdź w przeglądarce na `https://twoja-domena.pl/update.php` i zaloguj się.

Gotowe. Folder `_backups` utworzy się sam przy pierwszej kopii (jest chroniony
przed dostępem z przeglądarki plikiem `.htaccess`).

## Co potrafi panel

- **Aktualizuj z GitHuba** — pobiera najnowszą wersję z wybranej gałęzi
  i nadpisuje pliki. **Przed aktualizacją automatycznie robi kopię zapasową.**
- **Utwórz kopię zapasową** — ręczny ZIP całego projektu do `_backups`.
- **Limit kopii** — ile kopii przechowywać (1–100); najstarsze kasują się same.
  Ustawienie zapisywane jest w `_backups/settings.json` i przetrwa aktualizacje.
- **Pobierz** — ściąga wybraną kopię ZIP na dysk.
- **Przywróć** — doprowadza projekt **dokładnie** do stanu z kopii (nadpisuje
  zmienione, dodaje brakujące, **usuwa nadmiarowe** — bez śmieci). **Przed
  przywróceniem robi kopię bezpieczeństwa**, więc operację można cofnąć
  (przywrócić nowszą kopię).
- **Usuń** — kasuje wybraną kopię.
- **Pliki chronione** — lista plików/folderów z katalogu głównego z polami do
  zaznaczenia (patrz niżej).

## Pliki chronione (ważne!)

Aktualizacja, kopie i przywracanie **nigdy nie dotykają** ścieżek chronionych.
Są dwie grupy:

- **Rdzeń (zawsze chroniony, z kłódką)** — `_backups`, `.git`, `update.php`.
  Nie da się ich odznaczyć (odznaczenie groziłoby skasowaniem kopii lub samego
  panelu przy przywracaniu).
- **Twoje pliki** — wszystko, co wgrałeś ręcznie i czego **nie ma w repozytorium**
  (np. osobny blog, folder z uploadami, lokalny `config.php` z hasłami). Zaznacz
  je w panelu w sekcji „Pliki chronione" **albo** wpisz na stałe w konfiguracji:
  ```php
  $GLOBALS['DEFAULT_PROTECTED'] = array(
      'blog',
      'uploads',
      'config.php',
  );
  ```

> Uwaga: plik oznaczony jako chroniony **nie trafia do kopii zapasowych**
> (skoro narzędzie ma go nie dotykać). Jeśli chcesz, żeby plik był objęty
> kopiami, zostaw go bez ochrony.

## Jak działa przywracanie (bezpieczeństwo)

Przywrócenie starszej kopii:
1. tworzy **kopię bezpieczeństwa** obecnego stanu (żeby dało się cofnąć),
2. odtwarza **dokładny** stan z wybranej kopii — łącznie z usunięciem plików,
   których w tamtej kopii nie było (poza chronionymi),
3. dzięki temu można swobodnie skakać między starszą a nowszą wersją, a serwer
   nie „śmieci" plikami z różnych wersji.

## (Opcjonalnie) Numery wersji

Jeśli w repozytorium umieścisz plik **`wersje.json`**, panel pokaże numer
aktualnej wersji oraz wersję, z której pochodzi każda kopia. Format:

```json
{
    "aktualna": "1.0",
    "wersje": [
        { "nr": "1.0", "commit": "abc1234", "data": "2026-01-01", "opis": "..." }
    ]
}
```

Bez tego pliku panel działa normalnie — w kolumnie „Wersja" pokazuje „—".

## Repozytoria prywatne

Domyślnie narzędzie pobiera z publicznego GitHuba (bez tokenu). Dla repo
prywatnego trzeba dodać nagłówek autoryzacji z tokenem (Personal Access Token)
w funkcjach pobierających — daj znać, jeśli tego potrzebujesz, to dopiszę
obsługę tokenu.

## Bezpieczeństwo

- Panel chroniony **hasłem** + token **CSRF** na akcjach; sesja PHP.
- Spowolnienie prób logowania (2 s po błędnym haśle).
- Folder `_backups` zablokowany przed dostępem z przeglądarki (`.htaccess`
  + `index.html`), więc kopii nie da się pobrać bez zalogowania.
- Rozpakowywanie ZIP zabezpieczone przed wyjściem poza katalog (`../`).
- **`update.php` nie jest nadpisywany** przez aktualizację (jest w rdzeniu
  chronionym) — dlatego jego nowszą wersję trzeba wgrać ręcznie przez FTP.
  Jeśli chcesz, żeby panel aktualizował się sam, wynieś hasło do osobnego pliku
  (np. `update-config.php`) i usuń `update.php` z listy chronionej.

## Zmiana hasła / konfiguracji po wdrożeniu

Wszystkie ustawienia są na górze `update.php`. Po zmianie wgraj plik ponownie
przez FTP. Limit kopii i listę plików chronionych można też zmieniać wygodnie
z poziomu panelu (zapisują się w `_backups/settings.json`).

## Najczęstsze problemy

- **„Brak rozszerzenia PHP zip"** — poproś hosting o włączenie `ext-zip`.
- **„Nie udało się pobrać z GitHuba"** — serwer nie ma dostępu do internetu
  albo repo/gałąź są błędne; sprawdź `GITHUB_REPO` i `GITHUB_BRANCH`.
- **Panel zablokowany** — nie zmieniono domyślnego hasła.
- **Kopie się nie tworzą** — brak prawa zapisu w katalogu (ustaw uprawnienia
  katalogu, np. 755, i właściciela zgodnego z użytkownikiem PHP).
