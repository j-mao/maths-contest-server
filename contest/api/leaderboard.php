<?php

require_once __DIR__."/../../backend/session.php";
require_login();
require_once __DIR__."/../../backend/conn.php";

require_once __DIR__."/../../backend/scores.php";

$conn = get_conn();
$leaderboard = [];
$scores = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT COUNT(submissions.submission_id) AS num_submissions, SUM(submissions.verdict) AS solved, accounts.username, submissions.user_id, submissions.task_id, tasks.value, tasks.decrement, tasks.minscore FROM submissions RIGHT JOIN tasks ON tasks.task_id=submissions.task_id RIGHT JOIN accounts ON accounts.user_id=submissions.user_id WHERE verdict>=0 GROUP BY accounts.username, submissions.user_id, submissions.task_id, tasks.value, tasks.decrement, tasks.minscore GROUP BY submissions.task_id;";
	if ($result = mysqli_query($conn, $sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			if (!array_key_exists($row["username"], $scores)) {
				$scores[$row["username"]] = 0;
			}
			$scores[$row["username"]] += calc_score($row["solved"], $row["num_submissions"], $row["value"], $row["decrement"], $row["minscore"]);
		}
		mysqli_free_result($result);
	} else {
	}
	$conn->close();
}

$has_self = false;
foreach ($scores as $username => $score) {
	$leaderboard[] = array("username" => $username, "score" => $score, "me" => ($username === $_SESSION["username"]));
	if ($username === $_SESSION["username"]) {
		$has_self = true;
	}
}

if (!$has_self) {
	$leaderboard[] = array("username" => $_SESSION["username"], "score" => 0, "me" => true);
}

function cmp($a, $b) {
	return $a["score"]-$b["score"];
}

usort($leaderboard, "cmp");

echo json_encode($leaderboard);

?>
