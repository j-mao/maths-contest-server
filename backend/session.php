<?php

require_once __DIR__."/conn.php";

if (session_id() === "") session_start();
$logged_in = false;

if (isset($_SESSION["user_id"]) && isset($_SESSION["username"]) && isset($_SESSION["nickname"])) {

	$conn = get_conn();

	if (is_null($conn)) {
	} else {
		$sql = "SELECT user_id FROM accounts WHERE user_id=" . $_SESSION["user_id"] . " AND username='" . $_SESSION["username"] . "' AND nickname='" . $_SESSION["nickname"] . "';";
		if ($result = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($result) == 1) {
				$logged_in = true;
			}
			mysqli_free_result($result);
		} else {
		}
		$conn->close();
	}
}

function require_login() {
	global $logged_in;
	if (!$logged_in) {
		header("location: /contest/");
	}
}

function require_not_login() {
	global $logged_in;
	if ($logged_in) {
		header("location: /contest/overview.php");
	}
}

function require_admin() {
	if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
		header("location: /admin/");
	}
}

function require_not_admin() {
	if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
		header("location: /admin/overview.php");
	}
}

?>
