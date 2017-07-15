<?php

require_once __DIR__."/../backend/session.php";
require_login();
require_not_admin();

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
		<script type="text/x-mathjax-config">MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});</script>
		<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid" id="everything">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-9">
					<div class="page-header">
						<h2><?php echo $my_data["full_title"]; ?></h2>
					</div>
					<p>
						<?php echo $my_data["statement"]; ?>
					</p>
					<br />
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
					<hr />
					<p>
						<h3>Previous submissions</h3>
						<?php make_submission_table($_SESSION["user_id"], $task_id); ?>
					</p>
				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
