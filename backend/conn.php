<?php

function get_problem_data($problem_name, $problem_aspect) {
	// TODO
	;
}

function get_conn() {
	$sql_servername = "localhost";
	$sql_username = "contest-manager";
	$sql_password = "password";
	$sql_dbname = "contest";

	$conn = mysqli_connect($sql_servername, $sql_username, $sql_password);

	if (mysqli_connect_errno()) {
		return null;
	}

	mysqli_select_db($conn, $sql_dbname);

	return $conn;
}


?>
