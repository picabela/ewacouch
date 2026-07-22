<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }

/*
 * FAQ pogrupowane w rozwijane sekcje (harmonijka: details/summary).
 * Jedno źródło danych dla widocznej treści i dla danych strukturalnych FAQPage.
 * Pytania sformułowane bezosobowo, pod SEO; odpowiedzi zawierają linki
 * wewnętrzne do podstron oferty (w widoku klikalne, w schemacie czysty tekst).
 */

/* Helper: link wewnętrzny do podstrony w bieżącym języku. */
$link = function ($slug, $label) use ($lang) {
    return '<a href="' . e(page_url($lang, $slug)) . '">' . e($label) . '</a>';
};

$sekcje = array(

    array('tytul' => 'Oferta, współpraca i kontakt', 'pytania' => array(
        array(
            'q' => 'Jakie usługi coachingowe i doradcze obejmuje oferta?',
            'a' => 'Oferta obejmuje ' . $link('coaching-kariery', 'coaching kariery') . ', '
                 . $link('executive-coaching', 'executive coaching') . ' (coaching menedżerski), '
                 . $link('doradztwo-zawodowe', 'doradztwo zawodowe') . ' oraz '
                 . $link('life-coaching', 'life coaching') . '. W pracy wykorzystywany jest również test '
                 . $link('extended-disc', 'Extended Disc®') . '. Z usług korzystają zarówno osoby prywatne, jak i firmy chcące rozwijać i wspierać swoich pracowników.',
        ),
        array(
            'q' => 'Dla kogo przeznaczony jest coaching — osoby prywatne czy firmy?',
            'a' => 'Dla obu. Coaching skierowany jest do osób prywatnych, które chcą się rozwijać, wprowadzać zmiany i osiągać lepszą jakość życia, a także do firm, które chcą wspierać swoich liderów, menedżerów, pracowników obejmujących nowe obowiązki, zmieniających ścieżkę zawodową lub przygotowujących się do przejścia na emeryturę.',
        ),
        array(
            'q' => 'Jak umówić się na sesję coachingową i rozpocząć współpracę?',
            'a' => 'Wystarczy napisać lub zadzwonić i umówić się na sesję wstępną — bezpośrednią lub on-line. To dobry moment na wzajemne poznanie się, omówienie sytuacji i sprawdzenie, jak coaching może pomóc. Dane kontaktowe i formularz są dostępne w zakładce ' . $link('kontakt', 'Kontakt') . '.',
        ),
        array(
            'q' => 'Czy sesje coachingowe odbywają się online czy stacjonarnie?',
            'a' => 'Możliwe są obie formy — spotkania bezpośrednie w Krakowie albo praca on-line, zależnie od preferencji i możliwości klienta.',
        ),
        array(
            'q' => 'Jak przebiega pierwsze spotkanie i kontrakt coachingowy?',
            'a' => 'Podczas pierwszego spotkania wspólnie podpisywany jest kontrakt coachingowy, w którym ustalane są zasady współpracy. Jeżeli zleceniodawcą usługi jest pracodawca, powstaje kontrakt trójstronny.',
        ),
        array(
            'q' => 'Ile trwa proces coachingowy i jak często odbywają się sesje?',
            'a' => 'Zwykle proces obejmuje od 5 do 10 sesji, które przebiegają według ściśle określonej struktury. Sesje odbywają się co 2–3 tygodnie, a czas między nimi służy wdrażaniu wypracowanych rozwiązań w życie.',
        ),
        array(
            'q' => 'W jakich językach prowadzone są sesje coachingowe?',
            'a' => 'Sesje prowadzone są w języku polskim, francuskim, hiszpańskim oraz angielskim.',
        ),
        array(
            'q' => 'Jak skontaktować się z coachem kariery w Krakowie?',
            'a' => 'Najłatwiej telefonicznie (' . e($contact['phone']) . ') lub mailowo (' . e($contact['email'])
                 . '). Gabinet mieści się w Krakowie przy ' . e($contact['street']) . '. Szczegóły i formularz kontaktowy są w zakładce ' . $link('kontakt', 'Kontakt') . '.',
        ),
    )),

    array('tytul' => 'Coaching kariery i doradztwo zawodowe', 'pytania' => array(
        array(
            'q' => 'Dla kogo jest coaching kariery?',
            'a' => 'Coaching kariery jest dla osób, które poszukują własnej wizji kariery opartej na swoich wartościach, myślą o zmianie ścieżki zawodowej, potrzebują motywacji, chcą lepiej wykorzystać swój potencjał albo czują wypalenie zawodowe i szukają równowagi między życiem zawodowym a prywatnym. Więcej na stronie '
                 . $link('coaching-kariery', 'coaching kariery') . '.',
        ),
        array(
            'q' => 'Czym różni się coaching kariery od doradztwa zawodowego?',
            'a' => $link('coaching-kariery', 'Coaching kariery') . ' skupia się na odkryciu wizji rozwoju, celów i strategii oraz na pokonaniu wewnętrznych blokad. '
                 . $link('doradztwo-zawodowe', 'Doradztwo zawodowe') . ' to bardziej konkretne wsparcie w poszukiwaniu pracy: analiza kompetencji, strategia poszukiwań, przygotowanie profesjonalnego CV i listu motywacyjnego oraz przygotowanie do rozmowy rekrutacyjnej.',
        ),
        array(
            'q' => 'Na czym polega doradztwo zawodowe i w czym pomaga?',
            'a' => 'Doradztwo zawodowe pomaga opracować mapę kompetencji i predyspozycji, zidentyfikować mocne strony, wyznaczyć cele zawodowe i docelowych pracodawców, zbudować strategię poszukiwania pracy, stworzyć profesjonalne CV oraz przygotować się do rozmowy rekrutacyjnej. Szczegóły opisane są na stronie '
                 . $link('doradztwo-zawodowe', 'doradztwo zawodowe') . '.',
        ),
        array(
            'q' => 'Wypalenie zawodowe — czy coaching kariery może pomóc?',
            'a' => 'Tak. Coaching pomaga odzyskać motywację, spojrzeć na sytuację z nowej perspektywy, pozbyć się wewnętrznych blokad i wyznaczyć naprawdę ważne cele, a także zadbać o równowagę między pracą a życiem prywatnym.',
        ),
    )),

    array('tytul' => 'Executive coaching (coaching menedżerski)', 'pytania' => array(
        array(
            'q' => 'Czym jest executive coaching i dla kogo jest przeznaczony?',
            'a' => $link('executive-coaching', 'Executive coaching') . ' to coaching dla osób zarządzających i liderów, którzy chcą skuteczniej motywować i rozwijać pracowników, lepiej radzić sobie z emocjami i stresem, efektywniej zarządzać czasem i zadaniami, budować dobre relacje z przełożonymi oraz odzyskać energię i pewność siebie.',
        ),
        array(
            'q' => 'Jakie efekty daje executive coaching?',
            'a' => 'Efektem jest skuteczniejsze zarządzanie zespołem, lepsze panowanie nad emocjami i większa odporność na stres, pogłębiona wiedza o własnym potencjale, jaśniejsza wizja rozwoju, łatwiejsze podejmowanie decyzji oraz uwolnienie energii i motywacji do działania.',
        ),
        array(
            'q' => 'Jakie narzędzia diagnostyczne są wykorzystywane w pracy z menedżerami?',
            'a' => 'W pracy z menedżerami wykorzystywany jest test ' . $link('extended-disc', 'Extended Disc®')
                 . ', który diagnozuje m.in. naturalny styl zarządzania, talenty i mocne strony. Pomaga lepiej zrozumieć własny sposób działania oraz budowania relacji w zespole.',
        ),
    )),

    array('tytul' => 'Rozwój lidera po awansie z pozycji eksperta', 'pytania' => array(
        array(
            'q' => 'Jak odnaleźć się w roli lidera po awansie z pozycji eksperta?',
            'a' => 'Warto zacząć od zmiany perspektywy. Lider nie musi znać każdego szczegółu lepiej niż zespół. Jego zadaniem jest wspieranie ludzi, wyznaczanie kierunku, budowanie odpowiedzialności i tworzenie warunków do dobrej współpracy.',
        ),
        array(
            'q' => 'Dlaczego po awansie pojawia się poczucie bycia niewystarczająco dobrym liderem?',
            'a' => 'To naturalne, szczególnie gdy wcześniej pewność siebie opierała się głównie na wiedzy eksperckiej. Nowa rola wymaga innych kompetencji: komunikacji, delegowania, budowania zaufania i zarządzania odpowiedzialnością.',
        ),
        array(
            'q' => 'Czym różni się rola eksperta od roli lidera?',
            'a' => 'Ekspert koncentruje się przede wszystkim na własnych zadaniach i specjalistycznej wiedzy. Lider odpowiada za ludzi, decyzje, kierunek działania i rozwój zespołu. Dlatego w nowej roli ważniejsze staje się wspieranie innych niż samodzielne kontrolowanie każdego szczegółu.',
        ),
        array(
            'q' => 'Jak odbudować pewność siebie w nowej roli menedżera?',
            'a' => 'Pomaga przypomnienie sobie własnych sukcesów, mocnych stron i powodów, dla których awans zaproponowano właśnie tej osobie. Warto też jasno określić, czego naprawdę oczekują przełożeni i zespół, zamiast próbować udowadniać, że wie się wszystko. W tym procesie może pomóc '
                 . $link('executive-coaching', 'executive coaching') . '.',
        ),
        array(
            'q' => 'Od czego zacząć rozwój lidera?',
            'a' => 'Najlepiej od jednego konkretnego kroku: zdefiniowania swojej roli, rozmowy z zespołem albo świadomego odpuszczenia nadmiernej kontroli. Rozwój lidera zaczyna się od zrozumienia, że nie trzeba robić wszystkiego samodzielnie — chodzi o tworzenie warunków, w których inni mogą dobrze działać.',
        ),
    )),

    array('tytul' => 'Life coaching i rozwój osobisty', 'pytania' => array(
        array(
            'q' => 'Czym jest life coaching i kiedy warto z niego skorzystać?',
            'a' => $link('life-coaching', 'Life coaching') . ' jest dla osób, które myślą o zmianie w życiu, ale nie wiedzą, od czego zacząć, są na rozdrożu, chcą pokonać własne bariery, obawy i samokrytycyzm, uświadomić sobie swój potencjał i żyć w większej zgodzie ze sobą.',
        ),
        array(
            'q' => 'Jakie efekty daje life coaching?',
            'a' => 'Life coaching pomaga lepiej określić najodpowiedniejsze cele, zdobyć więcej pewności siebie, świadomie wykorzystywać swoje umiejętności, podejmować trafniejsze decyzje, pozbyć się wewnętrznych blokad i odzyskać poczucie realnego wpływu na własne życie.',
        ),
    )),

    array('tytul' => 'Metoda pracy, kwalifikacje i zasady', 'pytania' => array(
        array(
            'q' => 'Jaką metodą prowadzony jest coaching?',
            'a' => 'Coaching prowadzony jest w podejściu skoncentrowanym na rozwiązaniach, zgodnym z metodologią Erickson College. Podczas sesji największy nacisk kładziony jest na wsparcie w sformułowaniu jasnej wizji celu oraz na wypracowanie konkretnych działań prowadzących do jego realizacji.',
        ),
        array(
            'q' => 'Jakie kwalifikacje i doświadczenie ma coach?',
            'a' => 'Ewa Wędrychowska jest certyfikowanym coachem (PCC ICF Erickson College International, Vancouver) oraz dyplomowanym doradcą zawodowym (Wyższa Szkoła Europejska w Krakowie). Ukończyła również studia podyplomowe z zarządzania zasobami ludzkimi na AGH i ma ponad 17 lat doświadczenia w biznesie, m.in. jako menedżer HR w międzynarodowej korporacji. Więcej w zakładce '
                 . $link('omnie', 'o mnie') . ', a opinie klientów w '
                 . $link('referencje', 'referencjach') . '.',
        ),
        array(
            'q' => 'Czy coaching podlega zasadom etycznym?',
            'a' => 'Tak. Praca coacha opiera się na kodeksie etycznym International Coach Federation (ICF).',
        ),
    )),

    array('tytul' => 'Test Extended Disc®', 'pytania' => array(
        array(
            'q' => 'Czym jest test Extended Disc® i co daje?',
            'a' => $link('extended-disc', 'Extended Disc®') . ' to narzędzie wspierające rozwój osobisty. Dostarcza informacji o preferowanych stylach zachowania, dzięki czemu łatwiej zrozumieć własny sposób działania, poznać naturalne talenty i predyspozycje, styl komunikacji oraz to, co motywuje, a co obniża zaangażowanie.',
        ),
        array(
            'q' => 'Jak przebiega badanie Extended Disc®?',
            'a' => 'Pierwszym krokiem jest zamówienie testu. Po otrzymaniu linka należy go aktywować i wykonać test on-line, a następnie umówić się na 120-minutową sesję omawiającą wyniki (również on-line). Po sesji klient otrzymuje około 20-stronicowy raport wraz z ćwiczeniami do samodzielnej pracy.',
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
<p class="tresc">Poniżej znajdują się odpowiedzi na najczęstsze pytania o ofertę, przebieg współpracy i metodę pracy. Kliknij nazwę sekcji, aby rozwinąć pytania.</p>
<div class="faq-lista">
<?php foreach ($sekcje as $i => $sekcja): ?>
	<details class="faq-sekcja-box"<?= $i === 0 ? ' open' : '' ?>>
		<summary class="faq-sum"><h2 class="faq-sekcja"><?= e($sekcja['tytul']) ?></h2></summary>
		<div class="faq-tresc">
		<?php foreach ($sekcja['pytania'] as $item): ?>
			<h3 class="faq-pytanie"><?= e($item['q']) ?></h3>
			<p class="tresc"><?= $item['a'] ?></p>
		<?php endforeach; ?>
		</div>
	</details>
<?php endforeach; ?>
</div>
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
