<?php

require_once __DIR__."/../../backend/conn.php";
require_once __DIR__."/../../backend/session.php";

require_not_login();
require_not_admin();

if (session_id() === "") session_start();

$has_alert = false;
$alert_subject = "";
$alert_body = "";
$alert_class = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (empty($_POST["username"])) {
		$has_alert = true;
	} else if (empty($_POST["password"])) {
		$has_alert = true;
	} else {
		$conn = get_conn();
		if (is_null($conn)) {
			$has_alert = true;
		} else {
			$username = mysqli_real_escape_string($conn, stripslashes($_POST["username"]));
			$password = mysqli_real_escape_string($conn, stripslashes($_POST["password"]));
			$sql = "SELECT data_varchar FROM contest WHERE data_varchar='$username' AND variable='admin_username';";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) == 1) {
				} else {
					$has_alert = true;
				}
				mysqli_free_result($result);
			} else {
				$has_alert = true;
			}
			$sql = "SELECT data_varbinary FROM contest WHERE data_varbinary='$password' AND variable='admin_password';";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) == 1) {
				} else {
					$has_alert = true;
				}
				mysqli_free_result($result);
			} else {
				$has_alert = true;
			}
			$conn->close();
		}
	}
	if ($has_alert) {
		$alert_subject = "Failed to log in.";
		$alert_class = "danger";
	} else {
		$_SESSION["user_id"] = -1;
		$_SESSION["admin"] = true;
		header("location: /admin/overview.php");
	}
}

?>
