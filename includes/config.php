<?php
/**
 * Konfiguracja strony - to jedyny plik, który trzeba edytować przy zmianie
 * adresu strony, danych kontaktowych albo dodawaniu nowych podstron.
 *
 * Kod jest zgodny ze starszymi wersjami PHP (5.4+), żeby działał
 * na każdym hostingu współdzielonym.
 */

if (!defined('EW_SITE')) {
    http_response_code(404);
    exit;
}

/*
 * Podkatalog instalacji - wykrywany automatycznie, więc strona działa
 * zarówno w katalogu głównym domeny, jak i w podkatalogu (np. /testowe).
 * W razie potrzeby można go wpisać na stałe, odkomentowując linię poniżej:
 */
// define('BASE_PATH', '/testowe');

if (!defined('BASE_PATH')) {
    $basePath = null;

    /* 1) Na podstawie położenia katalogu strony względem katalogu głównego
       domeny - najpewniejsza metoda, działa też na PHP w trybie CGI. */
    if (!empty($_SERVER['DOCUMENT_ROOT'])) {
        $docRoot  = realpath($_SERVER['DOCUMENT_ROOT']);
        $docRoot  = rtrim(str_replace('\\', '/', $docRoot ? $docRoot : $_SERVER['DOCUMENT_ROOT']), '/');
        $siteRoot = str_replace('\\', '/', dirname(__DIR__));
        if ($docRoot !== '' && strpos($siteRoot, $docRoot) === 0) {
            $basePath = substr($siteRoot, strlen($docRoot));
        }
    }

    /* 2) Awaryjnie: ze ścieżki wykonywanego skryptu. */
    if ($basePath === null) {
        $scriptName = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : '';
        $basePath   = preg_replace('#/((eng|fr)/)?(index|sitemap)\.php$#', '', $scriptName);
        if ($basePath === $scriptName) {
            $basePath = ''; // nieoczekiwany format -> przyjmij katalog główny
        }
    }

    define('BASE_PATH', rtrim($basePath, '/'));
}

/*
 * Adres strony: protokół + domena (bez ścieżki i bez ukośnika na końcu).
 * Wykrywany automatycznie; do canonical, sitemapy i danych strukturalnych.
 * Można wpisać na stałe, odkomentowując linię poniżej:
 */
// define('BASE_URL', 'https://ewedrychowska-coaching.pl');

if (!defined('BASE_URL')) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'ewedrychowska-coaching.pl';
    define('BASE_URL', $scheme . '://' . $host);
}

/* Identyfikator Google Analytics */
define('GA_ID', 'UA-85549321-1');

/*
 * Wersja zasobów statycznych (CSS/JS) - dopisywana do adresów jako ?v=...
 * Wymusza na przeglądarkach pobranie świeżych plików zamiast starych z pamięci
 * podręcznej. Zwiększ tę liczbę po KAŻDEJ zmianie w plikach CSS lub JS.
 */
define('ASSET_VERSION', '4');

/* Dane kontaktowe / firmowe (kontakt, stopka, dane strukturalne) */
$contact = array(
    'name'     => 'Ewa Wędrychowska',
    'phone'    => '+48 784092880',
    'email'    => 'ewawedry111@gmail.com',
    'street'   => 'ul. Wiedeńska 28',
    'postcode' => '30-147',
    'city'     => 'Kraków',
    'facebook' => 'https://www.facebook.com/Ewa-W%C4%99drychowska-coaching-kariery-doradztwo-zawodowe-1385304564851786/',
    'linkedin' => 'https://www.linkedin.com/in/ewa-w%C4%99drychowska-a1b766105/',
);

/*
 * Konfiguracja wersji językowych.
 *  dir - podkatalog URL ('' = katalog główny); stąd też ładowane są
 *        zasoby danej wersji (css/images/ajax_email)
 *  nav - pozycje menu: [slug, etykieta, atrybut title]
 *        slug zaczynający się od '/' to link zewnętrzny (np. blog)
 *  business_name / job_title - teksty w danych strukturalnych (JSON-LD)
 */
