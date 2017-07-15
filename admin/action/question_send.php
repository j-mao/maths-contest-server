<?php

require_once __DIR__."/../../backend/conn.php";
require_once __DIR__."/../../backend/session.php";

require_not_login();
require_admin();

$has_alert = false;
$alert_subject = "";
$alert_body = "";
$alert_class = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["response-send"])) {
		$result_subject = '';
		$result_body = '';
		if ($_POST["question-responsetype"] == "yes") {
			$result_subject = "Yes";
		} else if ($_POST["question-responsetype"] == "no") {
			$result_subject = "No";
		} else if ($_POST["question-responsetype"] == "no_comment") {
			$result_subject = "No comment";
		} else if ($_POST["question-responsetype"] == "invalid") {
			$result_subject = "Invalid question";
		} else if ($_POST["question-responsetype"] == "answered") {
			$result_subject = "Answered in task description";
		} else {
			$result_body = $_POST["question-response"];
		}
		if ($result_subject == '' && $result_body == '')
			$has_alert = true;
			$alert_subject = "Your response should not be empty.";
			$alert_class = "danger";
		} else {
			$conn = get_conn();
			if (is_null($conn)) {
				$has_alert = true;
				$alert_subject = "An error occurred.";
				$alert_body = "A connection to the database could not be established.";
				$alert_class = "danger";
			} else {
				$result_subject = mysqli_real_escape_string($conn, stripslashes($result_subject));
				$result_body = mysqli_real_escape_string($conn, stripslashes($result_body));
				$sql = "UPDATE questions SET a_subject='$result_subject', a_body='$result_body' WHERE question_id=" . $_POST["question-id"] . ";";
				mysqli_query($conn, $sql);
				$conn->close();
				$has_alert = true;
				$alert_subject = "Your response has been sent.";
				$alert_class = "success";
			}
		}
	} else {
		$has_alert = true;
		$alert_subject = "You made an invalid request.";
		$alert_class = "danger";
	}
}

?>
