<?php

require_once __DIR__."/conn.php";

function get_all_users() {
	$conn = get_conn();
	$all_users = [];
	if (is_null($conn)) {
	} else {
		$sql = "SELECT user_id, username, nickname, official FROM accounts";
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$all_users[] = $row;
			}
			mysqli_free_result($result);
		}
		$conn->close();
	}
	return $all_users;
}

?>
