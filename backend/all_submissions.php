<?php

require_once __DIR__."/session.php";
require_not_login();
require_admin();
require_once __DIR__."/conn.php";

$conn = get_conn();
$submissions = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT submissions.submission_id, accounts.username, accounts.nickname, tasks.task_id, submissions.submit_time, submissions.answer, submissions.verdict FROM submissions RIGHT JOIN tasks ON tasks.task_id=submissions.task_id RIGHT JOIN accounts ON accounts.user_id=submissions.user_id ORDER BY submissions.submit_time DESC;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$submissions[] = $row;
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

?>
