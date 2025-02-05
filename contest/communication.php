<?php

require_once __DIR__."/../backend/session.php";
require_login();
require_not_admin();
require_once __DIR__."/../backend/timestamper.php";
require_once __DIR__."/action/question.php";
require_once __DIR__."/../backend/get_communications.php";
require_once __DIR__."/../backend/clock_data.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Communication</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid" id="everything">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-9">
					<div class="page-header">
						<h2>Communication</h2>
					</div>

					<?php
					echo "\n";
					$num_announcements = count($announcements);
					if ($num_announcements > 0) {
						echo "<h3>Announcements</h3>\n";
						for ($i = 0;$i < $num_announcements;$i++) {
							echo "\n<div class=\"alert alert-info\">";
							echo "\n<div class=\"pull-right\">" . time_format($announcements[$i]["send_time"]) . "</div>";
							if ($announcements[$i]["subject"] != "") {
								echo "\n<h4>" . htmlspecialchars($announcements[$i]["subject"]) . "</h4>";
							} else {
								echo "\n<h4><em>(no subject)</em></h4>";
							}
							echo "\n" . htmlspecialchars($announcements[$i]["body"]);
							echo "\n</div>";
						}
					}
					echo "\n";
					?>

					<h3>Questions</h3>
					<div class="well">
						<form action="?" method="POST" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-2" for="subject">Subject</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="subject" name="subject" maxlength=32 />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="body">Message</label>
								<div class="col-sm-10">          
									<textarea class="form-control" rows=8 id="body" name="body" maxlength=255></textarea>
								</div>
							</div>
							<div class="form-group">        
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" class="btn btn-primary" value="Ask question" />
									<button type="reset" class="btn btn-default">Clear</button>
								</div>
							</div>
						</form>
					</div>

					<?php
					echo "\n";
					$num_questions = count($questions);
					for ($i = 0;$i < $num_questions;$i++) {
						echo "\n<div class=\"alert alert-info\">";
						echo "\n<div class=\"pull-right\">" . time_format($questions[$i]["receive_time"]) . "</div>";
						if ($questions[$i]["q_subject"] != "") {
							echo "\n<h4>" . htmlspecialchars($questions[$i]["q_subject"]) . "</h4>";
						} else {
							echo "\n<h4><em>(no subject)</em></h4>";
						}
						echo "\n" . htmlspecialchars($questions[$i]["q_body"]);
						echo "\n<hr />";
						if ($questions[$i]["answer_time"] !== NULL) {
							echo "\n<div class=\"pull-right\">" . time_format($questions[$i]["answer_time"]) . "</div>";
							if ($questions[$i]["a_subject"] != "") {
								echo "\n<h4>" . htmlspecialchars($questions[$i]["a_subject"]) . "</h4>";
							} else {
								echo "\n<h4><em>(no subject)</em></h4>";
							}
							echo "\n" . htmlspecialchars($questions[$i]["a_body"]);
						} else {
							echo "\n<h4 class=\"text-center\"><em>No answer yet.</em></h4>";
						}
						echo "\n</div>";
					}
					echo "\n";
					?>

					<?php
					echo "\n";
					$num_messages = count($messages);
					if ($num_messages > 0) {
						echo "<h3>Messages</h3>\n";
						for ($i = 0;$i < $num_messages;$i++) {
							echo "\n<div class=\"alert alert-info\">";
							echo "\n<div class=\"pull-right\">" . time_format($messages[$i]["send_time"]) . "</div>";
							if ($messages[$i]["subject"] != "") {
								echo "\n<h4>" . htmlspecialchars($messages[$i]["subject"]) . "</h4>";
							} else {
								echo "\n<h4><em>(no subject)</em></h4>";
							}
							echo "\n" . htmlspecialchars($messages[$i]["body"]);
							echo "\n</div>";
						}
					}
					echo "\n";
					?>

				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