$languages = array(
    'pl' => array(
        'dir'           => '',
        'html_lang'     => 'pl',
        'h2'            => 'coach kariery<br>doradca zawodowy',
        'nav_span'      => false,
        'copyright'     => true,
        'business_name' => 'Ewa Wędrychowska - coaching kariery, doradztwo zawodowe',
        'job_title'     => 'Coach kariery, doradca zawodowy',
        'nav'           => array(
            array('omnie',              'o mnie',             'coaching Kraków'),
            array('coaching-kariery',   'coaching kariery',   'rozwój pracowników i organizacji Kraków'),
            array('executive-coaching', 'executive coaching', 'executive coaching krakow'),
            array('doradztwo-zawodowe', 'doradztwo zawodowe', 'doradztwo zawodowe Kraków'),
            array('life-coaching',      'life coaching',      'life coaching coaching Kraków'),
            array('extended-disc',      'Extended Disc',      'Extended Disc'),
            array('referencje',         'referencje',         'coaching Kraków'),
            array('kontakt',            'kontakt',            'lepsza jakość życia Kraków'),
            array('faq',                'FAQ',                'awans na lidera, rozwój menedżera'),
            array('/blog/',             'BLOG',               null),
        ),
        'not_found'     => array('Strona nie została znaleziona', 'Strona, której szukasz, nie istnieje lub została przeniesiona.', 'Wróć na stronę główną'),
        'form_error'    => 'Wystąpił błąd. Spróbuj ponownie lub napisz bezpośrednio na e-mail.',
    ),
    'en' => array(
        'dir'           => 'eng/',
        'html_lang'     => 'en',
        'h2'            => 'career coach<br>career advisor',
        'nav_span'      => true,
        'copyright'     => false,
        'business_name' => 'Ewa Wędrychowska - career coaching, career advisory',
        'job_title'     => 'Career coach, career advisor',
        'nav'           => array(
            array('omnie',              'about me',        'career coach Krakow'),
            array('coaching-kariery',   'career coaching', 'career coaching Krakow'),
            array('doradztwo-zawodowe', 'career advisory', 'career advisory Krakow'),
            array('life-coaching',      'life coaching',   'life coaching Krakow'),
            array('referencje',         'references',      'coaching references'),
            array('kontakt',            'contact',         'contact career coach'),
        ),
        'not_found'     => array('Page not found', 'The page you are looking for does not exist or has been moved.', 'Back to the home page'),
        'form_error'    => 'An error occurred. Please try again or contact me directly by e-mail.',
    ),
    'fr' => array(
        'dir'           => 'fr/',
        'html_lang'     => 'fr',
        'h2'            => 'coach de carrière <br>conseillère professionnelle',
        'nav_span'      => true,
        'copyright'     => false,
        'business_name' => 'Ewa Wędrychowska - coaching de carrière, conseil professionnel',
        'job_title'     => 'Coach de carrière, conseillère professionnelle',
        'nav'           => array(
            array('omnie',              'Je me présente',        'coach de carrière Cracovie'),
            array('coaching-kariery',   'Coaching de carrière',  'coaching de carrière Cracovie'),
            array('doradztwo-zawodowe', 'Conseil professionnel', 'conseil professionnel Cracovie'),
            array('life-coaching',      'Coaching de vie',       'coaching de vie Cracovie'),
            array('referencje',         'Références',            'références coaching'),
            array('kontakt',            'Contact',               'contact coach de carrière'),
        ),
        'not_found'     => array('Page introuvable', 'La page que vous recherchez n’existe pas ou a été déplacée.', 'Retour à la page d’accueil'),
        'form_error'    => 'Une erreur est survenue. Veuillez réessayer ou m’écrire directement par e-mail.',
    ),
);

/*
 * Rejestr podstron.
 *  title / description - znaczniki SEO
 *  home          - strona główna (inny układ banera i menu w <aside>)
 *  ga            - czy dołączyć Google Analytics
 *  cookies       - czy dołączyć skrypt paska cookies (whcookies.js)
 *  contact_form  - czy dołączyć skrypty formularza kontaktowego (ajax_email)
 *  social_footer - czy pokazać ikony FB/LinkedIn w stopce
 *  alt           - odpowiedniki strony w innych językach: slug, null = brak ('#')
 *  noindex       - strony wykluczone z indeksowania i sitemapy
 */
