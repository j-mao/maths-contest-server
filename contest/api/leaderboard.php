<?php

$LEADERBOARD_SIZE = 3;

require_once __DIR__."/../../backend/session.php";
require_login();
require_once __DIR__."/../../backend/conn.php";

require_once __DIR__."/../../backend/scores.php";

$conn = get_conn();
$scoreboard = [];
$scores = [];

if (is_null($conn)) {
} else {
	$sql = "SELECT COUNT(submissions.submission_id) AS num_submissions, SUM(submissions.verdict) AS solved, accounts.username, submissions.user_id, submissions.task_id, tasks.value, tasks.decrement, tasks.minscore FROM submissions RIGHT JOIN tasks ON tasks.task_id=submissions.task_id RIGHT JOIN accounts ON accounts.user_id=submissions.user_id WHERE (accounts.official=1 OR accounts.user_id=" . $_SESSION["user_id"] . ") AND verdict>=0 GROUP BY accounts.username, submissions.user_id, submissions.task_id, tasks.value, tasks.decrement, tasks.minscore;";
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

$my_result = null;
foreach ($scores as $username => $score) {
	$scoreboard[] = array("username" => $username, "score" => $score, "me" => ($username === $_SESSION["username"]));
	if ($username === $_SESSION["username"]) {
		$my_result = end($scoreboard);
	}
}

if ($my_result === null) {
	$scoreboard[] = array("username" => $_SESSION["username"], "score" => 0, "me" => true);
	$my_result = end($scoreboard);
}

function cmp($a, $b) {
	return $b["score"]-$a["score"];
}

usort($scoreboard, "cmp");

$has_self = false;
$leaderboard = [];
foreach ($scoreboard as $entry) {
	if ($LEADERBOARD_SIZE == 0) {
		break;
	}
	$LEADERBOARD_SIZE -= 1;
	$leaderboard[] = $entry;
	if ($entry["me"]) {
		$has_self = true;
	}
}
if (!$has_self) {
	$leaderboard[] = $my_result;
}

echo json_encode($leaderboard);

?>
