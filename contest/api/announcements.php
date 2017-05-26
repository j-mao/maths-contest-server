<?php

require_once __DIR__."/../../backend/session.php";
require_login();
require_once __DIR__."/../../backend/conn.php";

$conn = get_conn();
$num_announcements = 0;

if (is_null($conn)) {
} else {
	$sql = "SELECT announcement_id FROM announcements;";
	if ($result = mysqli_query($conn, $sql)) {
		$num_announcements = mysqli_num_rows($result);
		mysqli_free_result($result);
	} else {
	}
	$conn->close();
}

echo $num_announcements;

?>
