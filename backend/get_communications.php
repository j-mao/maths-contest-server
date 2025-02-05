<?php

require_once __DIR__."/session.php";
require_login();
require_once __DIR__."/conn.php";

$conn = get_conn();
$announcements = [];
$questions = [];
$messages = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT * FROM announcements ORDER BY announcement_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$announcements[] = $row;
		}
		mysqli_free_result($result);
	} else {
	}
	$sql = "SELECT * FROM questions WHERE user_id=" . $_SESSION["user_id"] . " AND receive_time IS NOT NULL ORDER BY receive_time;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$questions[] = $row;
		}
		mysqli_free_result($result);
	}
	$sql = "SELECT * FROM messages WHERE user_id=" . $_SESSION["user_id"] . " ORDER BY message_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$messages[] = $row;
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

?>
