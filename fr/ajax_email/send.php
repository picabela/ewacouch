<?php

	header('Content-Type: text/html; charset=utf-8');

	function form_msg($ok, $msg)
	{
		echo '<p class="' . ($ok ? 'form-ok' : 'form-error') . '">' . $msg . '</p>';
		exit;
	}

	function clean_line($str)
	{
		// usuwa znaki nowej linii - ochrona przed wstrzykiwaniem naglowkow e-mail
		return trim(str_replace(array("\r", "\n", "%0a", "%0d"), '', $str));
	}

	if (strtoupper($_SERVER['REQUEST_METHOD']) !== 'POST') {
		form_msg(false, 'Requête invalide.');
	}

	// pole-pulapka na boty (honeypot) - czlowiek go nie widzi i nie wypelnia
	if (!empty($_POST['website'])) {
		form_msg(true, 'Merci ! Votre message a été envoyé.');
	}

	$name    = isset($_POST['name'])    ? clean_line($_POST['name'])   : '';
	$e_mail  = isset($_POST['e_mail'])  ? clean_line($_POST['e_mail']) : '';
	$phone   = isset($_POST['phone'])   ? clean_line($_POST['phone'])  : '';
	$message = isset($_POST['message']) ? trim($_POST['message'])      : '';

	if ($name === '' || $e_mail === '' || $message === '' || !filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
		form_msg(false, 'Veuillez remplir correctement tous les champs du formulaire.');
	}

	$to      = 'damian@semanticad.pl'; // TYMCZASOWO na czas testow; docelowo: ewawedry111@gmail.com
	$subject = '=?UTF-8?B?' . base64_encode('E-mail du site web') . '?=';

	$body = 'Nom et prénom : ' . $name . "\r\n" .
	        'E-mail: ' . $e_mail . "\r\n" .
	        ($phone !== '' ? 'Téléphone : ' . $phone . "\r\n" : '') .
	        "\r\n" .
	        'Message :' . "\r\n" . $message;

	$domain  = isset($_SERVER['SERVER_NAME']) ? preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']) : 'localhost';
	$headers = 'From: formularz@' . $domain . "\r\n" .
	           'Reply-To: ' . $e_mail . "\r\n" .
	           'MIME-Version: 1.0' . "\r\n" .
	           'Content-Type: text/plain; charset=UTF-8' . "\r\n" .
	           'Content-Transfer-Encoding: 8bit';

	if (mail($to, $subject, $body, $headers)) {
		form_msg(true, 'Merci ! Votre message a été envoyé. Je vous répondrai dès que possible.');
	} else {
		form_msg(false, 'Le message n\'a pas pu être envoyé. Veuillez réessayer ou m\'écrire directement par e-mail.');
	}
