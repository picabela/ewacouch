<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }
/*
 * Politique de confidentialité et cookies (FR). Voir templates/pl/pliki.php
 * pour les remarques sur les marqueurs ewc-policy et la déclaration des cookies.
 */
$mail  = e($contact['email']);
$phone = e($contact['phone']);
$addr  = e($contact['street'] . ', ' . $contact['postcode'] . ' ' . $contact['city'] . ', Pologne');
?>
                                <div class="banner-podstrona">

                                        <div class="desc2">

                                     <div class="odnosnik"> <a class="kont" href="<?= e(page_url($lang, 'kontakt')) ?>"> prenez rendez-vous pour une séance préliminaire   <br>en présentiel ou en ligne  <span class="pom">&#8658;</span></a> </div>
<h1 class="tytul">Politique de confidentialité et cookies</h1>

<div class="polityka">
<!--ewc-policy-start-->
<p class="polityka-meta">En vigueur depuis le 29 septembre 2026.</p>

<p>Ce document explique quelles données personnelles je traite lorsque vous utilisez le site ewedrychowska-coaching.pl (y compris le blog à l’adresse ewedrychowska-coaching.pl/blog), à quelles fins et sur quelle base juridique, à qui elles peuvent être communiquées et quels sont vos droits. Il décrit également les cookies et la gestion du consentement.</p>

<h2 class="polityka-h2">1. Responsable du traitement</h2>
<p>Le responsable du traitement de vos données personnelles est <strong>Ewa Wędrychowska</strong>, <?= $addr ?> (ci-après le « Responsable »). Pour toute question relative aux données personnelles, vous pouvez me contacter :</p>
<ul class="polityka-lista">
	<li>par e-mail : <a href="mailto:<?= $mail ?>"><?= $mail ?></a>,</li>
	<li>par téléphone : <?= $phone ?>,</li>
	<li>par courrier à l’adresse : <?= $addr ?>.</li>
</ul>

<h2 class="polityka-h2">2. Finalités, bases juridiques et durées de conservation</h2>

<h3 class="polityka-h3">2.1. Formulaire de contact, e-mail et téléphone</h3>
<dl class="polityka-dl">
	<dt>Données</dt><dd>nom et prénom, adresse e-mail, numéro de téléphone (facultatif), contenu du message et toute autre information que vous choisissez de transmettre.</dd>
	<dt>Finalité</dt><dd>répondre à votre message, organiser une séance préliminaire, préparer une offre.</dd>
	<dt>Base juridique</dt><dd>art. 6, par. 1, point b) du RGPD (mesures précontractuelles prises à votre demande) et art. 6, par. 1, point f) du RGPD (intérêt légitime – gestion de la correspondance).</dd>
	<dt>Durée</dt><dd>pendant la durée de la correspondance, puis au maximum 12 mois après sa fin, sauf si un contrat est conclu (le point 2.2 s’applique alors).</dd>
</dl>

<h3 class="polityka-h3">2.2. Prestation de services (coaching, conseil professionnel, Extended DISC®)</h3>
<dl class="polityka-dl">
	<dt>Données</dt><dd>données d’identification et de contact, données de facturation (par ex. nom de l’entreprise, numéro fiscal), informations nécessaires à la réalisation d’une séance ou d’une évaluation.</dd>
	<dt>Finalité</dt><dd>conclusion et exécution du contrat, facturation, respect des obligations fiscales et comptables, constatation, exercice ou défense de droits en justice.</dd>
	<dt>Base juridique</dt><dd>art. 6, par. 1, point b) du RGPD (contrat), point c) (obligations légales), point f) (défense de droits).</dd>
	<dt>Durée</dt><dd>pendant la durée du contrat, puis jusqu’à l’expiration du délai de prescription ; documents comptables – 5 ans à compter de la fin de l’année au cours de laquelle l’échéance fiscale est intervenue.</dd>
</dl>
<p>Les informations partagées pendant les séances sont confidentielles – je travaille conformément au Code de déontologie de l’ICF.</p>

<h3 class="polityka-h3">2.3. Newsletter (blog)</h3>
<dl class="polityka-dl">
	<dt>Données</dt><dd>adresse e-mail et prénom, si vous le communiquez.</dd>
	<dt>Finalité</dt><dd>envoi d’une newsletter sur les nouveaux articles et contenus.</dd>
	<dt>Base juridique</dt><dd>votre consentement – art. 6, par. 1, point a) du RGPD.</dd>
	<dt>Durée</dt><dd>jusqu’au retrait de votre consentement (lien « se désabonner » dans chaque message ou en me contactant).</dd>
</dl>
<p>L’envoi de la newsletter est assuré pour mon compte par UAB « MailerLite », établie à Vilnius (Lituanie).</p>

