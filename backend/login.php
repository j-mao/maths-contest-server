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
			$sql = "SELECT * FROM accounts WHERE username='$username' AND password='$password';";
			if ($result = mysqli_query($conn, $sql)) {
				if (mysqli_num_rows($result) == 1) {
					$_SESSION["user_id"] = $result["user_id"];
					$_SESSION["username"] = $result["username"];
					header("location: /static/overview.php");
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
