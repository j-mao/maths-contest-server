<?php

require_once __DIR__."/conn.php";

function has_access($user_id, $task_id) {
	$conn = get_conn();
	$has = false;
	if (is_null($conn)) {
	} else {
		$sql = "SELECT open_id FROM opens WHERE user_id=$user_id AND task_id=$task_id;";
		if ($result = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($result) == 1) {
				$has = true;
			}
			mysqli_free_result($result);
		} else {
		}
		$conn->close();
	}
	return $has;
}

function request_access($user_id, $task_id) {
	if (!has_access($user_id, $task_id)) {
		$conn = get_conn();
		if (is_null($conn)) {
		} else {
			$sql = "INSERT INTO opens (user_id, task_id) VALUES ($user_id, $task_id);";
			mysqli_query($conn, $sql);
			$conn->close();
		}
	}
}

function submit_answer($user_id, $task_id, $answer, $verdict) {
	$verdict = intval($verdict);
	if (has_access($user_id, $task_id)) {
		$conn = get_conn();
		if (is_null($conn)) {
		} else {
			$answer = mysqli_real_escape_string($conn, stripslashes($answer));
			$sql = "INSERT INTO submissions (user_id, task_id, answer, verdict) VALUES ($user_id, $task_id, '$answer', $verdict);";
			mysqli_query($conn, $sql);
			$conn->close();
		}
	}
}

function send_question($user_id, $subject, $body) {
	$conn = get_conn();
	if (is_null($conn)) {
	} else {
		$subject = mysqli_real_escape_string($conn, stripslashes($subject));
		$body = mysqli_real_escape_string($conn, stripslashes($body));
		$sql = "INSERT INTO questions (user_id, q_subject, q_body) VALUES ($user_id, '$subject', '$body');";
		mysqli_query($conn, $sql);
		$conn->close();
	}
}

?>
