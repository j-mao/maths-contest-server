<?php

require_once __DIR__."/../../backend/session.php";
require_login();
require_once __DIR__."/../../backend/conn.php";

$conn = get_conn();
$num_messages = 0;

if (is_null($conn)) {
} else {
	$sql = "SELECT message_id FROM messages WHERE user_id=" . $_SESSION["user_id"] . ";";
	if ($result = mysqli_query($conn, $sql)) {
		$num_messages = mysqli_num_rows($result);
		mysqli_free_result($result);
	} else {
	}
	$conn->close();
}

echo $num_messages;

?>
