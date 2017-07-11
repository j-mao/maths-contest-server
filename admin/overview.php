<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();
require_once __DIR__."/action/overview_update.php";
require_once __DIR__."/../backend/contest_overview.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Overview</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body class="contains-scroll">
		<div class="hidden-xs contains-scroll">
			<div class="row contains-scroll">
				<?php require __DIR__."/include/sidebar.html"; ?>
				<div class="col-sm-9 contains-scroll scrollable">
					<div class="container-fluid">
						<div class="page-header">
							<h2>Overview</h2>
						</div>
						<div class="row">
							<div class="col-sm-3 text-right">Contest name:</div>
							<div class="col-sm-9">
								<?php echo htmlspecialchars($contest_name); ?>
								(<a href="#" data-toggle="modal" data-target="#contest_name-modal">Change</a>)
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 text-right">Contest start time:</div>
							<div class="col-sm-9">
								<?php echo $contest_start_time; ?>
								(<a href="#" data-toggle="modal" data-target="#contest_start-modal">Change</a>)
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 text-right">Contest end time:</div>
							<div class="col-sm-9">
								<?php echo $contest_end_time; ?>
								(<a href="#" data-toggle="modal" data-target="#contest_end-modal">Change</a>)
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 text-right">Number of tasks:</div>
							<div class="col-sm-9">
								<?php echo $contest_num_tasks; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3 text-right">Number of contestants:</div>
							<div class="col-sm-9">
								<?php echo $contest_num_contestants; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require __DIR__."/include/screen_xs.html"; ?>

		<div class="modal fade" id="contest_name-modal" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Change contest name</h4>
					</div>
					<div class="modal-body">
						<p>
							Enter the new contest name below:
						</p>
						<input type="text" maxlength=32 class="form-control" id="contest_name" name="contest_name" />
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Update" name="contest_name_submit" maxlength=32 />
					</div>
				</form>
			</div>
		</div>

		<div class="modal fade" id="contest_start-modal" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Change contest start time</h4>
					</div>
					<div class="modal-body">
						<p>
							Enter the new contest start time below:
						</p>
						<input type="text" maxlength=32 class="form-control" id="contest_start_time" name="contest_start_time" />
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Update" name="contest_start_time_submit" maxlength=64 />
					</div>
				</form>
			</div>
		</div>

		<div class="modal fade" id="contest_end-modal" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Change contest end time</h4>
					</div>
					<div class="modal-body">
						<p>
							Enter the new contest end time below:
						</p>
						<input type="text" maxlength=32 class="form-control" id="contest_end_time" name="contest_end_time" />
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Update" name="contest_end_time_submit" maxlength=64 />
					</div>
				</form>
			</div>
		</div>

	</body>
</html>
