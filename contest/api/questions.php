<?php

require_once __DIR__."/../../backend/session.php";
require_login();
require_once __DIR__."/../../backend/conn.php";

$conn = get_conn();
$num_questions = 0;

if (is_null($conn)) {
} else {
	$sql = "SELECT question_id FROM questions WHERE user_id=" . $_SESSION["user_id"] . ";";
	if ($result = mysqli_query($conn, $sql)) {
		$num_questions = mysqli_num_rows($result);
		mysqli_free_result($result);
	} else {
	}
	$conn->close();
}

echo $num_questions;

?>
