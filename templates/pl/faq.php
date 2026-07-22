<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }

/* Pytania i odpowiedzi - jedno źródło dla widocznej treści i danych FAQPage */
$faq = array(
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
        'a' => 'Pomaga przypomnienie sobie własnych sukcesów, mocnych stron i powodów, dla których właśnie tobie zaproponowano awans. Warto też jasno określić, czego naprawdę oczekują od ciebie przełożeni i zespół, zamiast próbować udowodnić, że wiesz wszystko.',
    ),
    array(
        'q' => 'Od czego zacząć rozwój lidera?',
        'a' => 'Najlepiej od jednego konkretnego kroku: zdefiniowania swojej roli, rozmowy z zespołem albo świadomego odpuszczenia nadmiernej kontroli. Rozwój lidera zaczyna się od zrozumienia, że nie musisz robić wszystkiego samodzielnie — masz tworzyć warunki, w których inni mogą dobrze działać.',
    ),
);
?>
                                <div class="banner-podstrona">

                                             <div class="desc2">
<h1 class="tytul">Najczęściej zadawane pytania</h1>
<?php foreach ($faq as $item): ?>
	<h2 class="faq-pytanie"><?= e($item['q']) ?></h2>
	<p class="tresc"><?= e($item['a']) ?></p>
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
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => $item['a']),
        );
    }, $faq),
), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