$pages = array(
    'pl' => array(
        'index' => array(
            'title'         => 'Coaching menedżerski, Coach Kraków - Ewa Wędrychowska',
            'description'   => 'Ewa Wędrychowska, Coach ICF Erickson College, prowadzę coaching kariery, doradztwo zawodowe, life coaching menedżerski. Zapraszam',
            'home'          => true,
            'cookies'       => true,
            'social_footer' => true,
            'alt'           => array('en' => 'index', 'fr' => 'index'),
        ),
        'omnie' => array(
            'title'       => 'Coaching Kraków, coach - Ewa Wędrychowska',
            'description' => 'Jestem certyfikowanym coachem (ACC ICF Erickson College International) oraz dyplomowanym doradcą zawodowym z Krakowa.',
            'alt'         => array('en' => 'omnie', 'fr' => 'omnie'),
        ),
        'coaching-kariery' => array(
            'title'       => 'Coaching kariery Kraków - Ewa Wędrychowska',
            'description' => 'Jeśli poszukujesz wizji kariery zawodowej, potrzebujesz motywacji lub chcesz wykorzystać swój potencjał Coaching kariery jest dla Ciebie!',
            'alt'         => array('en' => 'coaching-kariery', 'fr' => 'coaching-kariery'),
        ),
        'executive-coaching' => array(
            'title'       => 'Executive coaching Kraków, Life Coaching - Ewa Wędrychowska',
            'description' => 'Czujesz, że potrzebujesz zmiany w swoim życiu ale nie wiesz od czego zacząć? Chcesz się rozwijać? Zapraszam na Executive Coaching.',
            'alt'         => array('en' => 'life-coaching', 'fr' => 'life-coaching'),
        ),
        'doradztwo-zawodowe' => array(
            'title'       => 'Doradca zawodowy Kraków - Ewa Wędrychowska',
            'description' => 'Doradztwo zawodowe - pomoc w zakresie poszukiwania pracy, przygotowywań do rozmowy rekrutacyjnej, analizy kompetencji.',
            'alt'         => array('en' => 'doradztwo-zawodowe', 'fr' => 'doradztwo-zawodowe'),
        ),
        'life-coaching' => array(
            'title'       => 'Life Coaching - Ewa Wędrychowska',
            'description' => 'Czujesz, że potrzebujesz zmiany w swoim życiu ale nie wiesz od czego zacząć? Chcesz się rozwijać? Zapraszam na Life Coaching.',
            'alt'         => array('en' => 'life-coaching', 'fr' => 'life-coaching'),
        ),
        'extended-disc' => array(
            'title'       => 'Life Coaching - Ewa Wędrychowska',
            'description' => 'Czujesz, że potrzebujesz zmiany w swoim życiu ale nie wiesz od czego zacząć? Chcesz się rozwijać? Zapraszam na Life Coaching.',
            'alt'         => array('en' => 'life-coaching', 'fr' => 'life-coaching'),
        ),
        'referencje' => array(
            'title'       => 'Referencje - Ewa Wędrychowska',
            'description' => 'Pomogłam wielu osobom w zakresie kariery zawodowej - sprawdź moje referencje.',
            'alt'         => array('en' => 'referencje', 'fr' => 'referencje'),
        ),
        'kontakt' => array(
            'title'        => 'Kontakt - Ewa Wędrychowska',
            'description'  => 'Oferuję swoje usługi na terenie Krakowa, Małopolski, ale też na terenie całej Polski i za granicą. Zapraszam do kontaktu.',
            'contact_form' => true,
            'alt'          => array('en' => 'kontakt', 'fr' => 'kontakt'),
        ),
        'faq' => array(
            'title'       => 'FAQ - awans na lidera, rozwój menedżera - Ewa Wędrychowska',
            'description' => 'Najczęściej zadawane pytania o odnalezienie się w roli lidera po awansie z pozycji eksperta: pewność siebie, delegowanie, różnice między ekspertem a liderem, rozwój menedżera.',
            'alt'         => array('en' => null, 'fr' => null),
        ),
        'pliki' => array(
            'title'       => 'Polityka Plików Cookies - Ewa Wędrychowska',
            'description' => 'Polityka plików Cookies w serwisie ewedrychowska.com.pl.',
            'ga'          => false,
            'alt'         => array('en' => null, 'fr' => 'index'),
        ),
    ),
    'en' => array(
        'index' => array(
            'title'       => 'ICF Erickson College Coach - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, Coach ICF Erickson College - I work with people who seek to change and advance their professional careers.',
            'home'        => true,
            'alt'         => array('pl' => 'index', 'fr' => 'index'),
        ),
        'omnie' => array(
            'title'       => 'About me - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, Coach ICF Erickson College and licensed career advisor.',
            'alt'         => array('pl' => 'omnie', 'fr' => 'omnie'),
        ),
        'coaching-kariery' => array(
            'title'       => 'Career Coach, Career Coaching - Ewa Wędrychowska',
            'description' => 'Career Coaching - Seek your own vision for professional career, based on your dreams and values.',
            'alt'         => array('pl' => 'coaching-kariery', 'fr' => 'coaching-kariery'),
        ),
        'doradztwo-zawodowe' => array(
            'title'       => 'Career Advisory - Ewa Wędrychowska',
            'description' => 'Are you looking for a job? Want to change your job or qualifications? Career Advisory is for you.',
            'alt'         => array('pl' => 'doradztwo-zawodowe', 'fr' => 'doradztwo-zawodowe'),
        ),
        'life-coaching' => array(
            'title'       => 'Life Coaching, Live in harmony with yourself - Ewa Wędrychowska',
            'description' => 'Better identify the goals that suit you, gain more self-confidence, use your skills in a conscious manner - Life Coaching.',
            'alt'         => array('pl' => 'life-coaching', 'fr' => 'life-coaching'),
        ),
        'referencje' => array(
            'title'       => 'References - Ewa Wędrychowska',
            'description' => 'My references - Ewa Wędrychowska, career coach.',
            'alt'         => array('pl' => 'referencje', 'fr' => 'referencje'),
        ),
        'kontakt' => array(
            'title'        => 'Contact - Ewa Wędrychowska',
            'description'  => 'Please feel free to send me an email or call me in order to make an appointment or ask any questions.',
            'contact_form' => true,
            'alt'          => array('pl' => 'kontakt', 'fr' => 'kontakt'),
        ),
    ),
    'fr' => array(
        'index' => array(
            'title'       => 'Coach ICF Erickson College - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, coach ICF Erickson College - j’accompagne les personnes qui souhaitent changer et développer leur carrière professionnelle.',
            'home'        => true,
            'alt'         => array('pl' => 'index', 'en' => 'index'),
        ),
        'omnie' => array(
            'title'       => 'Je me présente - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, coach ICF Erickson College et conseillère professionnelle diplômée.',
            'alt'         => array('pl' => 'omnie', 'en' => 'omnie'),
        ),
        'coaching-kariery' => array(
            'title'       => 'Coaching de carrière - Ewa Wędrychowska',
            'description' => 'Coaching de carrière - recherchez votre propre vision de votre carrière professionnelle, fondée sur vos rêves et vos valeurs.',
            'alt'         => array('pl' => 'coaching-kariery', 'en' => 'coaching-kariery'),
        ),
        'doradztwo-zawodowe' => array(
            'title'       => 'Conseil professionnel - Ewa Wędrychowska',
            'description' => 'Vous recherchez un emploi ? Vous voulez changer d’emploi ou de qualifications ? Le conseil professionnel est pour vous.',
            'alt'         => array('pl' => 'doradztwo-zawodowe', 'en' => 'doradztwo-zawodowe'),
        ),
        'life-coaching' => array(
            'title'       => 'Coaching de vie, Vivez en harmonie avec vous-même - Ewa Wędrychowska',
            'description' => 'Identifiez mieux vos objectifs, gagnez en confiance en vous, utilisez consciemment vos compétences - coaching de vie.',
            'alt'         => array('pl' => 'life-coaching', 'en' => 'life-coaching'),
        ),
        'referencje' => array(
            'title'       => 'Références - Ewa Wędrychowska',
            'description' => 'Mes références - Ewa Wędrychowska, coach de carrière.',
            'alt'         => array('pl' => 'referencje', 'en' => 'referencje'),
        ),
        'kontakt' => array(
            'title'        => 'Contact - Ewa Wędrychowska',
            'description'  => 'N’hésitez pas à m’écrire ou à m’appeler pour prendre rendez-vous ou poser vos questions.',
            'contact_form' => true,
            'alt'          => array('pl' => 'kontakt', 'en' => 'kontakt'),
        ),
    ),
);

