<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }

/*
 * FAQ (EN) - collapsible thematic sections. Single data source for the visible
 * content and the FAQPage structured data. Links point only to pages that exist
 * in this language (helper returns plain text otherwise).
 */
$link = function ($key, $label) use ($lang) {
    global $pages;
    if (isset($pages[$lang][$key])) {
        return '<a href="' . e(page_url($lang, $key)) . '">' . e($label) . '</a>';
    }
    return e($label);
};

$sekcje = array(

    array('tytul' => 'Offer, cooperation and contact', 'pytania' => array(
        array(
            'q' => 'What coaching and advisory services are available?',
            'a' => 'The offer includes ' . $link('coaching-kariery', 'career coaching') . ', '
                 . $link('executive-coaching', 'executive coaching') . ' (managerial coaching), '
                 . $link('doradztwo-zawodowe', 'career advisory') . ' and '
                 . $link('life-coaching', 'life coaching') . '. The ' . $link('extended-disc', 'Extended Disc®')
                 . ' test is also used. Both private individuals and companies wishing to develop and support their employees benefit from these services.',
        ),
        array(
            'q' => 'Who is coaching for — individuals or companies?',
            'a' => 'For both. Coaching is aimed at private individuals who want to grow, make changes and achieve a better quality of life, as well as companies that want to support their leaders, managers, employees taking on new responsibilities, changing career paths or preparing for retirement.',
        ),
        array(
            'q' => 'How to book a coaching session and start working together?',
            'a' => 'Simply write or call and arrange an introductory session — in person or online. It is a good moment to get to know each other, discuss the situation and see how coaching can help. Contact details and a form are available on the ' . $link('kontakt', 'Contact') . ' page.',
        ),
        array(
            'q' => 'Are coaching sessions held online or in person?',
            'a' => 'Both formats are possible — in-person meetings in Kraków or online work, depending on the client’s preferences and possibilities.',
        ),
        array(
            'q' => 'How do the first meeting and the coaching contract work?',
            'a' => 'During the first meeting a coaching contract is signed together, setting out the terms of cooperation. If the service is commissioned by an employer, a tripartite contract is created.',
        ),
        array(
            'q' => 'How long does the coaching process last and how often are sessions held?',
            'a' => 'The process usually comprises 5 to 10 sessions that follow a clearly defined structure. Sessions take place every 2–3 weeks, and the time between them is used to implement the solutions worked out.',
        ),
        array(
            'q' => 'In which languages are coaching sessions conducted?',
            'a' => 'Sessions are conducted in Polish, French, Spanish and English.',
        ),
        array(
            'q' => 'How to contact a career coach in Kraków?',
            'a' => 'The easiest way is by phone (' . e($contact['phone']) . ') or e-mail (' . e($contact['email'])
                 . '). The office is located in Kraków at ' . e($contact['street']) . '. Details and a contact form are on the ' . $link('kontakt', 'Contact') . ' page.',
        ),
    )),

    array('tytul' => 'Career coaching and career advisory', 'pytania' => array(
        array(
            'q' => 'Who is career coaching for?',
            'a' => 'Career coaching is for people who are looking for their own vision of a career based on their values, are thinking about changing their career path, need motivation, want to make better use of their potential or feel professional burnout and are looking for a balance between work and private life. More on the ' . $link('coaching-kariery', 'career coaching') . ' page.',
        ),
        array(
            'q' => 'What is the difference between career coaching and career advisory?',
            'a' => $link('coaching-kariery', 'Career coaching') . ' focuses on discovering your vision of development, goals and strategy, and on overcoming internal blocks. '
                 . $link('doradztwo-zawodowe', 'Career advisory') . ' is more concrete support in job searching: competency analysis, search strategy, preparation of a professional CV and cover letter, and preparation for a recruitment interview.',
        ),
        array(
            'q' => 'What does career advisory involve and how does it help?',
            'a' => 'Career advisory helps to map competencies and predispositions, identify strengths, set professional goals and target employers, build a job-search strategy, create a professional CV and prepare for a recruitment interview. Details are described on the ' . $link('doradztwo-zawodowe', 'career advisory') . ' page.',
        ),
        array(
            'q' => 'Professional burnout — can career coaching help?',
            'a' => 'Yes. Coaching helps to regain motivation, look at the situation from a new perspective, get rid of internal blocks and set truly important goals, as well as take care of the balance between work and private life.',
        ),
    )),

    array('tytul' => 'Executive coaching (managerial coaching)', 'pytania' => array(
        array(
            'q' => 'What is executive coaching and who is it for?',
            'a' => $link('executive-coaching', 'Executive coaching') . ' is coaching for managers and leaders who want to motivate and develop employees more effectively, cope better with emotions and stress, manage time and tasks more efficiently, build good relationships with superiors and regain energy and self-confidence.',
        ),
        array(
            'q' => 'What results does executive coaching bring?',
            'a' => 'The result is more effective team management, better control over emotions and greater resistance to stress, deeper knowledge of one’s own potential, a clearer vision of development, easier decision-making and the release of energy and motivation to act.',
        ),
        array(
            'q' => 'What diagnostic tools are used when working with managers?',
            'a' => 'When working with managers, the ' . $link('extended-disc', 'Extended Disc®')
                 . ' test is used, which diagnoses, among others, the natural management style, talents and strengths. It helps to better understand one’s own way of acting and building relationships in a team.',
        ),
    )),

    array('tytul' => 'Leadership development after promotion from an expert role', 'pytania' => array(
        array(
            'q' => 'How to find your way as a leader after being promoted from an expert role?',
            'a' => 'It is worth starting with a change of perspective. A leader does not have to know every detail better than the team. Their task is to support people, set direction, build accountability and create conditions for good cooperation.',
        ),
        array(
            'q' => 'Why does a feeling of not being a good enough leader appear after a promotion?',
            'a' => 'It is natural, especially when self-confidence previously rested mainly on expert knowledge. The new role requires different competencies: communication, delegation, building trust and managing accountability.',
        ),
        array(
            'q' => 'What is the difference between the role of an expert and the role of a leader?',
            'a' => 'An expert focuses primarily on their own tasks and specialist knowledge. A leader is responsible for people, decisions, direction and team development. That is why, in the new role, supporting others becomes more important than personally controlling every detail.',
        ),
        array(
            'q' => 'How to rebuild self-confidence in a new managerial role?',
            'a' => 'It helps to recall one’s own successes, strengths and the reasons the promotion was offered to that particular person. It is also worth clearly defining what superiors and the team really expect, instead of trying to prove that one knows everything. ' . $link('executive-coaching', 'Executive coaching') . ' can help in this process.',
        ),
        array(
            'q' => 'Where to start leadership development?',
            'a' => 'Best of all with one concrete step: defining your role, talking to the team or consciously letting go of excessive control. Leadership development begins with understanding that you do not have to do everything yourself — it is about creating conditions in which others can perform well.',
        ),
    )),

    array('tytul' => 'Life coaching and personal development', 'pytania' => array(
        array(
            'q' => 'What is life coaching and when is it worth using?',
            'a' => $link('life-coaching', 'Life coaching') . ' is for people who are thinking about a change in their life but do not know where to start, are at a crossroads, want to overcome their own barriers, fears and self-criticism, become aware of their potential and live in greater harmony with themselves.',
        ),
        array(
            'q' => 'What results does life coaching bring?',
            'a' => 'Life coaching helps to better define the most suitable goals, gain more self-confidence, consciously use one’s skills, make wiser decisions, get rid of internal blocks and regain a sense of real influence over one’s own life.',
        ),
    )),

    array('tytul' => 'Working method, qualifications and principles', 'pytania' => array(
        array(
            'q' => 'What method is the coaching based on?',
            'a' => 'The coaching is conducted using a solution-focused approach, consistent with the Erickson College methodology. During sessions, the greatest emphasis is on supporting the client in formulating a clear vision of the goal and on working out concrete actions leading to its achievement.',
        ),
        array(
            'q' => 'What qualifications and experience does the coach have?',
            'a' => 'Ewa Wędrychowska is a certified coach (PCC ICF Erickson College International, Vancouver) and a qualified career advisor (European School of Business in Kraków). She has also completed postgraduate studies in human resource management at the AGH University and has over 17 years of business experience, including as an HR manager in an international corporation. More on the ' . $link('omnie', 'about me') . ' page, and client opinions in the ' . $link('referencje', 'references') . '.',
        ),
        array(
            'q' => 'Is coaching subject to ethical principles?',
            'a' => 'Yes. The coach’s work is based on the code of ethics of the International Coach Federation (ICF).',
        ),
    )),

    array('tytul' => 'Extended Disc® test', 'pytania' => array(
        array(
            'q' => 'What is the Extended Disc® test and what does it offer?',
            'a' => $link('extended-disc', 'Extended Disc®') . ' is a tool supporting personal development. It provides information about preferred behavioural styles, making it easier to understand your own way of acting, discover natural talents and predispositions, communication style and what motivates you and what reduces engagement.',
        ),
        array(
            'q' => 'How does the Extended Disc® assessment work?',
            'a' => 'The first step is to order the test. After receiving a link, you activate it and complete the test online, then arrange a 120-minute session to discuss the results (also possible online). After the session, the client receives an approximately 20-page report together with exercises for independent work.',
        ),
    )),

);

$wszystkie = array();
foreach ($sekcje as $s) { foreach ($s['pytania'] as $p) { $wszystkie[] = $p; } }
?>
                                <div class="banner-podstrona">

                                             <div class="desc2">
<h1 class="tytul">Frequently asked questions</h1>
<p class="tresc">Below you will find answers to the most frequently asked questions about the offer, the course of cooperation and the working method. Click a section name to expand the questions.</p>
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
<p class="duza-prawa">I look forward to working with you!
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
