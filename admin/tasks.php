<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();

#require_once __DIR__."/action/task_update.php";
$has_alert = false;
$alert_subject = '';
$alert_body = '';
$alert_class = '';
if (true) {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$has_alert = true;
		$alert_subject = 'Action not supported';
		$alert_body = 'As the contest management system is still under development, this action is not yet supported. Please contact me if you urgently need to complete this action.';
		$alert_class = 'warning';
	}
}

require_once __DIR__."/../backend/tasks.php";
$all_tasks = get_all_tasks();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tasks</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body class="contains-scroll">
		<div class="hidden-xs contains-scroll">
			<div class="row contains-scroll">
				<?php require __DIR__."/include/sidebar.html"; ?>
				<div class="col-sm-9 contains-scroll scrollable">
					<div class="container-fluid">
						<?php require __DIR__."/include/alerts.php"; ?>
						<div class="page-header">
							<h2>Tasks</h2>
						</div>
						<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addTask">Add a task</button>
						<table class="table table-striped table-bordered table-responsive table-hover">
						<thead><tr>
						<th>ID</th>
						<th>Full title</th>
						<th>Display name</th>
						<th>System directory</th>
						<th>Answer</th>
						<th>Point value</th>
						<th>Point decrement</th>
						<th>Minimum score</th>
						<th>Action</th>
						</tr></thead>
						<tbody>
						<?php
							foreach ($all_tasks as $task) {
								echo "<tr>";
								echo "<td>" . $task["task_id"] . "</td>";
								echo "<td>" . $task["full_title"] . "</td>";
								echo "<td>" . $task["short_title"] . "</td>";
								echo "<td>" . $task["directory"] . "</td>";
								echo "<td>" . $task["answer"] . "</td>";
								echo "<td>" . $task["value"] . "</td>";
								echo "<td>" . $task["decrement"] . "</td>";
								echo "<td>" . $task["minscore"] . "</td>";
								echo "<td><form onsubmit='return confirm(\"Do you really want to remove this task?\");' action='?' method='POST'><input type='hidden' name='deleteID' value='" . $task["task_id"] . "' /><input type='submit' class='btn btn-xs btn-danger' value='Remove' /></form></td>";
								echo "</tr>";
							}
						?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php require __DIR__."/include/screen_xs.html"; ?>

		<div class="modal fade" id="addTask" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Change contest end time</h4>
					</div>
					<div class="modal-body">
						<p>This action is not yet supported.</p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Add" name="add_task_submit" />
					</div>
				</form>
			</div>
		</div>

	</body>
</html>