<h3 class="polityka-h3">2.4. Statistiques et marketing (cookies – avec votre consentement)</h3>
<dl class="polityka-dl">
	<dt>Données</dt><dd>identifiants stockés dans les cookies, informations sur l’appareil et le navigateur, pages consultées, source de la visite, localisation approximative (pays, ville).</dd>
	<dt>Finalité</dt><dd>statistiques de fréquentation agrégées et amélioration du site (Google Analytics) ; marketing – uniquement si de tels outils sont mis en place et que vous y consentez.</dd>
	<dt>Base juridique</dt><dd>votre consentement – art. 6, par. 1, point a) du RGPD, en lien avec l’art. 399 de la loi polonaise du 12 juillet 2024 sur les communications électroniques.</dd>
	<dt>Durée</dt><dd>jusqu’au retrait du consentement, sans dépasser la durée de vie des cookies indiquée au point 6. Les données de Google Analytics sont conservées au maximum 14 mois.</dd>
</dl>

<h3 class="polityka-h3">2.5. Sécurité et bon fonctionnement du site</h3>
<dl class="polityka-dl">
	<dt>Données</dt><dd>adresse IP, date et heure de la visite, informations sur le navigateur et le système, page demandée (journaux du serveur), ainsi que les données analysées par Cloudflare pour la protection contre les attaques et les robots.</dd>
	<dt>Finalité</dt><dd>garantir la sécurité, la disponibilité et le bon fonctionnement du site.</dd>
	<dt>Base juridique</dt><dd>art. 6, par. 1, point f) du RGPD (intérêt légitime).</dd>
	<dt>Durée</dt><dd>pendant la durée de conservation des journaux par les prestataires, au maximum 12 mois.</dd>
</dl>

<h3 class="polityka-h3">2.6. Registre des consentements aux cookies</h3>
<dl class="polityka-dl">
	<dt>Données</dt><dd>identifiant aléatoire du consentement, date et heure, choix effectué, adresse de la page, adresse IP raccourcie (anonymisée), informations sur le navigateur.</dd>
	<dt>Finalité</dt><dd>démontrer que le consentement a été donné ou retiré (art. 7, par. 1 du RGPD).</dd>
	<dt>Base juridique</dt><dd>art. 6, par. 1, point c) du RGPD (obligation légale) et art. 6, par. 1, point f) du RGPD.</dd>
	<dt>Durée</dt><dd>24 mois à compter de l’enregistrement du choix.</dd>
</dl>

<h3 class="polityka-h3">2.7. Profils sur les réseaux sociaux</h3>
<p>Le site contient uniquement des liens vers mes profils Facebook et LinkedIn – aucun module de ces services n’est intégré, ils ne reçoivent donc aucune donnée du site tant que vous ne cliquez pas sur un lien. Une fois sur ces services, les politiques de confidentialité de Meta Platforms Ireland Ltd. et de LinkedIn Ireland Unlimited Company s’appliquent. Si vous me contactez via ces services, je traite vos données afin de vous répondre (art. 6, par. 1, point f) du RGPD). Pour les statistiques de ma page Facebook, je suis responsable conjointe du traitement avec Meta Platforms Ireland Ltd.</p>

<h3 class="polityka-h3">2.8. Google Fonts</h3>
<p>Pour un affichage homogène du site, les polices de caractères sont chargées depuis les serveurs de Google (Google Fonts). Votre navigateur se connecte alors à Google et transmet notamment votre adresse IP. La base juridique est mon intérêt légitime à une présentation lisible et cohérente du site (art. 6, par. 1, point f) du RGPD).</p>

<h2 class="polityka-h2">3. Destinataires des données</h2>
<p>Les données ne peuvent être communiquées qu’aux entités qui m’aident à gérer le site et mon activité, sur la base de contrats de sous-traitance ou lorsque la loi l’exige :</p>
<ul class="polityka-lista">
	<li>l’hébergeur (serveur du site et envoi des e-mails du formulaire),</li>
	<li>Cloudflare, Inc. – réseau de diffusion de contenu et protection contre les attaques,</li>
	<li>Google Ireland Limited / Google LLC – messagerie (Gmail), Google Tag Manager, Google Analytics, Google Fonts,</li>
	<li>UAB « MailerLite » – envoi de la newsletter,</li>
	<li>prestataires de services comptables et juridiques,</li>
	<li>autorités publiques – uniquement lorsque la loi l’exige.</li>
</ul>

<h2 class="polityka-h2">4. Transferts hors de l’Espace économique européen</h2>
<p>Google et Cloudflare peuvent également traiter des données aux États-Unis. Ces transferts reposent sur la décision d’adéquation de la Commission européenne du 10 juillet 2023 relative au EU-US Data Privacy Framework (auquel les deux sociétés participent) et, à titre complémentaire, sur les clauses contractuelles types approuvées par la Commission européenne.</p>

<h2 class="polityka-h2">5. Cookies et gestion du consentement</h2>

<h3 class="polityka-h3">5.1. Qu’est-ce qu’un cookie</h3>
<p>Les cookies sont de petits fichiers texte enregistrés sur votre appareil lorsque vous utilisez le site. Ils permettent notamment de mémoriser vos paramètres, d’assurer la sécurité du site et – avec votre consentement – d’établir des statistiques de fréquentation. Les cookies sont répartis en quatre catégories : nécessaires, préférences, statistiques et marketing. Les cookies nécessaires ne requièrent pas de consentement ; les autres ne sont déposés que si vous les acceptez.</p>

