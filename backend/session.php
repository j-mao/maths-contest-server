<?php

require __DIR__."/conn.php";

session_start();
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
		header("location: /");
	}
}

function require_not_login() {
	global $logged_in;
	if ($logged_in) {
		header("location: /contest/overview.php");
	}
}

?>
