<?php

require_once "conn.php";

$contest_name = "";
$contest_start_time = "";
$contest_end_time = "";
$contest_num_tasks = "";
$contest_num_contestants = "";

$conn = get_conn();

if (is_null($conn)) {
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
	;
} else {
	$conn->close();
}

?>
