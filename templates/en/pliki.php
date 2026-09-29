<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }
/*
 * Privacy and cookie policy (EN). See templates/pl/pliki.php for notes
 * on the ewc-policy markers and the cookie declaration placeholder.
 */
$mail  = e($contact['email']);
$phone = e($contact['phone']);
$addr  = e($contact['street'] . ', ' . $contact['postcode'] . ' ' . $contact['city'] . ', Poland');
?>
                                <div class="banner-podstrona">

                                        <div class="desc2">

                                     <div class="odnosnik"> <a class="kont" href="<?= e(page_url($lang, 'kontakt')) ?>"> book an introductory session   <br>in person or online  <span class="pom">&#8658;</span></a> </div>
<h1 class="tytul">Privacy and cookie policy</h1>

<div class="polityka">
<!--ewc-policy-start-->
<p class="polityka-meta">Effective from 29 September 2026.</p>

<p>This document explains what personal data I process when you use ewedrychowska-coaching.pl (including the blog at ewedrychowska-coaching.pl/blog), for what purposes and on what legal basis, who it may be shared with and what rights you have. It also describes cookies and how consent is managed.</p>

<h2 class="polityka-h2">1. Data controller</h2>
<p>The controller of your personal data is <strong>Ewa Wędrychowska</strong>, <?= $addr ?> (the “Controller”). You can contact me about any matter relating to personal data:</p>
<ul class="polityka-lista">
	<li>by e-mail: <a href="mailto:<?= $mail ?>"><?= $mail ?></a>,</li>
	<li>by phone: <?= $phone ?>,</li>
	<li>in writing at: <?= $addr ?>.</li>
</ul>

<h2 class="polityka-h2">2. Purposes, legal bases and retention periods</h2>

<h3 class="polityka-h3">2.1. Contact form, e-mail and phone</h3>
<dl class="polityka-dl">
	<dt>Data</dt><dd>name, e-mail address, phone number (optional), the content of your message and any other information you choose to provide.</dd>
	<dt>Purpose</dt><dd>replying to your message, arranging an introductory session, preparing an offer.</dd>
	<dt>Legal basis</dt><dd>Art. 6(1)(b) GDPR (steps taken at your request before entering into a contract) and Art. 6(1)(f) GDPR (legitimate interest – handling correspondence).</dd>
	<dt>Retention</dt><dd>for the duration of the correspondence and no longer than 12 months after it ends, unless a contract is concluded (section 2.2 then applies).</dd>
</dl>

<h3 class="polityka-h3">2.2. Provision of services (coaching, career advisory, Extended DISC®)</h3>
<dl class="polityka-dl">
	<dt>Data</dt><dd>identification and contact details, billing details (e.g. company name, tax ID), information needed to carry out a session or assessment.</dd>
	<dt>Purpose</dt><dd>concluding and performing the contract, invoicing, meeting tax and accounting obligations, establishing, pursuing or defending claims.</dd>
	<dt>Legal basis</dt><dd>Art. 6(1)(b) GDPR (contract), Art. 6(1)(c) GDPR (legal obligations), Art. 6(1)(f) GDPR (claims).</dd>
	<dt>Retention</dt><dd>for the duration of the contract and then until claims become time-barred; accounting records – for 5 years from the end of the year in which the tax payment deadline expired.</dd>
</dl>
<p>Information shared during sessions is confidential – I work in accordance with the ICF Code of Ethics.</p>

<h3 class="polityka-h3">2.3. Newsletter (blog)</h3>
<dl class="polityka-dl">
	<dt>Data</dt><dd>e-mail address and first name, if provided.</dd>
	<dt>Purpose</dt><dd>sending a newsletter about new posts and materials.</dd>
	<dt>Legal basis</dt><dd>your consent – Art. 6(1)(a) GDPR.</dd>
	<dt>Retention</dt><dd>until you withdraw consent (the “unsubscribe” link in every message or by contacting me).</dd>
</dl>
<p>The newsletter is sent on my behalf by UAB “MailerLite”, based in Vilnius (Lithuania).</p>

