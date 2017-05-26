<?php

require __DIR__."/conn.php";

function get_problem_data($directory, $aspect) {
	$file = fopen($directory, "r") or return "Error";
	$result = fread($file, filesize($directory));
	fclose($file);
	return $result;
}

function get_task($task_id) {
	$task_data = array(
		"full_title" => "Error",
		"short_title" => "Error",
		"statement" => "Error",
		"value" => 0,
		"decrement" => 0,
		"minscore" => 0,
		"success" => false
	);
	$conn = get_conn();
	if (is_null($conn)) {
	} else {

		$problem_id = NULL;
		$sql = "SELECT problem_id, value, decrement, minscore FROM tasks WHERE task_id=$task_id;";
		if ($result = mysqli_query($conn, $sql)) {
			if (mysqli_num_rows($result) == 1) {
				$row = mysqli_fetch_assoc($result);
				$problem_id = $row["problem_id"];
				$task_data["value"] = $row["value"];
				$task_data["decrement"] = $row["decrement"];
				$task_data["minscore"] = $row["minscore"];
			}
			mysqli_free_result($result);
		} else {
		}

		$directory = NULL;
		if (is_null($problem_id)) {
		} else {
			$sql = "SELECT directory FROM problems WHERE problem_id=$problem_id;";
			if ($result = mysqli_query($conn, $sql)) {
				$row = mysqli_fetch_assoc($result);
				$directory = $row["directory"];
			} else {
			}
			mysqli_free_result($result);
		}
		$conn->close();

		if (is_null($directory)) {
		} else {
			$task_data["full_title"] = get_problem_data($directory, "full_title");
			$task_data["short_title"] = get_problem_data($directory, "short_title");
			$task_data["statement"] = get_problem_data($directory, "statement");
			$task_data["success"] = true;
		}
	}
	return $task_data;
}

// WARNING: unused function
function get_all_tasks() {
	$task_data = [];
	$conn = get_conn();
	if (is_null($conn)) {
	} else {
		$task_ids = [];
		$sql = "SELECT task_id FROM tasks";
		if ($result = mysqli_query($conn, $sql)) {
			while ($row = mysqli_fetch_assoc($result)) {
				$task_ids[] = $row["task_id"];
			}
			mysqli_free_result($result);
		} else {
		}
		$conn->close();

		$num_ids = count($task_ids);
		for ($i = 0;$i < $num_ids;$i++) {
			$task_data[] = get_task($task_ids[$i]);
		}
	}
	return $task_data;
}

?>
