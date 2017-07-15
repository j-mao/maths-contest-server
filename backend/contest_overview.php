<?php

require_once "conn.php";

$contest_name = "";
$contest_start_time = "";
$contest_end_time = "";
$contest_num_tasks = "";
$contest_num_contestants = "";

$conn = get_conn();

if (is_null($conn)) {
	/*
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['contest_name_submit'])) {
			$new_name = mysqli_real_escape_string($conn, stripslashes($_POST['contest_name']));
			$sql = "UPDATE contest SET data_varchar='$new_name' WHERE variable='contest_name';";
			mysqli_query($conn, $sql);
		}
		if (isset($_POST['contest_start_time_submit'])) {
			$new_start = mysqli_real_escape_string($conn, stripslashes($_POST['contest_start_time']));
			$sql = "UPDATE contest SET data_varchar='$new_start' WHERE variable='start_time';";
			mysqli_query($conn, $sql);
		}
		if (isset($_POST['contest_end_time_submit'])) {
			$new_end = mysqli_real_escape_string($conn, stripslashes($_POST['contest_end_time']));
			$sql = "UPDATE contest SET data_varchar='$new_end' WHERE variable='end_time';";
			mysqli_query($conn, $sql);
		}
	}
	*/
} else {
	$sql = "SELECT * FROM contest;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row["variable"] == "contest_name") {
				$contest_name = $row["data_varchar"];
			} else if ($row["variable"] == "start_time") {
				$contest_start_time = $row["data_datetime"];
			} else if ($row["variable"] == "end_time") {
				$contest_end_time = $row["data_datetime"];
			}
		}
		mysqli_free_result($result);
	}
	$sql = "SELECT COUNT(task_id) AS numtasks FROM tasks;";
	if ($result = mysqli_query($conn, $sql)) {
		if ($row = mysqli_fetch_assoc($result)) {
			$contest_num_tasks = $row["numtasks"];
		}
		mysqli_free_result($result);
	}
	$sql = "SELECT COUNT(user_id) AS numcontestants FROM accounts;";
	if ($result = mysqli_query($conn, $sql)) {
		if ($row = mysqli_fetch_assoc($result)) {
			$contest_num_contestants = $row["numcontestants"];
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

?>
