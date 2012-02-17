<?php

class MailC extends C {

	public function contactable() {
		//declare our assets
		$name = stripcslashes($_POST['name']);
		$email = stripcslashes($_POST['email']);
		$comment = stripcslashes($_POST['comment']);
		$topic = stripcslashes($_POST['topic']);
		$subject = stripcslashes($_POST['subject']);

		if (!$name) {
			echo ('Your name is required!');
			exit(0);
		}
		if (!$email) {
			echo ('A message is required!');
			exit(0);
		}
		if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
			echo ('A valid email address is required!');
			exit(0);
		}

        //compose headers
        $headers = "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/".phpversion();

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

		//if successful lets send the message
		if (mail($to, $subject, $comment, $headers)) {
			echo ('success'); //return success callback
		} else {
			echo ('An error occured while sending your message. Please try again!');
		}
		exit(0);
	}
}