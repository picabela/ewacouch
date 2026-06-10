<?php

	error_reporting(E_NOTICE);



	function valid_email($str)

	{

		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;

	}



	if($_POST['name']!='' && $_POST['e_mail']!='' && $_POST['message']!='' && valid_email($_POST['e_mail'])==TRUE)

	{

		$to = 'ewawedry111@gmail.com';

		$headers = "E-mail ze strony www";

				//'X-Mailer: Wersja PHP/' . phpversion();

		$subject = "E-mail ze strony www";

		$message = 'Imie: '.$_POST['name'].''. "\r\n" . 
		           
		
				   'E-mail: '.$_POST['e_mail'].''. "\r\n" . 

				   'tresc zapytania: '.$_POST['message'];
					
 			   //    'Napisano: '. htmlspecialchars($_POST['message']);

		

  	 $message= iconv('utf-8', 'iso-8859-2', $message); 

		

		

		if(mail($to, $subject, $message, $headers))

		{

			echo '<p>Wiadomosc zostala wyslana</p>';

		}

		else {

			echo "<p>Wiadomosc nie zostala wyslana</p>";

		}

	}

	else {

		echo '<p>Wypelnij poprawnie wszystkie pola formularza.</p>';

	}

?> 