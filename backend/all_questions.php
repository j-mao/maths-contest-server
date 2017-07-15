<?php

require_once __DIR__."/session.php";
require_not_login();
require_admin();
require_once __DIR__."/conn.php";

$conn = get_conn();
$questions = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT questions.question_id, questions.receive_time, questions.q_subject, questions.q_body, questions.answer_time, questions.a_subject, questions.a_body, accounts.username, accounts.nickname FROM questions WHERE receive_time IS NOT NULL RIGHT JOIN accounts ON questions.user_id=accounts.user_id ORDER BY questions.receive_time DESC;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$questions[] = $row;
		}
		mysqli_free_result($result);
	}
	$conn->close();
}

?>
