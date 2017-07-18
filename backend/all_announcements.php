<?php

require_once __DIR__."/session.php";
require_not_login();
require_admin();
require_once __DIR__."/conn.php";

$conn = get_conn();
$announcements = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT * FROM announcements;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$announcements[] = $row;
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

?>
