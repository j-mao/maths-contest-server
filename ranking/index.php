<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();
require_once __DIR__."/../backend/tasks.php";
$task_data = get_all_tasks();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Ranking</title>
		<script type="text/javascript">
		var problem_values = [
		<?php
		$comma = false;
		foreach ($task_data as $task) {
			if ($comma) echo ", ";
			$comma = true;
			echo $task["value"];
		}
		?>
		];
		var total_points = 0;
		for (var i = 0;i < problem_values.length;i++) {
			total_points += problem_values[i];
		}
		</script>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body>

		<div class="container">
			<div class="page-header">
				<h1>Ranking</h1>
			</div>
			<div class="row">
				<div class="col-sm-3" id="clock">
				</div>
				<div class="col-sm-9">
					<table class="table table-responsive ranklist">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Total</th>
								<?php
									foreach ($task_data as $task) {
										echo "<th>" . $task["short_title"] . "</th>";
									}
								?>
							</tr>
						</thead>
						<tbody id="ranklist">
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</body>
</html>
