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
			$sql = "SELECT user_id, username, nickname FROM accounts WHERE username='$username' AND password='$password';";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_assoc($result);
					$_SESSION["user_id"] = intval($row["user_id"]);
					$_SESSION["username"] = mysqli_real_escape_string($conn, stripslashes($row["username"]));
					$_SESSION["nickname"] = mysqli_real_escape_string($conn, stripslashes($row["nickname"]));
					$_SESSION["admin"] = false;
					header("location: /contest/overview.php");
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
}

if ($has_alert) {
	$alert_subject = "Failed to log in.";
	$alert_class = "danger";
}

?>
