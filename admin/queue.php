<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();
require_once __DIR__."/../backend/timestamper.php";
require_once __DIR__."/../backend/tasks.php";
require_once __DIR__."/action/submission_delete.php";
require_once __DIR__."/../backend/all_submissions.php";

$all_tasks = get_all_tasks();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Judge queue</title>
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
							<h2>Judge queue</h2>
						</div>
						<table class="table table-striped table-bordered table-responsive">
							<thead><tr>
								<th>ID</th>
								<th>Time</th>
								<th>Author</th>
								<th>Task</th>
								<th>Answer</th>
								<th>Submitted answer</th>
								<th>Verdict</th>
								<th>Action</th>
							</tr></thead>
							<tbody>
								<?php
								foreach ($submissions as $submission) {
									echo "<tr>";
									echo "<td>" . $submission["submission_id"] . "</td>";
									echo "<td>" . time_format($submission["submit_time"]) . "</td>";
									echo "<td>" . $submission["nickname"] . " (username: <em>" . $submission["username"] . "</em>)</td>";
									foreach ($all_tasks as $task) if ($task["task_id"] == $submission["task_id"]) {
										echo "<td>" . $task["short_title"] . "</td>";
										echo "<td>" . $task["answer"] . "</td>";
									}
									if ($submission["verdict"]) {
										echo "<td colspan=2 class='text-center'><i class='glyphicon glyphicon-ok text-success'></i></td>";
									} else {
										echo "<td>" . $submission["answer"] . "</td>";
										echo "<td>Incorrect</td>";
									}
									echo "<td><form onsubmit='return confirm(\"Do you really want to delete this submission?\");' action='?' method='POST'><input type='hidden'name='deleteID' value='" . $submission["submission_id"] . "' /><input type='submit' class='btn btn-xs btn-danger' value='Delete' /></form></td>";
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

	</body>
</html>
