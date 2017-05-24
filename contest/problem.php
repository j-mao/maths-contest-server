<?php

require "../backend/session.php";
require_login();

if (!isset($_GET["task_id"])) {
	http_response_code(404);
	require "overview.php";
	die();
}

$task_id = intval($_GET["task_id"]);

require "../backend/tasks.php";
$my_data = get_task($task_id);
if (!$my_data["success"]) {
	http_response_code(404);
	require "overview.php";
	die();
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $my_data["full_title"]; ?></title>
		<?php require "include/header.html"; ?>
	</head>
	<body>

		<?php require "include/topbar.php"; ?>

		<div class="container-fluid">
			<div class="row">
				<?php require "include/sidebar.php"; ?>

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
							<input type="text" class="form-control" id="answer" placeholder="Your answer" maxlength=50 />
						</div>
						<input type="submit" class="btn btn-success" value="Submit" />
					</form>
					<hr />
					<p>
						<h2>Previous submissions</h2>
						<?php
						require "../backend/submissions.php";
						make_submission_table($_SESSION["user_id"], $task_id);
						?>
					</p>
				</div>

				<?php require "include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
