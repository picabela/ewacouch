<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }

/*
 * FAQ pogrupowane w sekcje tematyczne. Jedno źródło danych dla widocznej
 * treści i dla danych strukturalnych FAQPage (JSON-LD).
 * Odpowiedzi mogą zawierać linki wewnętrzne (do podstron oferty) - w widoku
 * są klikalne, a do danych strukturalnych trafia czysty tekst (strip_tags).
 * Treść oparta na aktualnej ofercie ze strony.
 */

/* Helper: link wewnętrzny do podstrony w bieżącym języku. */
$link = function ($slug, $label) use ($lang) {
    return '<a href="' . e(page_url($lang, $slug)) . '">' . e($label) . '</a>';
};

$sekcje = array(

    array('tytul' => 'Oferta, współpraca i kontakt', 'pytania' => array(
        array(
            'q' => 'Z jakich usług mogę skorzystać?',
            'a' => 'Oferuję ' . $link('coaching-kariery', 'coaching kariery') . ', '
                 . $link('executive-coaching', 'executive coaching') . ' (coaching menedżerski), '
                 . $link('doradztwo-zawodowe', 'doradztwo zawodowe') . ' oraz '
                 . $link('life-coaching', 'life coaching') . '. W pracy wykorzystuję również test '
                 . $link('extended-disc', 'Extended Disc®') . '. Zapraszam zarówno osoby prywatne, jak i firmy chcące rozwijać i wspierać swoich pracowników.',
        ),
        array(
            'q' => 'Dla kogo jest Twoja oferta — dla osób prywatnych czy dla firm?',
            'a' => 'Dla obu. Pracuję z osobami prywatnymi, które chcą się rozwijać, wprowadzać zmiany i osiągać lepszą jakość życia, a także z firmami, które chcą wspierać swoich liderów, menedżerów, pracowników obejmujących nowe obowiązki, zmieniających ścieżkę zawodową lub przygotowujących się do przejścia na emeryturę.',
        ),
        array(
            'q' => 'Jak umówić się na sesję i od czego zacząć współpracę?',
            'a' => 'Wystarczy napisać lub zadzwonić i umówić się na sesję wstępną — bezpośrednią lub on-line. To dobry moment, żeby się poznać, omówić Twoją sytuację i sprawdzić, jak mogę Ci pomóc. Dane kontaktowe i formularz znajdziesz w zakładce ' . $link('kontakt', 'Kontakt') . '.',
        ),
        array(
            'q' => 'Czy sesje odbywają się online, czy tylko stacjonarnie?',
            'a' => 'Możliwe są obie formy — spotykamy się bezpośrednio w Krakowie albo pracujemy on-line, zależnie od Twoich preferencji i możliwości.',
        ),
        array(
            'q' => 'Jak wygląda pierwsze spotkanie?',
            'a' => 'Podczas pierwszego spotkania wspólnie podpisujemy kontrakt coachingowy, w którym ustalamy zasady współpracy. Jeżeli zleceniodawcą usługi jest pracodawca, powstaje kontrakt trójstronny.',
        ),
        array(
            'q' => 'Ile trwa proces i jak często odbywają się sesje?',
            'a' => 'Zwykle proces obejmuje od 5 do 10 sesji, które przebiegają według ściśle określonej struktury. Sesje odbywają się co 2–3 tygodnie, a czas między nimi służy wdrażaniu wypracowanych rozwiązań w życie.',
        ),
        array(
            'q' => 'W jakich językach prowadzisz sesje?',
            'a' => 'Pracuję w języku polskim, francuskim, hiszpańskim oraz angielskim.',
        ),
        array(
            'q' => 'Jak się z Tobą skontaktować?',
            'a' => 'Najłatwiej telefonicznie (' . e($contact['phone']) . ') lub mailowo (' . e($contact['email'])
                 . '). Przyjmuję w Krakowie przy ' . e($contact['street']) . '. Szczegóły i formularz kontaktowy znajdziesz w zakładce ' . $link('kontakt', 'Kontakt') . '.',
        ),
    )),

    array('tytul' => 'Coaching kariery i doradztwo zawodowe', 'pytania' => array(
        array(
            'q' => 'Dla kogo jest coaching kariery?',
            'a' => 'Dla osób, które poszukują własnej wizji kariery opartej na swoich wartościach, myślą o zmianie ścieżki zawodowej, potrzebują motywacji, chcą lepiej wykorzystać swój potencjał albo czują wypalenie zawodowe i szukają równowagi między życiem zawodowym a prywatnym. Więcej znajdziesz na stronie '
                 . $link('coaching-kariery', 'coaching kariery') . '.',
        ),
        array(
            'q' => 'Czym różni się coaching kariery od doradztwa zawodowego?',
            'a' => $link('coaching-kariery', 'Coaching kariery') . ' skupia się na odkryciu Twojej wizji rozwoju, celów i strategii oraz na pokonaniu wewnętrznych blokad. '
                 . $link('doradztwo-zawodowe', 'Doradztwo zawodowe') . ' to bardziej konkretne wsparcie w poszukiwaniu pracy: analiza kompetencji, strategia poszukiwań, przygotowanie profesjonalnego CV i listu motywacyjnego oraz przygotowanie do rozmowy rekrutacyjnej.',
        ),
        array(
            'q' => 'W czym pomaga doradztwo zawodowe?',
            'a' => 'Opracujesz mapę swoich kompetencji i predyspozycji, zidentyfikujesz mocne strony, wyznaczysz cele zawodowe i docelowych pracodawców, zbudujesz strategię poszukiwania pracy, stworzysz profesjonalne CV i przygotujesz się do rozmowy rekrutacyjnej. Szczegóły opisuję na stronie '
                 . $link('doradztwo-zawodowe', 'doradztwo zawodowe') . '.',
        ),
        array(
            'q' => 'Czuję wypalenie zawodowe — czy coaching może pomóc?',
            'a' => 'Tak. Coaching pomaga odzyskać motywację, spojrzeć na sytuację z nowej perspektywy, pozbyć się wewnętrznych blokad i wyznaczyć cele, które są dla Ciebie naprawdę ważne, a także zadbać o równowagę między pracą a życiem prywatnym.',
        ),
    )),

    array('tytul' => 'Executive coaching (coaching menedżerski)', 'pytania' => array(
        array(
            'q' => 'Czym jest executive coaching i dla kogo jest przeznaczony?',
            'a' => $link('executive-coaching', 'Executive coaching') . ' to coaching dla osób zarządzających i liderów, którzy chcą skuteczniej motywować i rozwijać pracowników, lepiej radzić sobie z emocjami i stresem, efektywniej zarządzać czasem i zadaniami, budować dobre relacje z przełożonymi oraz odzyskać energię i pewność siebie.',
        ),
        array(
            'q' => 'Co zyskam dzięki executive coachingowi?',
            'a' => 'Będziesz efektywniej zarządzać zespołem, nauczysz się panować nad emocjami i wzmocnisz odporność na stres, pogłębisz wiedzę o swoim potencjale, zyskasz jaśniejszą wizję rozwoju, łatwiej będziesz podejmować decyzje i uwolnisz energię oraz motywację do działania.',
        ),
        array(
            'q' => 'Czy w pracy z menedżerami wykorzystujesz narzędzia diagnostyczne?',
            'a' => 'Tak, proponuję test ' . $link('extended-disc', 'Extended Disc®')
                 . ', który diagnozuje m.in. naturalny styl zarządzania, talenty i mocne strony. Pomaga lepiej zrozumieć własny sposób działania oraz budowania relacji w zespole.',
        ),
    )),

    array('tytul' => 'Rozwój lidera po awansie z pozycji eksperta', 'pytania' => array(
        array(
            'q' => 'Jak odnaleźć się w roli lidera po awansie z pozycji eksperta?',
            'a' => 'Warto zacząć od zmiany perspektywy. Lider nie musi znać każdego szczegółu lepiej niż zespół. Jego zadaniem jest wspieranie ludzi, wyznaczanie kierunku, budowanie odpowiedzialności i tworzenie warunków do dobrej współpracy.',
        ),
        array(
            'q' => 'Dlaczego po awansie mogę mieć poczucie, że nie jestem wystarczająco dobrym liderem?',
            'a' => 'To naturalne, szczególnie gdy wcześniej twoja pewność siebie opierała się głównie na wiedzy eksperckiej. Nowa rola wymaga innych kompetencji: komunikacji, delegowania, budowania zaufania i zarządzania odpowiedzialnością.',
        ),
        array(
            'q' => 'Czym różni się rola eksperta od roli lidera?',
            'a' => 'Ekspert koncentruje się przede wszystkim na własnych zadaniach i specjalistycznej wiedzy. Lider odpowiada za ludzi, decyzje, kierunek działania i rozwój zespołu. Dlatego w nowej roli ważniejsze staje się wspieranie innych niż samodzielne kontrolowanie każdego szczegółu.',
        ),
        array(
            'q' => 'Jak odbudować pewność siebie w nowej roli menedżera?',
            'a' => 'Pomaga przypomnienie sobie własnych sukcesów, mocnych stron i powodów, dla których właśnie tobie zaproponowano awans. Warto też jasno określić, czego naprawdę oczekują od ciebie przełożeni i zespół, zamiast próbować udowodnić, że wiesz wszystko. W tym procesie może pomóc '
                 . $link('executive-coaching', 'executive coaching') . '.',
        ),
        array(
            'q' => 'Od czego zacząć rozwój lidera?',
            'a' => 'Najlepiej od jednego konkretnego kroku: zdefiniowania swojej roli, rozmowy z zespołem albo świadomego odpuszczenia nadmiernej kontroli. Rozwój lidera zaczyna się od zrozumienia, że nie musisz robić wszystkiego samodzielnie — masz tworzyć warunki, w których inni mogą dobrze działać.',
        ),
    )),

    array('tytul' => 'Life coaching i rozwój osobisty', 'pytania' => array(
        array(
            'q' => 'Czym jest life coaching i kiedy warto z niego skorzystać?',
            'a' => $link('life-coaching', 'Life coaching') . ' jest dla osób, które myślą o zmianie w życiu, ale nie wiedzą, od czego zacząć, są na rozdrożu, chcą pokonać własne bariery, obawy i samokrytycyzm, uświadomić sobie swój potencjał i żyć w większej zgodzie ze sobą.',
        ),
        array(
            'q' => 'Co mogę zyskać dzięki life coachingowi?',
            'a' => 'Lepiej określisz najodpowiedniejsze dla siebie cele, zdobędziesz więcej pewności siebie, będziesz świadomie wykorzystywać swoje umiejętności, podejmować trafniejsze decyzje, pozbędziesz się wewnętrznych blokad i poczujesz, że masz realny wpływ na własne życie.',
        ),
    )),

    array('tytul' => 'Metoda pracy, kwalifikacje i zasady', 'pytania' => array(
        array(
            'q' => 'Jaką metodą pracujesz?',
            'a' => 'Stosuję podejście skoncentrowane na rozwiązaniach, zgodne z metodologią Erickson College. Podczas sesji największy nacisk kładę na wsparcie w sformułowaniu jasnej wizji celu oraz na wypracowanie konkretnych działań prowadzących do jego realizacji.',
        ),
        array(
            'q' => 'Jakie masz kwalifikacje i doświadczenie?',
            'a' => 'Jestem certyfikowanym coachem (PCC ICF Erickson College International, Vancouver) oraz dyplomowanym doradcą zawodowym (Wyższa Szkoła Europejska w Krakowie). Ukończyłam też studia podyplomowe z zarządzania zasobami ludzkimi na AGH i mam ponad 17 lat doświadczenia w biznesie, m.in. jako menedżer HR w międzynarodowej korporacji. Więcej piszę w zakładce '
                 . $link('omnie', 'o mnie') . ', a opinie klientów znajdziesz w '
                 . $link('referencje', 'referencjach') . '.',
        ),
        array(
            'q' => 'Czy obowiązują Cię zasady etyczne?',
            'a' => 'Tak. Jako coach kieruję się kodeksem etycznym International Coach Federation (ICF).',
        ),
    )),

    array('tytul' => 'Test Extended Disc®', 'pytania' => array(
        array(
            'q' => 'Czym jest test Extended Disc® i co daje?',
            'a' => $link('extended-disc', 'Extended Disc®') . ' to narzędzie wspierające rozwój osobisty. Dostarcza informacji o preferowanych stylach zachowania, dzięki czemu lepiej rozumiesz swój sposób działania, poznajesz naturalne talenty i predyspozycje, styl komunikacji oraz to, co Cię motywuje, a co obniża Twoje zaangażowanie.',
        ),
        array(
            'q' => 'Jak wygląda badanie Extended Disc?',
            'a' => 'Napisz do mnie i zamów test. Po otrzymaniu linka aktywujesz go i wykonujesz test on-line, następnie umawiamy się na 120-minutową sesję omawiającą wyniki (również on-line). Po sesji otrzymujesz około 20-stronicowy raport wraz z ćwiczeniami do samodzielnej pracy.',
        ),
    )),

);

