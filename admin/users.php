<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();

#require_once __DIR__."/action/users_update.php";
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

require_once __DIR__."/../backend/users.php";
$all_users = get_all_users();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Users</title>
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
							<h2>Users</h2>
						</div>
						<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUser">Add a user</button>
						<br /> <br />
						<table class="table table-striped table-bordered table-responsive table-hover">
						<thead><tr>
						<th>ID</th>
						<th>Name</th>
						<th>Username</th>
						<th>Official</th>
						<th>Action</th>
						</tr></thead>
						<tbody>
						<?php
							foreach ($all_users as $user) {
								echo "<tr>";
								echo "<td>" . $user["user_id"] . "</td>";
								echo "<td>" . $user["nickname"] . "</td>";
								echo "<td>" . $user["username"] . "</td>";
								echo "<td>" . $user["official"] . "</td>";
								echo "<td><form onsubmit='return confirm(\"Do you really want to remove this user?\");' action='?' method='POST'><input type='hidden' name='deleteID' value='" . $user["user_id"] . "' /><input type='submit' class='btn btn-xs btn-danger' value='Remove' /></form></td>";
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

		<div class="modal fade" id="addUser" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add a user</h4>
					</div>
					<div class="modal-body">
						<p>This action is not yet supported.</p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Add" name="add_user_submit" />
					</div>
				</form>
			</div>
		</div>

	</body>
</html>
