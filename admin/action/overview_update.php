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
	if (isset($_POST["contest_name_submit"])) {
		if ($_POST["contest_name"] == '') {
			$has_alert = true;
			$alert_subject = "Contest name cannot be empty.";
			$alert_class = "danger";
		} else {
			$conn = get_conn();
			if (is_null($conn)) {
				$has_alert = true;
				$alert_subject = "An error occurred.";
				$alert_body = "A connection to the database could not be established.";
				$alert_class = "danger";
			} else {
				$contest_name = mysqli_real_escape_string($conn, stripslashes($_POST["contest_name"]));
				$sql = "UPDATE contest SET data_varchar='$contest_name' WHERE variable='contest_name';";
				mysqli_query($conn, $sql);
				$conn->close();
				$has_alert = true;
				$alert_subject = "Your changes have been saved.";
				$alert_class = "success";
			}
		}
	} else if (isset($_POST["contest_start_time_submit"])) {
		$conn = get_conn();
		$timestamp = strtotime($_POST["contest_start_time"]);
		if ($timestamp === false) {
			$has_alert = true;
			$alert_subject = "You entered an invalid time.";
			$alert_class = "danger";
		} else {
			if (is_null($conn)) {
				$has_alert = true;
				$alert_subject = "An error occurred.";
				$alert_body = "A connection to the database could not be established.";
				$alert_class = "danger";
			} else {
				$iso = date('c', $timestamp);
				$sql = "UPDATE contest SET data_datetime='$timestamp' WHERE variable='start_time';";
				mysqli_query($conn, $sql);
				$conn->close();
				$has_alert = true;
				$alert_subject = "Your changes have been saved.";
				$alert_class = "success";
			}
		}
	} else if (isset($_POST["contest_end_time_submit"])) {
		$conn = get_conn();
		$timestamp = strtotime($_POST["contest_end_time"]);
		if ($timestamp === false) {
			$has_alert = true;
			$alert_subject = "You entered an invalid time.";
			$alert_class = "danger";
		} else {
			if (is_null($conn)) {
				$has_alert = true;
				$alert_subject = "An error occurred.";
				$alert_body = "A connection to the database could not be established.";
				$alert_class = "danger";
			} else {
				$iso = date('c', $timestamp);
				$sql = "UPDATE contest SET data_datetime='$timestamp' WHERE variable='end_time';";
				mysqli_query($conn, $sql);
				$conn->close();
				$has_alert = true;
				$alert_subject = "Your changes have been saved.";
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
