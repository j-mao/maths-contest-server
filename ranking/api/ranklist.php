<?php

require_once __DIR__."/../../backend/session.php";
require_not_login();
require_admin();
require_once __DIR__."/../../backend/conn.php";

require_once __DIR__."/../../backend/scores.php";

$conn = get_conn();
$ranklist = [];
$task_scores = [];
$scores = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT COUNT(submissions.submission_id) AS num_submissions, SUM(submissions.verdict) AS solved, accounts.nickname, submissions.user_id, submissions.task_id, tasks.value, tasks.decrement, tasks.minscore FROM submissions RIGHT JOIN tasks ON tasks.task_id=submissions.task_id RIGHT JOIN accounts ON accounts.user_id=submissions.user_id WHERE verdict>=0 GROUP BY accounts.nickname, submissions.user_id, submissions.task_id, tasks.value, tasks.decrement, tasks.minscore ORDER BY submissions.task_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			if (!array_key_exists($row["nickname"], $scores)) {
				$scores[$row["nickname"]] = [];
			}
			$scores[$row["nickname"]]["task".$row["task_id"]] = calc_score($row["solved"], $row["num_submissions"], $row["value"], $row["decrement"], $row["minscore"]);
		}
		mysqli_free_result($result);
	} else {
	}
	$conn->close();
}

foreach ($scores as $nickname => $scoredata) {
	$total = 0;
	foreach ($scoredata as $val) {
		$total += $val;
	}
	$ranklist[] = array("nickname" => $nickname, "scores" => $scoredata, "total" => $total);
}

function cmp($a, $b) {
	return $a["score"]-$b["score"];
}

usort($ranklist, "cmp");

echo json_encode($ranklist);

?>
