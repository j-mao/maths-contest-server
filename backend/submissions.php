<?php

require_once __DIR__."/conn.php";
require_once __DIR__."/timestamper.php";

function get_submissions($user_id, $task_id) {
	$conn = get_conn();
	$submissions = [];
	if (is_null($conn)) {
	} else {
		$sql = "SELECT submit_time, answer, verdict FROM submissions WHERE ";
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$submissions[] = clone $row;
			}
			mysqli_free_result($result);
		} else {
		}
		$conn->close();
	}
	return $submissions;
}

function make_submission_table($user_id, $task_id) {
	echo "\n\n<!-- Begin generated submission table -->\n\n";
	$submissions = get_submissions($user_id, $task_id);
	echo "<table class=\"table table-striped table-bordered table-hover table-responsive\">\n";
	echo "<thead>\n";
	echo "<tr>\n";
	echo "<th>Time</th>\n";
	echo "<th>Your answer</th>\n";
	echo "<th>Verdict</th>\n";
	echo "</tr>\n";
	echo "</thead>\n";
	echo "<tbody>\n";
	$num_submissions = count($submissions);
	for ($i = 0;$i < $num_submissions;$i++) {
		echo "<tr>\n";
		echo "<td>" . time_format($num_submissions[$i]["submit_time"]) . "</td>\n";
		echo "<td>" . htmlspecialchars($submissions[$i]["answer"]) . "</td>\n";
		if ($submissions[$i]["verdict"] == 1) {
			echo "<td class=\"success\">" . Correct . "</td>\n";
		} else if ($submissions[$i]["verdict"] == 0) {
			echo "<td class=\"danger\">" . Incorrect . "</td>\n";
		} else if ($submissions[$i]["verdict"] == -1) {
			echo "<td>" . Ignored . "</td>\n";
		}
		echo "</tr>\n";
	}
	if ($num_submissions == 0) {
		echo "<tr>\n";
		echo "<td colspan=3 class=\".text-center\"><em>No submissions yet.</em></td>";
		echo "</tr>\n";
	}
	echo "</tbody>\n";
	echo "</table>\n";
	echo  "\n\n<!-- End generated submission table -->\n\n";
}

?>
