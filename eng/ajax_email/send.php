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
		form_msg(false, 'Invalid request.');
	}

	// pole-pulapka na boty (honeypot) - czlowiek go nie widzi i nie wypelnia
	if (!empty($_POST['website'])) {
		form_msg(true, 'Thank you! Your message has been sent.');
	}

	$name    = isset($_POST['name'])    ? clean_line($_POST['name'])   : '';
	$e_mail  = isset($_POST['e_mail'])  ? clean_line($_POST['e_mail']) : '';
	$phone   = isset($_POST['phone'])   ? clean_line($_POST['phone'])  : '';
	$message = isset($_POST['message']) ? trim($_POST['message'])      : '';

	if ($name === '' || $e_mail === '' || $message === '' || !filter_var($e_mail, FILTER_VALIDATE_EMAIL)) {
		form_msg(false, 'Please fill out all form fields correctly.');
	}

	$to      = 'damian@semanticad.pl'; // TYMCZASOWO na czas testow; docelowo: ewawedry111@gmail.com
	$subject = '=?UTF-8?B?' . base64_encode('E-mail from the website') . '?=';

	$body = 'Full name: ' . $name . "\r\n" .
	        'E-mail: ' . $e_mail . "\r\n" .
	        ($phone !== '' ? 'Phone: ' . $phone . "\r\n" : '') .
	        "\r\n" .
	        'Message:' . "\r\n" . $message;

	$domain  = isset($_SERVER['SERVER_NAME']) ? preg_replace('/^www\./', '', $_SERVER['SERVER_NAME']) : 'localhost';
	$headers = 'From: formularz@' . $domain . "\r\n" .
	           'Reply-To: ' . $e_mail . "\r\n" .
	           'MIME-Version: 1.0' . "\r\n" .
	           'Content-Type: text/plain; charset=UTF-8' . "\r\n" .
	           'Content-Transfer-Encoding: 8bit';

	if (mail($to, $subject, $body, $headers)) {
		form_msg(true, 'Thank you! Your message has been sent. I will reply as soon as possible.');
	} else {
		form_msg(false, 'The message could not be sent. Please try again or contact me directly by e-mail.');
	}
