<?php

require_once "conn.php";
require_once "tasks.php";

function make_dashboard($user_id) {
	echo "\n<!-- Begin generated dashboard -->\n";
	$conn = get_conn();
	$tasks = [];
	$dirs = [];
	$opens = [];
	$solved = [];
	$solves = [];

	if (is_null($conn)) {
	} else {
		$sql = "SELECT tasks.task_id, problems.directory FROM tasks RIGHT JOIN problems ON tasks.problem_id=problems.problem_id;";
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$tasks[] = $row["task_id"];
				$dirs[] = $row["directory"];
			}
			mysqli_free_result($result);
		} else {
		}
		sort($tasks);

		$sql = "SELECT task_id FROM opens WHERE user_id=$user_id;";
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$opens[] = $row["task_id"];
			}
			mysqli_free_result($result);
		} else {
		}

		$sql = "SELECT task_id FROM submissions WHERE user_id=$user_id AND verdict=1;";
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$solved[] = $row["task_id"];
			}
			mysqli_free_result($result);
		}

		$sql = "SELECT COUNT(submission_id) AS num_solves, task_id FROM submissions WHERE verdict=1 GROUP BY task_id;";
		$solves_arr_len = 0;
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$i = 0;
				while ($tasks[$i] != $row["task_id"]) {
					$i++;
				}
				while ($solves_arr_len <= $i) {
					$solves[] = 0;
					$solves_arr_len++;
				}
				$solves[$i] = $row["num_solves"];
			}
			mysqli_free_result($result);
		}

		$conn->close();
	}

	$num_tasks = count($tasks);
	echo "<div class=\"panel panel-primary\">\n";
	echo "<div class=\"panel-heading\">Problems</div>\n";
	for ($i = 0;$i < $num_tasks;$i++) {
		if (in_array($tasks[$i], $solved)) {
			echo "<a class=\"list-group-item list-group-item-success\" href=\"/contest/problem.php?task_id=" . $tasks[$i] . "\">";
			echo get_problem_data($dirs[$i], "full_title");
		} else if (in_array($tasks[$i], $opens)) {
			echo "<a class=\"list-group-item list-group-item-info\" href=\"/contest/problem.php?task_id=" . $tasks[$i] . "\">";
			echo get_problem_data($dirs[$i], "full_title");
		} else {
			echo "<a class=\"list-group-item\" href=\"#\" onclick=\"request_access(" . $tasks[$i] . ");\">";
			echo get_problem_data($dirs[$i], "public_display");
		}
		echo "\n<span class=\"pull-right\">\n";
		if ($i < $solves_arr_len) {
			if ($solves[$i] > 0) {
				echo "<span class=\"label label-default\">solved by " . $solves[$i] . "</span>\n";
			}
		}
		if (in_array($tasks[$i], $solved)) {
			echo "<span class=\"label label-success\">solved</span>";
		} else if (in_array($tasks[$i], $opens)) {
			echo "<span class=\"label label-info\">opened</span>";
		}
		echo "</span>\n";
		echo "</a>\n";
	}
	echo "</div>\n";

	echo "<!-- End generated dashboard -->\n";
}

?>
