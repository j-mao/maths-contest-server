<?php

require_once __DIR__."/../../backend/session.php";
require_admin();
require_once __DIR__."/../../backend/conn.php";

$conn = get_conn();
$start_time = 0;
$end_time = 0;

if (is_null($conn)) {
} else {
	$sql = "SELECT variable, data_datetime FROM contest WHERE variable='start_time' OR variable='end_time';";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row=mysqli_fetch_assoc($result)) {
			if ($row["variable"] == "start_time") {
				$start_time = strtotime($row["data_datetime"]);
			} else if ($row["variable"] == "end_time") {
				$end_time = strtotime($row["data_datetime"]);
			}
		}
	} else {
	}
	$conn->close();
}

$current_time = time();

$start_time *= 1000;
$end_time *= 1000;
$current_time *= 1000;

echo "$start_time $end_time $current_time";

?>
