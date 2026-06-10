<?php
/**
 * Konfiguracja strony - to jedyny plik, który trzeba edytować przy zmianie
 * adresu strony, danych kontaktowych albo dodawaniu nowych podstron.
 */

if (!defined('EW_SITE')) {
    http_response_code(404);
    exit;
}

/* Adres strony (bez ukośnika na końcu). Używany w canonical, sitemap i danych strukturalnych. */
define('BASE_URL', 'https://ewedrychowska-coaching.pl');

/* Identyfikator Google Analytics */
define('GA_ID', 'UA-85549321-1');

/* Dane kontaktowe / firmowe (kontakt, stopka, dane strukturalne) */
$contact = [
    'name'     => 'Ewa Wędrychowska',
    'phone'    => '+48 784092880',
    'email'    => 'ewawedry111@gmail.com',
    'street'   => 'ul. Wiedeńska 28',
    'postcode' => '30-147',
    'city'     => 'Kraków',
    'facebook' => 'https://www.facebook.com/Ewa-W%C4%99drychowska-coaching-kariery-doradztwo-zawodowe-1385304564851786/',
    'linkedin' => 'https://www.linkedin.com/in/ewa-w%C4%99drychowska-a1b766105/',
];

/*
 * Konfiguracja wersji językowych.
 *  dir        - podkatalog URL ('' = katalog główny)
 *  asset_base - skąd ładowane są css/images/ajax_email danej wersji
 *  nav        - pozycje menu: [slug, etykieta, atrybut title]
 *               slug zaczynający się od '/' to link zewnętrzny (np. blog)
 */
$languages = [
    'pl' => [
        'dir'        => '',
        'asset_base' => '/',
        'html_lang'  => 'pl',
        'h2'         => 'coach kariery<br>doradca zawodowy',
        'nav_span'   => false,
        'copyright'  => true,
        'nav'        => [
            ['omnie',              'o mnie',             'coaching Kraków'],
            ['coaching-kariery',   'coaching kariery',   'rozwój pracowników i organizacji Kraków'],
            ['executive-coaching', 'executive coaching', 'executive coaching krakow'],
            ['doradztwo-zawodowe', 'doradztwo zawodowe', 'doradztwo zawodowe Kraków'],
            ['life-coaching',      'life coaching',      'life coaching coaching Kraków'],
            ['extended-disc',      'Extended Disc',      'Extended Disc'],
            ['referencje',         'referencje',         'coaching Kraków'],
            ['kontakt',            'kontakt',            'lepsza jakość życia Kraków'],
            ['/blog/',             'BLOG',               null],
        ],
        'cta'        => 'umów się na sesję wstępną   <br>bezpośrednią lub on-line',
        'not_found'  => ['Strona nie została znaleziona', 'Strona, której szukasz, nie istnieje lub została przeniesiona.', 'Wróć na stronę główną'],
    ],
    'en' => [
        'dir'        => 'eng/',
        'asset_base' => '/eng/',
        'html_lang'  => 'en',
        'h2'         => 'career coach<br>career advisor',
        'nav_span'   => true,
        'copyright'  => false,
        'nav'        => [
            ['omnie',              'about me',        'coaching Kraków'],
            ['coaching-kariery',   'career coaching', 'rozwój pracowników i organizacji Kraków'],
            ['doradztwo-zawodowe', 'career advisory', 'doradztwo zawodowe Kraków'],
            ['life-coaching',      'life coaching',   'life coaching coaching Kraków'],
            ['referencje',         'references',      'coaching Kraków'],
            ['kontakt',            'contact',         'lepsza jakość życia Kraków'],
        ],
        'cta'        => 'please contact me here',
        'not_found'  => ['Page not found', 'The page you are looking for does not exist or has been moved.', 'Back to the home page'],
    ],
    'fr' => [
        'dir'        => 'fr/',
        'asset_base' => '/fr/',
        'html_lang'  => 'fr',
        'h2'         => 'coach de carrière <br>conseillère professionnelle',
        'nav_span'   => true,
        'copyright'  => false,
        'nav'        => [
            ['omnie',              'Je me présente',        'coaching Kraków'],
            ['coaching-kariery',   'Coaching de carrière',  'rozwój pracowników i organizacji Kraków'],
            ['doradztwo-zawodowe', 'Conseil professionnel', 'doradztwo zawodowe Kraków'],
            ['life-coaching',      'Coaching de vie',       'life coaching coaching Kraków'],
            ['referencje',         'Références',            'coaching Kraków'],
            ['kontakt',            'Contact',               'lepsza jakość życia Kraków'],
        ],
        'cta'        => 'contactez-moi ici',
        'not_found'  => ['Page introuvable', 'La page que vous recherchez n\'existe pas ou a été déplacée.', 'Retour à la page d\'accueil'],
    ],
];

