<?php

require 'conn.php';

function has_access($user_id, $task_id) {
	$conn = get_conn();
	$has = false;
	if (is_null($conn)) {
	} else {
		$sql = "SELECT * FROM opens WHERE user_id=$user_id AND task_id=$task_id;";
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
	if (has_access($user_id, $task_id)) {
		$conn = get_conn();
		if (is_null($conn)) {
		} else {
			$sql = "INSERT INTO submissions (user_id, task_id, answer, verdict) VALUES ($user_id, $task_id, '$answer', $verdict);";
			mysqli_query($conn, $sql);
			$conn->close();
		}
	}
}

?>
