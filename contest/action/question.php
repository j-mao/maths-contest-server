<?php

require_once __DIR__."/../../backend/session.php";
require_login();

$has_alert = false;
$alert_subject = "";
$alert_body = "";
$alert_class = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$subject = trim($_POST["subject"]);
	$body = trim($_POST["body"]);
	if ($subject !== "" || $body !== "") {
		send_question($subject, $body);
		$alert_subject = "Question received";
		$alert_body = "Your question has been received, and will be answered as soon as possible. You will be notified once an answer is sent.";
		$alert_class = "success";
	} else {
		$alert_subject = "Question ignored";
		$alert_body = "It appears that you have submitted an empty question. Please enter a question and try again.";
		$alert_class = "danger";
	}
	$has_alert = true;
}

?>
