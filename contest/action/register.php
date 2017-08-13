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
		$alert_subject = "Registration failed.";
		$alert_body = "Your username cannot be empty.";
		$alert_class = "danger";
	} else if ($_POST["password"] != $_POST["password2"]) {
		$has_alert = true;
		$alert_subject = "Registration failed.";
		$alert_body = "Your passwords didn't match.";
		$alert_class = "danger";
	} else if (empty($_POST["password"])) {
		$has_alert = true;
		$alert_subject = "Registration failed.";
		$alert_body = "Your password cannot be empty.";
		$alert_class = "danger";
	} else {
		$conn = get_conn();
		if (is_null($conn)) {
			$has_alert = true;
		} else {
			$username = mysqli_real_escape_string($conn, stripslashes($_POST["username"]));
			$password = mysqli_real_escape_string($conn, stripslashes($_POST["password"]));
			$nickname = mysqli_real_escape_string($conn, stripslashes($_POST["nickname"]));
			$sql = "SELECT user_id FROM accounts WHERE username='$username';";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) == 1) {
					$has_alert = true;
					$alert_subject = "Registration failed.";
					$alert_body = "Your username has already been taken.";
					$alert_class = "danger";
				}
				mysqli_free_result($result);
			}
			if (!$has_alert) {
				$sql = "INSERT INTO accounts (username, password, nickname) VALUES ('$username', '$password', '$nickname');";
				mysqli_query($conn, $sql);
				$conn->close();
				$has_alert = true;
				$alert_subject = "Registration succeeded.";
				$alert_body = "You may now go back and log in.";
				$alert_class = "success";
			}
		}
	}
}

?>
