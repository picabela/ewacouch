<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }

/*
 * FAQ (FR) - sections thématiques repliables. Source de données unique pour le
 * contenu visible et les données structurées FAQPage. Les liens ne pointent que
 * vers les pages existant dans cette langue (sinon texte simple).
 */
$link = function ($key, $label) use ($lang) {
    global $pages;
    if (isset($pages[$lang][$key])) {
        return '<a href="' . e(page_url($lang, $key)) . '">' . e($label) . '</a>';
    }
    return e($label);
};

$sekcje = array(

    array('tytul' => 'Offre, collaboration et contact', 'pytania' => array(
        array(
            'q' => 'Quels services de coaching et de conseil sont proposés ?',
            'a' => 'L’offre comprend le ' . $link('coaching-kariery', 'coaching de carrière') . ', le '
                 . $link('executive-coaching', 'coaching exécutif') . ' (coaching managérial), le '
                 . $link('doradztwo-zawodowe', 'conseil professionnel') . ' et le '
                 . $link('life-coaching', 'coaching de vie') . '. Le test ' . $link('extended-disc', 'Extended Disc®')
                 . ' est également utilisé. Ces services s’adressent aussi bien aux particuliers qu’aux entreprises souhaitant développer et accompagner leurs collaborateurs.',
        ),
        array(
            'q' => 'À qui s’adresse le coaching — particuliers ou entreprises ?',
            'a' => 'Aux deux. Le coaching s’adresse aux particuliers qui souhaitent se développer, opérer des changements et atteindre une meilleure qualité de vie, ainsi qu’aux entreprises qui veulent accompagner leurs leaders, managers, collaborateurs prenant de nouvelles responsabilités, changeant de parcours professionnel ou se préparant à la retraite.',
        ),
        array(
            'q' => 'Comment prendre rendez-vous pour une séance de coaching et commencer la collaboration ?',
            'a' => 'Il suffit d’écrire ou d’appeler et de convenir d’une séance préliminaire — en présentiel ou en ligne. C’est un bon moment pour faire connaissance, évoquer votre situation et voir comment le coaching peut aider. Les coordonnées et un formulaire sont disponibles sur la page ' . $link('kontakt', 'Contact') . '.',
        ),
        array(
            'q' => 'Les séances de coaching ont-elles lieu en ligne ou en présentiel ?',
            'a' => 'Les deux formats sont possibles — des rencontres en présentiel à Cracovie ou un travail en ligne, selon les préférences et les possibilités du client.',
        ),
        array(
            'q' => 'Comment se déroulent la première rencontre et le contrat de coaching ?',
            'a' => 'Lors de la première rencontre, un contrat de coaching est signé ensemble, définissant les règles de collaboration. Si le service est commandé par un employeur, un contrat tripartite est établi.',
        ),
        array(
            'q' => 'Combien de temps dure le processus de coaching et à quelle fréquence ont lieu les séances ?',
            'a' => 'Le processus comprend généralement de 5 à 10 séances qui suivent une structure clairement définie. Les séances ont lieu toutes les 2 à 3 semaines, et le temps entre elles sert à mettre en œuvre les solutions élaborées.',
        ),
        array(
            'q' => 'Dans quelles langues les séances de coaching sont-elles menées ?',
            'a' => 'Les séances sont menées en polonais, français, espagnol et anglais.',
        ),
        array(
            'q' => 'Comment contacter une coach de carrière à Cracovie ?',
            'a' => 'Le plus simple est par téléphone (' . e($contact['phone']) . ') ou par e-mail (' . e($contact['email'])
                 . '). Le cabinet est situé à Cracovie, ' . e($contact['street']) . '. Les détails et un formulaire de contact se trouvent sur la page ' . $link('kontakt', 'Contact') . '.',
        ),
    )),

    array('tytul' => 'Coaching de carrière et conseil professionnel', 'pytania' => array(
        array(
            'q' => 'À qui s’adresse le coaching de carrière ?',
            'a' => 'Le coaching de carrière s’adresse aux personnes qui recherchent leur propre vision de carrière fondée sur leurs valeurs, envisagent de changer de parcours professionnel, ont besoin de motivation, veulent mieux exploiter leur potentiel ou ressentent un épuisement professionnel et recherchent un équilibre entre vie professionnelle et vie privée. Plus d’informations sur la page ' . $link('coaching-kariery', 'coaching de carrière') . '.',
        ),
        array(
            'q' => 'Quelle est la différence entre le coaching de carrière et le conseil professionnel ?',
            'a' => 'Le ' . $link('coaching-kariery', 'coaching de carrière') . ' se concentre sur la découverte de votre vision de développement, de vos objectifs et de votre stratégie, ainsi que sur le dépassement des blocages intérieurs. Le '
                 . $link('doradztwo-zawodowe', 'conseil professionnel') . ' est un soutien plus concret dans la recherche d’emploi : analyse des compétences, stratégie de recherche, préparation d’un CV et d’une lettre de motivation professionnels et préparation à l’entretien de recrutement.',
        ),
        array(
            'q' => 'En quoi consiste le conseil professionnel et en quoi aide-t-il ?',
            'a' => 'Le conseil professionnel aide à établir une carte des compétences et des prédispositions, à identifier les points forts, à définir des objectifs professionnels et des employeurs cibles, à construire une stratégie de recherche d’emploi, à créer un CV professionnel et à se préparer à l’entretien de recrutement. Les détails sont décrits sur la page ' . $link('doradztwo-zawodowe', 'conseil professionnel') . '.',
        ),
        array(
            'q' => 'Épuisement professionnel — le coaching de carrière peut-il aider ?',
            'a' => 'Oui. Le coaching aide à retrouver la motivation, à voir la situation sous un nouvel angle, à se débarrasser des blocages intérieurs et à définir des objectifs vraiment importants, ainsi qu’à veiller à l’équilibre entre le travail et la vie privée.',
        ),
    )),

    array('tytul' => 'Coaching exécutif (coaching managérial)', 'pytania' => array(
        array(
            'q' => 'Qu’est-ce que le coaching exécutif et à qui s’adresse-t-il ?',
            'a' => 'Le ' . $link('executive-coaching', 'coaching exécutif') . ' est un coaching destiné aux dirigeants et aux leaders qui souhaitent motiver et développer plus efficacement leurs collaborateurs, mieux gérer les émotions et le stress, gérer plus efficacement le temps et les tâches, construire de bonnes relations avec leurs supérieurs et retrouver énergie et confiance en soi.',
        ),
        array(
            'q' => 'Quels résultats apporte le coaching exécutif ?',
            'a' => 'Le résultat est une gestion d’équipe plus efficace, une meilleure maîtrise des émotions et une plus grande résistance au stress, une connaissance approfondie de son propre potentiel, une vision plus claire du développement, une prise de décision plus facile et la libération de l’énergie et de la motivation à agir.',
        ),
        array(
            'q' => 'Quels outils de diagnostic sont utilisés dans le travail avec les managers ?',
            'a' => 'Dans le travail avec les managers, le test ' . $link('extended-disc', 'Extended Disc®')
                 . ' est utilisé ; il diagnostique notamment le style de management naturel, les talents et les points forts. Il aide à mieux comprendre sa propre manière d’agir et de construire des relations au sein d’une équipe.',
        ),
    )),

    array('tytul' => 'Développement du leader après une promotion depuis un poste d’expert', 'pytania' => array(
        array(
            'q' => 'Comment trouver sa place de leader après une promotion depuis un poste d’expert ?',
            'a' => 'Il vaut mieux commencer par un changement de perspective. Un leader n’a pas besoin de connaître chaque détail mieux que son équipe. Son rôle est de soutenir les personnes, de donner une direction, de construire la responsabilité et de créer les conditions d’une bonne collaboration.',
        ),
        array(
            'q' => 'Pourquoi le sentiment de ne pas être un assez bon leader apparaît-il après une promotion ?',
            'a' => 'C’est naturel, surtout lorsque la confiance en soi reposait auparavant principalement sur des connaissances d’expert. Le nouveau rôle exige d’autres compétences : communication, délégation, construction de la confiance et gestion de la responsabilité.',
        ),
        array(
            'q' => 'Quelle est la différence entre le rôle d’expert et le rôle de leader ?',
            'a' => 'L’expert se concentre avant tout sur ses propres tâches et son savoir spécialisé. Le leader est responsable des personnes, des décisions, de la direction et du développement de l’équipe. C’est pourquoi, dans le nouveau rôle, soutenir les autres devient plus important que contrôler personnellement chaque détail.',
        ),
        array(
            'q' => 'Comment reconstruire la confiance en soi dans un nouveau rôle de manager ?',
            'a' => 'Il est utile de se rappeler ses propres réussites, ses points forts et les raisons pour lesquelles la promotion a été proposée à cette personne. Il vaut aussi la peine de définir clairement ce qu’attendent réellement les supérieurs et l’équipe, au lieu d’essayer de prouver que l’on sait tout. Le ' . $link('executive-coaching', 'coaching exécutif') . ' peut aider dans ce processus.',
        ),
        array(
            'q' => 'Par où commencer le développement du leader ?',
            'a' => 'De préférence par une seule étape concrète : définir son rôle, parler avec l’équipe ou lâcher consciemment un contrôle excessif. Le développement du leader commence par la compréhension qu’il n’est pas nécessaire de tout faire soi-même — il s’agit de créer les conditions dans lesquelles les autres peuvent bien travailler.',
        ),
    )),

    array('tytul' => 'Coaching de vie et développement personnel', 'pytania' => array(
        array(
            'q' => 'Qu’est-ce que le coaching de vie et quand y recourir ?',
            'a' => 'Le ' . $link('life-coaching', 'coaching de vie') . ' s’adresse aux personnes qui pensent à un changement dans leur vie mais ne savent pas par où commencer, sont à la croisée des chemins, veulent surmonter leurs propres barrières, peurs et autocritique, prendre conscience de leur potentiel et vivre en plus grande harmonie avec elles-mêmes.',
        ),
        array(
            'q' => 'Quels résultats apporte le coaching de vie ?',
            'a' => 'Le coaching de vie aide à mieux définir les objectifs les plus adaptés, à gagner en confiance en soi, à utiliser consciemment ses compétences, à prendre des décisions plus justes, à se débarrasser des blocages intérieurs et à retrouver le sentiment d’avoir une réelle influence sur sa propre vie.',
        ),
    )),

    array('tytul' => 'Méthode de travail, qualifications et principes', 'pytania' => array(
        array(
            'q' => 'Sur quelle méthode repose le coaching ?',
            'a' => 'Le coaching est mené selon une approche orientée solutions, conforme à la méthodologie Erickson College. Pendant les séances, l’accent est mis avant tout sur l’accompagnement du client dans la formulation d’une vision claire de l’objectif et sur l’élaboration d’actions concrètes menant à sa réalisation.',
        ),
        array(
            'q' => 'Quelles qualifications et quelle expérience possède la coach ?',
            'a' => 'Ewa Wędrychowska est coach certifiée (PCC ICF Erickson College International, Vancouver) et conseillère professionnelle diplômée (École supérieure européenne de Cracovie). Elle a également suivi des études postuniversitaires en gestion des ressources humaines à l’université AGH et possède plus de 17 ans d’expérience en entreprise, notamment comme responsable RH dans une multinationale. Plus d’informations sur la page ' . $link('omnie', 'à propos') . ', et les avis des clients dans les ' . $link('referencje', 'références') . '.',
        ),
        array(
            'q' => 'Le coaching est-il soumis à des principes éthiques ?',
            'a' => 'Oui. Le travail de la coach repose sur le code de déontologie de l’International Coach Federation (ICF).',
        ),
    )),

    array('tytul' => 'Test Extended Disc®', 'pytania' => array(
        array(
            'q' => 'Qu’est-ce que le test Extended Disc® et qu’apporte-t-il ?',
            'a' => $link('extended-disc', 'Extended Disc®') . ' est un outil de soutien au développement personnel. Il fournit des informations sur les styles de comportement préférés, ce qui permet de mieux comprendre sa propre manière d’agir, de découvrir ses talents et prédispositions naturels, son style de communication ainsi que ce qui motive et ce qui réduit l’engagement.',
        ),
        array(
            'q' => 'Comment se déroule le bilan Extended Disc® ?',
            'a' => 'La première étape consiste à commander le test. Après réception d’un lien, il faut l’activer et réaliser le test en ligne, puis convenir d’une séance de 120 minutes pour discuter des résultats (également possible en ligne). Après la séance, le client reçoit un rapport d’environ 20 pages accompagné d’exercices pour un travail autonome.',
        ),
    )),

);

$wszystkie = array();
foreach ($sekcje as $s) { foreach ($s['pytania'] as $p) { $wszystkie[] = $p; } }
?>
                                <div class="banner-podstrona">

                                             <div class="desc2">
<h1 class="tytul">Questions fréquentes</h1>
<p class="tresc">Vous trouverez ci-dessous les réponses aux questions les plus fréquentes sur l’offre, le déroulement de la collaboration et la méthode de travail. Cliquez sur le nom d’une section pour afficher les questions.</p>
<div class="faq-lista">
<?php foreach ($sekcje as $sekcja): ?>
	<details class="faq-sekcja-box">
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
<p class="duza-prawa">Au plaisir de collaborer !
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