<h3 class="polityka-h3">2.4. Statistics and marketing (cookies – with your consent)</h3>
<dl class="polityka-dl">
	<dt>Data</dt><dd>identifiers stored in cookies, device and browser information, pages visited, traffic source, approximate location (country, city).</dd>
	<dt>Purpose</dt><dd>aggregated visit statistics and website development (Google Analytics); marketing – only if such tools are introduced and you consent to them.</dd>
	<dt>Legal basis</dt><dd>your consent – Art. 6(1)(a) GDPR in conjunction with Art. 399 of the Polish Electronic Communications Law of 12 July 2024.</dd>
	<dt>Retention</dt><dd>until consent is withdrawn, no longer than the cookie expiry listed in section 6. Google Analytics data is kept for no longer than 14 months.</dd>
</dl>

<h3 class="polityka-h3">2.5. Security and proper operation of the website</h3>
<dl class="polityka-dl">
	<dt>Data</dt><dd>IP address, date and time of the visit, browser and system information, the requested page (server logs), as well as data analysed by Cloudflare to protect against attacks and bots.</dd>
	<dt>Purpose</dt><dd>ensuring the security, availability and correct operation of the website.</dd>
	<dt>Legal basis</dt><dd>Art. 6(1)(f) GDPR (legitimate interest).</dd>
	<dt>Retention</dt><dd>for the log retention period of the providers, no longer than 12 months.</dd>
</dl>

<h3 class="polityka-h3">2.6. Cookie consent log</h3>
<dl class="polityka-dl">
	<dt>Data</dt><dd>a random consent ID, date and time, the choice made, the page address, a shortened (anonymised) IP address, browser information.</dd>
	<dt>Purpose</dt><dd>demonstrating that consent was given or withdrawn (Art. 7(1) GDPR).</dd>
	<dt>Legal basis</dt><dd>Art. 6(1)(c) GDPR (legal obligation) and Art. 6(1)(f) GDPR.</dd>
	<dt>Retention</dt><dd>24 months from when the choice was recorded.</dd>
</dl>

<h3 class="polityka-h3">2.7. Social media profiles</h3>
<p>The website only contains links to my Facebook and LinkedIn profiles – no plugins from these services are embedded, so they receive no data from the website until you click a link. Once you visit these services, the privacy policies of Meta Platforms Ireland Ltd. and LinkedIn Ireland Unlimited Company apply. If you contact me through these services, I process your data to reply (Art. 6(1)(f) GDPR). With regard to the statistics of my Facebook page, I am a joint controller together with Meta Platforms Ireland Ltd.</p>

<h3 class="polityka-h3">2.8. Google Fonts</h3>
<p>To display the website consistently, fonts are loaded from Google servers (Google Fonts). Your browser then connects to Google and transmits, among other things, your IP address. The legal basis is my legitimate interest in a legible and consistent presentation of the website (Art. 6(1)(f) GDPR).</p>

<h2 class="polityka-h2">3. Recipients of data</h2>
<p>Data may only be shared with entities that help me run the website and my business, under data processing agreements or where required by law:</p>
<ul class="polityka-lista">
	<li>the hosting provider (website server and form e-mail delivery),</li>
	<li>Cloudflare, Inc. – content delivery network and protection against attacks,</li>
	<li>Google Ireland Limited / Google LLC – e-mail (Gmail), Google Tag Manager, Google Analytics, Google Fonts,</li>
	<li>UAB “MailerLite” – newsletter delivery,</li>
	<li>providers of accounting and legal services,</li>
	<li>public authorities – only where required by law.</li>
</ul>

<h2 class="polityka-h2">4. Transfers outside the European Economic Area</h2>
<p>Google and Cloudflare may also process data in the United States. Such transfers are based on the European Commission’s adequacy decision of 10 July 2023 under the EU-US Data Privacy Framework (in which both companies participate) and, additionally, on standard contractual clauses approved by the European Commission.</p>

<h2 class="polityka-h2">5. Cookies and consent management</h2>

<h3 class="polityka-h3">5.1. What cookies are</h3>
<p>Cookies are small text files stored on your device when you use the website. They make it possible, among other things, to remember your settings, keep the website secure and – with your consent – produce visit statistics. Cookies fall into four categories: necessary, preferences, statistics and marketing. Necessary cookies do not require consent; the others are only set if you agree to them.</p>

