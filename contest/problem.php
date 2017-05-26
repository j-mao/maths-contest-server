<?php

require_once __DIR__."/../backend/session.php";
require_login();

if (!isset($_GET["task_id"])) {
	http_response_code(404);
	require __DIR__."/overview.php";
	die();
}

$task_id = intval($_GET["task_id"]);

require_once __DIR__."/../backend/client_action.php";
if (!has_access($_SESSION["user_id"], $task_id)) {
	http_response_code(404);
	require __DIR__."/overview.php";
	die();
}

require_once __DIR__."/../backend/tasks.php";
$my_data = get_task($task_id);
if (!$my_data["success"]) {
	http_response_code(404);
	require __DIR__."/overview.php";
	die();
}

require_once __DIR__."/action/submit.php";
require_once __DIR__."/../backend/submissions.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $my_data["full_title"]; ?></title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-8">
					<div class="page-header">
						<h1><?php echo $my_data["full_title"]; ?></h1>
					</div>
					<p>
						<?php echo $my_data["statement"]; ?>
					</p>
					<p>
						<strong>Think you have the answer?</strong><br />
						Send it through here.
					</p>
					<form action="?" method="POST" class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" id="answer" name="answer" placeholder="Your answer" maxlength=32 />
						</div>
						<input type="submit" class="btn btn-success" value="Submit" />
					</form>
					<hr />
					<p>
						<h2>Previous submissions</h2>
						<?php make_submission_table($_SESSION["user_id"], $task_id); ?>
					</p>
				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
