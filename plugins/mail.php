<?php

class MailC extends C {

	public function contactable() {
		//declare our assets 
		$name = stripcslashes($_POST['name']);
		$email = stripcslashes($_POST['email']);
		$comment = stripcslashes($_POST['comment']);
		$topic = stripcslashes($_POST['topic']);
		$subject = stripcslashes($_POST['subject']);
		
		switch (strtolower($topic)) {
			case 'general':
				$to = LL_EMAIL;
			default:
				$to = LL_EMAIL;
		}
		
		$comment = "
			Topic: $topic
			Message: $comment
		";
		
		//validate the email address on the server side
		if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
			//if successful lets send the message
			mail($to, $subject, $comment);
			echo ('success'); //return success callback
		} else {
			echo ('An invalid email address was entered'); //email was not valid
		}
		exit(0);
	}
}