/* Strona błędu 404 dla każdego języka */
foreach (array_keys($languages) as $errLang) {
    $pages[$errLang]['404'] = array(
        'title'       => '404 - Ewa Wędrychowska',
        'description' => $languages[$errLang]['not_found'][0],
        'ga'          => false,
        'noindex'     => true,
        'alt'         => array(),
    );
}

/* ----- Funkcje pomocnicze ----- */

function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/** Przyjazny adres URL podstrony, np. page_url('en', 'omnie') => /eng/omnie */
function page_url($lang, $slug)
{
    global $languages;
    $url = BASE_PATH . '/' . $languages[$lang]['dir'];
    if ($slug !== 'index') {
        $url .= $slug;
    }
    return $url;
}

/** Ścieżka do zasobów (css/images/ajax_email) danej wersji językowej */
function asset_base($lang)
{
    global $languages;
    return BASE_PATH . '/' . $languages[$lang]['dir'];
}

/** Pełny adres podstrony łącznie z domeną (canonical, sitemap, hreflang) */
function absolute_url($lang, $slug)
{
    return BASE_URL . page_url($lang, $slug);
}

/** Odpowiedniki strony we wszystkich językach (do hreflang i sitemapy) */
function page_alternates($lang, $slug)
{
    global $pages;
    $alternates = array($lang => $slug);
    $alt = isset($pages[$lang][$slug]['alt']) ? $pages[$lang][$slug]['alt'] : array();
    foreach ($alt as $altLang => $altSlug) {
        // hreflang tylko dla prawdziwych odpowiedników (ten sam slug)
        if ($altSlug === $slug && isset($pages[$altLang][$altSlug])) {
            $alternates[$altLang] = $altSlug;
        }
    }
    return count($alternates) === 3 ? $alternates : array();
}
