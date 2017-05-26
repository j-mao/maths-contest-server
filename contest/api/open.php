<?php

require __DIR__."/../../backend/session.php";
require_login();

require __DIR__."/../../backend/client_action.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_POST["task_id"])) {
		http_response_code(404);
		require __DIR__."/../overview.php";
		die();
	}

	$task_id = intval($_GET["task_id"]);

	if (in_contest($task_id)) {
		if (!has_access($_SESSION["user_id"], $task_id)) {
			request_access($_SESSION["user_id"], $task_id);
		}
	}
}

?>
