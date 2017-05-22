<?php

require '../backend/session.php';
require '../backend/client_action.php';

require_login();

function remove_spaces($str) {
	return preg_replace('/\s/', '', $str);
}

function check_answer($str1, $str2) {
	return strcmp(remove_spaces($str1), remove_spaces($str2)) === 0;
}

$messagebox_subject = "";
$messagebox_body = "";
$messagebox_class = "";

if ($logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$task_id = $_POST["task_id"];
	if (in_contest($problem_id)) {
		$submitted_answer = $_POST["answer"];
		if (is_numeric($submitted_answer)) {
			$expected_answer = get_problem_data();
			$verdict = check_answer($submitted_answer, $expected_answer);
			submit_answer($_SESSION["user_id"], $task_id, $submitted_answer, $verdict);
			if ($verdict) {
				$messagebox_subject = "Submission received";
				$messagebox_body = "Your answer has been received, and has been marked as correct.";
				$messagebox_class = "green";
			} else {
				$messagebox_subject = "Submission received";
				$messagebox_body = "Your answer has been received, and has been marked as incorrect.";
				$messagebox_class = "red";
			}
		} else {
			$messagebox_subject = "Submission rejected";
			$messagebox_body = "Your submission was rejected because it was not a valid number.";
			$messagebox_class = "red";
		}
	}
}

?>
