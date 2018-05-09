<?php

require_once __DIR__."/../backend/session.php";
require_login();
require_not_admin();
require_once __DIR__."/../backend/clock_data.php";

if (!isset($_GET["task_id"])) {
	http_response_code(404);
	require __DIR__."/overview.php";
	die();
}

$task_id = intval($_GET["task_id"]);

require_once __DIR__."/../backend/client_action.php";
if (!has_access($_SESSION["user_id"], $task_id)) {
	#http_response_code(404);
	#require __DIR__."/overview.php";
	#die();
	request_access($_SESSION["user_id"], $task_id);
}

require_once __DIR__."/../backend/tasks.php";
$my_data = get_task($task_id);
if (!$my_data["success"]) {
	http_response_code(404);
	require __DIR__."/overview.php";
	die();
}

if ($current_time < $end_time) {
	require_once __DIR__."/action/submit.php";
}
require_once __DIR__."/../backend/submissions.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $my_data["full_title"]; ?></title>
		<?php require __DIR__."/include/header.php"; ?>
		<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>
		<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
		<script type="text/javascript" src="/contest/js/access.js"></script>
		<script type="text/javascript" src="/contest/js/problem.js"></script>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid" id="everything">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-9">
					<?php if ($current_time < $start_time) { ?>
					<div class="page-header">
						<h2>The problem name goes here.</h2>
					</div>
					<p>
						Please wait for the contest to start. The problem will appear here when that happens.
					</p>
					<?php } else { ?>
					<div class="page-header">
						<h2><?php echo $my_data["full_title"]; ?> <small>(<?php echo $my_data["value"]; ?> points)</small></h2>
					</div>
					<p>
						<?php echo $my_data["statement"]; ?>
					</p>
					<br />
					<?php if ($current_time > $end_time) { ?>
					<p>
						The contest has ended.
					</p>
					<?php } else if (has_solved($_SESSION["user_id"], $task_id)) { ?>
					<p>
						You have already solved this problem.
					</p>
					<?php } else { ?>
					<p>
						<strong>Think you have the answer?</strong>
						Send it through here.
					</p>
					<form action="?task_id=<?php echo $_GET["task_id"]; ?>" method="POST" class="form-inline">
						<div class="form-group">
							<input type="text" class="form-control" id="answer" name="answer" placeholder="Your answer" maxlength=32 />
						</div>
						<input type="hidden" name="task_id" value="<?php echo $_GET["task_id"]; ?>" />
						<input type="submit" class="btn btn-success" value="Submit" />
					</form>
					<?php } ?>
					<br />
					<div class="btn-group">
					<?php
					$tasks = prev_next($task_id);
					if ($tasks[0] !== NULL) {
						if ($tasks[1]) {
							echo '<a href="/contest/problem.php?task_id=' . $tasks[0] . '" class="btn btn-default">Previous</a>';
						} else {
							echo '<a href="#" onclick="request_access(' . $tasks[0] . ');" class="btn btn-default">Previous</a>';
						}
					} else {
						echo '<a href="#" class="btn btn-default disabled">Previous</a>';
					}
					if ($tasks[2] !== NULL) {
						if ($tasks[3]) {
							echo '<a href="/contest/problem.php?task_id=' . $tasks[2] . '" class="btn btn-default">Next</a>';
						} else {
							echo '<a href="#" onclick="request_access(' . $tasks[2] . ');" class="btn btn-default">Next</a>';
						}
					} else {
						echo '<a href="#" class="btn btn-default disabled">Next</a>';
					}
					?>
					</div>
					<hr />
					<h3>Previous submissions</h3>
					<?php make_submission_table($_SESSION["user_id"], $task_id); ?>
					<?php } ?>
				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
