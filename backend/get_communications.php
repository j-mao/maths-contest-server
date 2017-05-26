<?php

require __DIR__."/../../backend/session.php";
require_login();
require __DIR__."/../../backend/conn.php";

$conn = get_conn();
$announcements = [];
$questions = [];
$messages = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT * FROM announcements ORDER BY announcement_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$announcements[] = clone $row;
		}
		mysqli_free_result($result);
	} else {
	}
	$sql = "SELECT * FROM questions WHERE user_id=" . $_SESSION["user_id"] . " ORDER BY question_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$questions[] = clone $row;
		}
		mysqli_free_result($result);
	}
	$sql = "SELECT * FROM messages WHERE user_id=" . $_SESSION["user_id"] . " ORDER  BY message_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$messages[] = clone $row;
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

?>