<h3 class="polityka-h3">5.2. Fonctionnement du consentement (Google Consent Mode v2)</h3>
<p>Lors de votre première visite, une fenêtre s’affiche et vous permet d’accepter tous les cookies, de tous les refuser (à l’exception des cookies nécessaires) ou de choisir certaines catégories. Tant que vous n’avez pas fait de choix, seuls les cookies nécessaires sont déposés.</p>
<p>Le site utilise le mode de consentement de Google (Consent Mode v2). Les outils Google reçoivent votre choix dans quatre domaines : stockage des données analytiques, stockage des données publicitaires, transmission des données utilisateur à des fins publicitaires et personnalisation des annonces. Sans votre consentement, ces outils ne déposent aucun cookie analytique ou publicitaire ; ils peuvent uniquement envoyer des signaux limités, sans identifiant (par ex. l’affichage d’une page), utilisés pour une modélisation statistique agrégée.</p>
<p>Votre choix est conservé pendant 12 mois et s’applique à la fois au site et au blog. Passé ce délai, ou après une modification importante de la liste des cookies, votre consentement vous sera redemandé.</p>

<h3 class="polityka-h3">5.3. Modifier ou retirer votre consentement</h3>
<p>Vous pouvez modifier ou retirer votre consentement à tout moment – avec le bouton « Modifier les paramètres » au point 6, le lien « Paramètres des cookies » en bas de page ou l’icône en bas à gauche de l’écran. Le retrait du consentement n’affecte pas la licéité du traitement effectué avant ce retrait.</p>
<p>Vous pouvez également bloquer ou supprimer les cookies dans les paramètres de votre navigateur : <a href="https://support.google.com/chrome/answer/95647?hl=fr" target="_blank" rel="noopener">Chrome</a>, <a href="https://support.mozilla.org/fr/kb/clear-cookies-and-site-data-firefox" target="_blank" rel="noopener">Firefox</a>, <a href="https://support.apple.com/fr-fr/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a>, <a href="https://support.microsoft.com/fr-fr/microsoft-edge/supprimer-les-cookies-dans-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Edge</a>, <a href="https://help.opera.com/fr/latest/web-preferences/#cookies" target="_blank" rel="noopener">Opera</a>. Le blocage des cookies nécessaires peut compliquer l’utilisation du site.</p>

<h2 class="polityka-h2">6. Liste des cookies et votre consentement</h2>
<div data-ewc-declaration></div>
<noscript><p>Pour afficher la liste actuelle des cookies et modifier vos paramètres de consentement, veuillez activer JavaScript dans votre navigateur.</p></noscript>

<h2 class="polityka-h2">7. Vos droits</h2>
<p>En ce qui concerne le traitement de vos données, vous disposez du droit :</p>
<ul class="polityka-lista">
	<li>d’accéder à vos données et d’en obtenir une copie (art. 15 du RGPD),</li>
	<li>de rectifier vos données (art. 16 du RGPD),</li>
	<li>d’obtenir l’effacement de vos données (art. 17 du RGPD),</li>
	<li>d’obtenir la limitation du traitement (art. 18 du RGPD),</li>
	<li>à la portabilité de vos données (art. 20 du RGPD),</li>
	<li>de vous opposer au traitement fondé sur l’intérêt légitime (art. 21 du RGPD),</li>
	<li>de retirer votre consentement à tout moment, sans affecter la licéité du traitement antérieur,</li>
	<li>d’introduire une réclamation auprès du Président de l’Office polonais de protection des données personnelles (ul. Stawki 2, 00-193 Varsovie, <a href="https://uodo.gov.pl/en" target="_blank" rel="noopener">uodo.gov.pl</a>) ou auprès de l’autorité de contrôle de votre pays de résidence (en France : la CNIL).</li>
</ul>
<p>Pour exercer vos droits, écrivez à <a href="mailto:<?= $mail ?>"><?= $mail ?></a> ou utilisez le <a href="<?= e(page_url($lang, 'kontakt')) ?>">formulaire de contact</a>.</p>

<h2 class="polityka-h2">8. Caractère facultatif et décisions automatisées</h2>
<p>La communication de vos données est facultative, mais nécessaire pour répondre à votre message ou conclure un contrat. Je ne prends aucune décision fondée exclusivement sur un traitement automatisé, y compris le profilage produisant des effets juridiques à votre égard (art. 22 du RGPD).</p>

<h2 class="polityka-h2">9. Sécurité des données</h2>
<p>Le site utilise une connexion chiffrée (HTTPS). J’applique des mesures techniques et organisationnelles adaptées au risque afin de protéger les données contre tout accès non autorisé, perte ou modification.</p>

<h2 class="polityka-h2">10. Modifications de la politique</h2>
<p>Cette politique peut être mise à jour, par exemple en raison d’une évolution de la législation ou des outils utilisés. La version en vigueur est toujours disponible sur cette page et sa date d’entrée en vigueur figure en haut du document. Si une modification concerne des cookies soumis à consentement, votre consentement vous sera redemandé.</p>
<!--ewc-policy-end-->
</div>

                                        </div>

                                </div>