/* Płaska lista wszystkich pytań - do danych strukturalnych FAQPage */
$wszystkie = array();
foreach ($sekcje as $s) {
    foreach ($s['pytania'] as $p) { $wszystkie[] = $p; }
}
?>
                                <div class="banner-podstrona">

                                             <div class="desc2">
<h1 class="tytul">Najczęściej zadawane pytania</h1>
<p class="tresc">Poniżej znajdziesz odpowiedzi na najczęstsze pytania o ofertę, przebieg współpracy i sposób mojej pracy. Jeśli nie znajdziesz tu swojej odpowiedzi — napisz lub zadzwoń, chętnie pomogę.</p>
<?php foreach ($sekcje as $sekcja): ?>
	<h2 class="faq-sekcja"><?= e($sekcja['tytul']) ?></h2>
	<?php foreach ($sekcja['pytania'] as $item): ?>
		<h3 class="faq-pytanie"><?= e($item['q']) ?></h3>
		<p class="tresc"><?= $item['a'] ?></p>
	<?php endforeach; ?>
<?php endforeach; ?>
<div class="przerwa2"></div>
<p class="duza-prawa">Zapraszam!
</p>
<div class="przerwa"></div>

                                        </div>

                                </div>
<script type="application/ld+json"><?= json_encode(array(
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(function ($item) {
        return array(
            '@type'          => 'Question',
            'name'           => $item['q'],
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => strip_tags($item['a'])),
        );
    }, $wszystkie),
), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
