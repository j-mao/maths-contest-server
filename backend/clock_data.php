<?php

require_once __DIR__."/conn.php";

$conn = get_conn();
$start_time = 0;
$end_time = 0;

if (is_null($conn)) {
} else {
	$sql = "SELECT data_datetime FROM contest WHERE variable='start_time';";
	if ($result = mysqli_query($conn, $sql)) {
		if ($row = mysqli_fetch_assoc($result)) {
			$start_time = strtotime($row["data_datetime"]);
		}
		mysqli_free_result($result);
	}
	$sql = "SELECT data_datetime FROM contest WHERE variable='end_time';";
	if ($result = mysqli_query($conn, $sql)) {
		if ($row = mysqli_fetch_assoc($result)) {
			$end_time = strtotime($row["data_datetime"]);
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

$current_time = time();

$start_time *= 1000;
$end_time *= 1000;
$current_time *= 1000;

?>
