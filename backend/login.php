<?php

require 'conn.php';

session_start();
$error = "";

if (isset($_POST["submit"])) {
	if (empty($_POST["username"])) {
		$error = "Failed to log in.";
	} else if (empty($_POST["password"])) {
		$error = "Failed to log in.";
	} else {
		$conn = get_conn();
		if (is_null($conn)) {
			$error = "Failed to log in.";
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
					header("location: /contest/overview.php");
				} else {
					$error = "Failed to log in.";
				}
				mysqli_free_result($result);
			} else {
				$error = "Failed to log in.";
			}
			$conn->close();
		}
	}
}

?>