/*
 * Rejestr podstron.
 *  title / description - znaczniki SEO (bez zmian względem starej strony)
 *  home          - strona główna (inny układ banera i menu w <aside>)
 *  ga            - czy dołączyć Google Analytics
 *  cookies       - czy dołączyć skrypt paska cookies (whcookies.js)
 *  contact_form  - czy dołączyć skrypty formularza kontaktowego (ajax_email)
 *  social_footer - czy pokazać ikony FB/LinkedIn w stopce
 *  alt           - odpowiedniki strony w innych językach: slug, null = brak ('#')
 *  noindex       - strony wykluczone z indeksowania i sitemapy
 */
$pages = [
    'pl' => [
        'index' => [
            'title'         => 'Coaching menedżerski, Coach Kraków - Ewa Wędrychowska',
            'description'   => 'Ewa Wędrychowska, Coach ICF Erickson College, prowadzę coaching kariery, doradztwo zawodowe, life coaching menedżerski. Zapraszam',
            'home'          => true,
            'cookies'       => true,
            'social_footer' => true,
            'alt'           => ['en' => 'index', 'fr' => 'index'],
        ],
        'omnie' => [
            'title'       => 'Coaching Kraków, coach - Ewa Wędrychowska',
            'description' => 'Jestem certyfikowanym coachem (ACC ICF Erickson College International) oraz dyplomowanym doradcą zawodowym z Krakowa.',
            'alt'         => ['en' => 'omnie', 'fr' => 'omnie'],
        ],
        'coaching-kariery' => [
            'title'       => 'Coaching kariery Kraków - Ewa Wędrychowska',
            'description' => 'Jeśli poszukujesz wizji kariery zawodowej, potrzebujesz motywacji lub chcesz wykorzystać swój potencjał Coaching kariery jest dla Ciebie!',
            'alt'         => ['en' => 'coaching-kariery', 'fr' => 'coaching-kariery'],
        ],
        'executive-coaching' => [
            'title'       => 'Executive coaching Kraków, Life Coaching - Ewa Wędrychowska',
            'description' => 'Czujesz, że potrzebujesz zmiany w swoim życiu ale nie wiesz od czego zacząć? Chcesz się rozwijać? Zapraszam na Executive Coaching.',
            'alt'         => ['en' => 'life-coaching', 'fr' => 'life-coaching'],
        ],
        'doradztwo-zawodowe' => [
            'title'       => 'Doradca zawodowy Kraków - Ewa Wędrychowska',
            'description' => 'Doradztwo zawodowe - pomoc w zakresie poszukiwania pracy, przygotowywań do rozmowy rekrutacyjnej, analizy kompetencji.',
            'alt'         => ['en' => 'doradztwo-zawodowe', 'fr' => 'doradztwo-zawodowe'],
        ],
        'life-coaching' => [
            'title'       => 'Life Coaching - Ewa Wędrychowska',
            'description' => 'Czujesz, że potrzebujesz zmiany w swoim życiu ale nie wiesz od czego zacząć? Chcesz się rozwijać? Zapraszam na Life Coaching.',
            'alt'         => ['en' => 'life-coaching', 'fr' => 'life-coaching'],
        ],
        'extended-disc' => [
            'title'       => 'Life Coaching - Ewa Wędrychowska',
            'description' => 'Czujesz, że potrzebujesz zmiany w swoim życiu ale nie wiesz od czego zacząć? Chcesz się rozwijać? Zapraszam na Life Coaching.',
            'alt'         => ['en' => 'life-coaching', 'fr' => 'life-coaching'],
        ],
        'referencje' => [
            'title'       => 'Referencje - Ewa Wędrychowska',
            'description' => 'Pomogłam wielu osobom w zakresie kariery zawodowej - sprawdź moje referencje.',
            'alt'         => ['en' => 'referencje', 'fr' => 'referencje'],
        ],
        'kontakt' => [
            'title'        => 'Kontakt - Ewa Wędrychowska',
            'description'  => 'Oferuję swoje usługi na terenie Krakowa, Małopolski, ale też na terenie całej Polski i za granicą. Zapraszam do kontaktu.',
            'contact_form' => true,
            'alt'          => ['en' => 'kontakt', 'fr' => 'kontakt'],
        ],
        'pliki' => [
            'title'       => 'Polityka Plików Cookies - Ewa Wędrychowska',
            'description' => 'Polityka plików Cookies w serwisie ewedrychowska.com.pl.',
            'ga'          => false,
            'alt'         => ['en' => null, 'fr' => 'index'],
        ],
    ],
    'en' => [
        'index' => [
            'title'       => 'ICF Erickson College Coach - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, Coach ICF Erickson College - i work with people who seek to change and advance thier professional careers.',
            'home'        => true,
            'alt'         => ['pl' => 'index', 'fr' => 'index'],
        ],
        'omnie' => [
            'title'       => 'About me - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, Coach ICF Erickson College and licensed career advisor.',
            'alt'         => ['pl' => 'omnie', 'fr' => 'omnie'],
        ],
        'coaching-kariery' => [
            'title'       => 'Career Coach, Career Coaching - Ewa Wędrychowska',
            'description' => 'Carrer Coaching - Seek your own vision for professional career, based on your dreams and values',
            'alt'         => ['pl' => 'coaching-kariery', 'fr' => 'coaching-kariery'],
        ],
        'doradztwo-zawodowe' => [
            'title'       => 'Career Advisory - Ewa Wędrychowska',
            'description' => 'Are You looking for a job? Want to change your job/qualifications? CareerAdvisory is for You.',
            'alt'         => ['pl' => 'doradztwo-zawodowe', 'fr' => 'doradztwo-zawodowe'],
        ],
        'life-coaching' => [
            'title'       => 'Life Coaching, Live in harmony with yourself - Ewa Wędrychowska',
            'description' => 'Better identify the goals that suit you, gain more self-confidence, use your skills in a conscious manner - Life Coaching',
            'alt'         => ['pl' => 'life-coaching', 'fr' => 'life-coaching'],
        ],
        'referencje' => [
            'title'       => 'References - Ewa Wędrychowska',
            'description' => 'My References - Ewa Wędrychowska Coach.',
            'alt'         => ['pl' => 'referencje', 'fr' => 'referencje'],
        ],
        'kontakt' => [
            'title'        => 'Contact - Ewa Wędrychowska',
            'description'  => 'Please feel free to send me an email or call me in order to make an appointment or ask any questions.',
            'contact_form' => true,
            'alt'          => ['pl' => 'kontakt', 'fr' => 'kontakt'],
        ],
    ],
    'fr' => [
        'index' => [
            'title'       => 'ICF Erickson College Coach - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, Coach ICF Erickson College - i work with people who seek to change and advance thier professional careers.',
            'home'        => true,
            'alt'         => ['pl' => 'index', 'en' => 'index'],
        ],
        'omnie' => [
            'title'       => 'About me - Ewa Wędrychowska',
            'description' => 'Ewa Wędrychowska, Coach ICF Erickson College and licensed career advisor.',
            'alt'         => ['pl' => 'omnie', 'en' => 'omnie'],
        ],
        'coaching-kariery' => [
            'title'       => 'Career Coach, Career Coaching - Ewa Wędrychowska',
            'description' => 'Carrer Coaching - Seek your own vision for professional career, based on your dreams and values',
            'alt'         => ['pl' => 'coaching-kariery', 'en' => 'coaching-kariery'],
        ],
        'doradztwo-zawodowe' => [
            'title'       => 'Career Advisory - Ewa Wędrychowska',
            'description' => 'Are You looking for a job? Want to change your job/qualifications? CareerAdvisory is for You.',
            'alt'         => ['pl' => 'doradztwo-zawodowe', 'en' => 'doradztwo-zawodowe'],
        ],
        'life-coaching' => [
            'title'       => 'Life Coaching, Live in harmony with yourself - Ewa Wędrychowska',
            'description' => 'Better identify the goals that suit you, gain more self-confidence, use your skills in a conscious manner - Life Coaching',
            'alt'         => ['pl' => 'life-coaching', 'en' => 'life-coaching'],
        ],
        'referencje' => [
            'title'       => 'References - Ewa Wędrychowska',
            'description' => 'My References - Ewa Wędrychowska Coach.',
            'alt'         => ['pl' => 'referencje', 'en' => 'referencje'],
        ],
        'kontakt' => [
            'title'        => 'Contact - Ewa Wędrychowska',
            'description'  => 'Please feel free to send me an email or call me in order to make an appointment or ask any questions.',
            'contact_form' => true,
            'alt'          => ['pl' => 'kontakt', 'en' => 'kontakt'],
        ],
    ],
];

