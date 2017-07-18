<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();
require_once __DIR__."/../backend/timestamper.php";
require_once __DIR__."/action/announcement_action.php";
require_once __DIR__."/../backend/all_announcements.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Announcements</title>
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
							<h2>Announcements</h2>
						</div>
						<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createAnnouncement">Create an announcement</button>
						<br /><br />
						<div class="panel-group">
							<?php
								foreach ($announcements as $announcement) {
									echo '<div class="panel panel-default">';
									echo '<div class="panel-heading">';
									echo 'Announcement at ' . time_format($announcement["send_time"]);
									echo "<span class='pull-right'><form onsubmit='return confirm(\"Do you really want to delete this announcement?\");' action='?' method='POST'><input type='hidden' name='deleteID' value='" . $announcement["announcement_id"] . "' /><input type='submit' class='btn btn-xs btn-danger' name='ann-delete' value='Delete' /></form></span>";
									echo '</div>';
									echo '<div class="panel-body">';
									if ($announcement["subject"] != "") {
										echo '<h4>' . htmlspecialchars($announcement["subject"]) . '</h4>';
									} else {
										echo '<h4><em>(no subject)</em></h4>';
									}
									echo '<p>' . htmlspecialchars($announcement["body"]) . '</p>';
									echo '</div>';
									echo '</div>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require __DIR__."/include/screen_xs.html"; ?>

		<div class="modal fade" id="createAnnouncement" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create an announcement</h4>
					</div>
					<div class="modal-body">
						<p>Subject:</p>
						<input type="text" class="form-control" name="ann-subject" placeholder="Subject" maxlength=32 />
						<br />
						<p>Body:</p>
						<textarea rows=8 class="form-control" name="ann-body" placeholder="Body" maxlength=255></textarea>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Send" name="ann-send" />
					</div>
				</form>
			</div>
		</div>

	</body>
</html>
