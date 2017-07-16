<?php

require_once __DIR__."/../../backend/session.php";
require_login();
require_not_admin();

require_once __DIR__."/../../backend/client_action.php";

function fixNumber($value) {
	$value = strpos($value,'.')!==false ? rtrim(rtrim($value,'0'),'.') : $value;
	$negative = ($value[0] == '-');
	if ($negative) {
		$value = substr($value, 1);
	}
	$value = ltrim($value, '0');
	if ($value === '' || $value[0] === '.') {
		$value = '0' . $value;
	}
	if ($negative && $value != '0') {
		$value = '-' . $value;
	}
	return $value;
}

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$task_id = $_POST["task_id"];
	if (in_contest($task_id)) {
		$submitted_answer = $_POST["answer"];
		if (is_numeric($submitted_answer)) {
			$submitted_answer = fixNumber($submitted_answer);
			$expected_answer = get_problem_data($my_data["directory"], "answer");
			$verdict = check_answer($submitted_answer, $expected_answer);
			submit_answer($_SESSION["user_id"], $task_id, $submitted_answer, $verdict);
			if ($verdict) {
				$alert_subject = "Submission received";
				$alert_body = "Your answer has been received, and has been marked as correct.";
				$alert_class = "success";
			} else {
				$alert_subject = "Submission received";
				$alert_body = "Your answer has been received, and has been marked as incorrect.";
				$alert_class = "danger";
			}
		} else {
			$alert_subject = "Submission rejected";
			$alert_body = "Your submission was rejected because it was not a valid number.";
			$alert_class = "danger";
		}
		$has_alert = true;
	}
}

?>