/* Strona błędu 404 dla każdego języka */
foreach (array_keys($languages) as $errLang) {
    $pages[$errLang]['404'] = [
        'title'       => '404 - Ewa Wędrychowska',
        'description' => $languages[$errLang]['not_found'][0],
        'ga'          => false,
        'noindex'     => true,
        'alt'         => [],
    ];
}

/* ----- Funkcje pomocnicze ----- */

function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/** Przyjazny adres URL podstrony, np. page_url('en', 'omnie') => /eng/omnie */
function page_url(string $lang, string $slug): string
{
    global $languages;
    $url = '/' . $languages[$lang]['dir'];
    if ($slug !== 'index') {
        $url .= $slug;
    }
    return $url;
}

/** Pełny adres podstrony łącznie z domeną (canonical, sitemap, hreflang) */
function absolute_url(string $lang, string $slug): string
{
    return BASE_URL . page_url($lang, $slug);
}

/** Odpowiedniki strony we wszystkich językach (do hreflang i sitemapy) */
function page_alternates(string $lang, string $slug): array
{
    global $pages;
    $alternates = [$lang => $slug];
    foreach ($pages[$lang][$slug]['alt'] ?? [] as $altLang => $altSlug) {
        // hreflang tylko dla prawdziwych odpowiedników (ten sam slug)
        if ($altSlug === $slug && isset($pages[$altLang][$altSlug])) {
            $alternates[$altLang] = $altSlug;
        }
    }
    return count($alternates) === 3 ? $alternates : [];
}