<h3 class="polityka-h3">5.2. How consent works (Google Consent Mode v2)</h3>
<p>On your first visit a window appears in which you can accept all cookies, reject all (except necessary ones) or choose individual categories. Until you decide, only necessary cookies are set.</p>
<p>The website uses Google’s consent mode (Consent Mode v2). Google tools receive your choice in four areas: analytics storage, advertising storage, sharing user data for advertising purposes and ad personalisation. Without your consent these tools do not set analytics or advertising cookies; they may only send limited signals without identifiers (e.g. that a page was viewed), used for aggregated statistical modelling.</p>
<p>Your choice is remembered for 12 months and applies to both the website and the blog. After that time, or after a significant change to the list of cookies, I will ask for your consent again.</p>

<h3 class="polityka-h3">5.3. Changing or withdrawing consent</h3>
<p>You can change or withdraw your consent at any time – with the “Change settings” button in section 6, the “Cookie settings” link in the website footer or the icon in the bottom-left corner of the screen. Withdrawing consent does not affect the lawfulness of processing carried out before the withdrawal.</p>
<p>You can also block or delete cookies in your browser settings: <a href="https://support.google.com/chrome/answer/95647?hl=en" target="_blank" rel="noopener">Chrome</a>, <a href="https://support.mozilla.org/en-US/kb/clear-cookies-and-site-data-firefox" target="_blank" rel="noopener">Firefox</a>, <a href="https://support.apple.com/en-gb/guide/safari/sfri11471/mac" target="_blank" rel="noopener">Safari</a>, <a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener">Edge</a>, <a href="https://help.opera.com/en/latest/web-preferences/#cookies" target="_blank" rel="noopener">Opera</a>. Blocking necessary cookies may make the website harder to use.</p>

<h2 class="polityka-h2">6. List of cookies and your consent</h2>
<div data-ewc-declaration></div>
<noscript><p>To see the current list of cookies and change your consent settings, please enable JavaScript in your browser.</p></noscript>

<h2 class="polityka-h2">7. Your rights</h2>
<p>In connection with the processing of your data, you have the right to:</p>
<ul class="polityka-lista">
	<li>access your data and receive a copy of it (Art. 15 GDPR),</li>
	<li>rectify your data (Art. 16 GDPR),</li>
	<li>erase your data (Art. 17 GDPR),</li>
	<li>restrict processing (Art. 18 GDPR),</li>
	<li>data portability (Art. 20 GDPR),</li>
	<li>object to processing based on legitimate interest (Art. 21 GDPR),</li>
	<li>withdraw consent at any time, without affecting the lawfulness of earlier processing,</li>
	<li>lodge a complaint with the President of the Personal Data Protection Office in Poland (ul. Stawki 2, 00-193 Warsaw, <a href="https://uodo.gov.pl/en" target="_blank" rel="noopener">uodo.gov.pl</a>) or with the supervisory authority in your country of residence.</li>
</ul>
<p>To exercise your rights, write to <a href="mailto:<?= $mail ?>"><?= $mail ?></a> or use the <a href="<?= e(page_url($lang, 'kontakt')) ?>">contact form</a>.</p>

<h2 class="polityka-h2">8. Voluntary provision of data and automated decisions</h2>
<p>Providing data is voluntary, but necessary to reply to your message or to conclude a contract. I do not make decisions based solely on automated processing, including profiling that produces legal effects for you (Art. 22 GDPR).</p>

<h2 class="polityka-h2">9. Data security</h2>
<p>The website uses an encrypted connection (HTTPS). I apply technical and organisational measures appropriate to the risk to protect data against unauthorised access, loss or alteration.</p>

<h2 class="polityka-h2">10. Changes to this policy</h2>
<p>This policy may be updated, e.g. following changes in the law or in the tools used. The current version is always available on this page and its effective date is shown at the top. If a change concerns cookies that require consent, I will ask for your consent again.</p>
<!--ewc-policy-end-->
</div>

                                        </div>

                                </div>
