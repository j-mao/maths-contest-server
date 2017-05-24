<?php

require '../../backend/session.php';
require '../../backend/client_action.php';

require_login();

function remove_spaces($str) {
	return preg_replace('/\s/', '', $str);
}

function check_answer($str1, $str2) {
	return strcmp(remove_spaces($str1), remove_spaces($str2)) === 0;
}

$has_alert = false;
$alert_subject = "";
$alert_body = "";
$alert_class = "";

if ($logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$task_id = $_POST["task_id"];
	if (in_contest($problem_id)) {
		$submitted_answer = $_POST["answer"];
		if (is_numeric($submitted_answer)) {
			$expected_answer = get_problem_data();
			$verdict = check_answer($submitted_answer, $expected_answer);
			submit_answer($_SESSION["user_id"], $task_id, $submitted_answer, $verdict);
			if ($verdict) {
				$alert_subject = "Submission received";
				$alert_body = "Your answer has been received, and has been marked as correct.";
				$alert_class = "green";
			} else {
				$alert_subject = "Submission received";
				$alert_body = "Your answer has been received, and has been marked as incorrect.";
				$alert_class = "red";
			}
		} else {
			$alert_subject = "Submission rejected";
			$alert_body = "Your submission was rejected because it was not a valid number.";
			$alert_class = "red";
		}
		$has_alert = true;
	}
}

?>
