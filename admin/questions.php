<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_admin();
require_once __DIR__."/../backend/timestamper.php";
require_once __DIR__."/action/question_send.php";
require_once __DIR__."/../backend/all_questions.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Questions</title>
		<?php require __DIR__."/include/header.php"; ?>

		<script>
		<?php
		$varnames = ['author_nicknames', 'author_usernames', 'question_times', 'question_subjects', 'question_bodies', 'question_response_subject', 'question_response_body', 'question_ids'];
		$sqlkeys = ['nickname', 'username', 'receive_time', 'q_subject', 'q_body', 'a_subject', 'a_body', 'question_id'];
		$numtodo = 8;
		for ($i = 0;$i < $numtodo;$i++) {
			echo "var " . $varnames[$i] . " = [];";
			foreach ($questions as $question) {
				echo $varnames[$i] . '.push(' . json_encode($question[$sqlkeys[$i]]) . ');';
			}
			echo "\n";
		}
		?>
		function answerQ(q_id) {
			document.getElementById("author-nickname").innerHTML = author_nicknames[q_id];
			document.getElementById("author-username").innerHTML = author_usernames[q_id];
			document.getElementById("question-time").innerHTML = question_times[q_id];
			document.getElementById("question-subject").innerHTML = question_subjects[q_id];
			document.getElementById("question-body").innerHTML = question_bodies[q_id];

			document.getElementById("question-response").value = '';
			if (question_response_subject[q_id] == 'Yes') {
				document.getElementById("question-responsetype").value = 'yes';
			} else if (question_response_subject[q_id] == 'No') {
				document.getElementById("question-responsetype").value = 'no';
			} else if (question_response_subject[q_id] == 'No comment') {
				document.getElementById("question-responsetype").value = 'no_comment';
			} else if (question_response_subject[q_id] == 'Invalid question') {
				document.getElementById("question-responsetype").value = 'invalid';
			} else if (question_response_subject[q_id] == 'Answered in task description') {
				document.getElementById("question-responsetype").value = 'answered';
			} else {
				document.getElementById("question-responsetype").value = 'custom';
				document.getElementById("question-response").value = question_response_body[q_id];
			}
			document.getElementById("question-id").value = parseInt(question_ids[q_id]);
			$("#response-modal").modal();
		}
		</script>

	</head>
	<body class="contains-scroll">
		<div class="hidden-xs contains-scroll">
			<div class="row contains-scroll">
				<?php require __DIR__."/include/sidebar.html"; ?>
				<div class="col-sm-9 contains-scroll scrollable">
					<div class="container-fluid">
						<?php require __DIR__."/include/alerts.php"; ?>
						<div class="page-header">
							<h2>Questions</h2>
						</div>
						<div class="panel-group">
							<?php
								$id = 0;
								foreach ($questions as $question) {
									if ($question["answer_time"] === NULL) {
										echo '<div class="panel panel-primary">';
									} else {
										echo '<div class="panel panel-default">';
									}
									echo '<div class="panel-heading">';
									echo 'Question from <strong>' . htmlspecialchars($question["nickname"]) . '</strong>';
									echo ' (username: <em>' . htmlspecialchars($question["username"]) . '</em>)';
									echo '</div>';
									echo '<div class="panel-body">';
									echo '<span class="pull-right">' . time_format($question["receive_time"]) . '</span>';
									if ($question["q_subject"] != "") {
										echo '<h4>' . htmlspecialchars($question["q_subject"]) . '</h4>';
									} else {
										echo '<h4><em>(no subject)</em></h4>';
									}
									echo '<p>' . htmlspecialchars($question["q_body"]) . '</p>';
									echo '<hr />';
									if ($question["answer_time"] === NULL) {
										echo '<p>Click <a href="#" onclick="answerQ(' . $id . ');">here</a> to answer this question.</p>';
									} else {
										echo '<span class="pull-right">' . time_format($question["answer_time"]) . '</span>';
										if ($question["a_subject"] != "") {
											echo '<h4>' . htmlspecialchars($question["a_subject"]) . '</h4>';
										} else {
											echo '<h4><em>(no subject)</em></h4>';
										}
										echo '<p>' . htmlspecialchars($question["a_body"]) . '</p>';
										echo '<p>Click <a href="#" onclick="answerQ(' . $id . ');">here</a> to change your answer.</p>';
									}
									echo '</div>';
									echo '</div>';
									$id++;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php require __DIR__."/include/screen_xs.html"; ?>

		<div class="modal fade" id="response-modal" role="dialog">
			<div class="modal-dialog">
				<form action="?" method="POST" class="modal-content">
					<div class="modal-header">
						<button class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Answer a question</h4>
					</div>
					<div class="modal-body">
						<p>
							This question was sent by <strong><span id="author-nickname"></span></strong>
							(username: <em><span id="author-username"></span></em>).
						</p>
						<p>
							It was received at <span id="question-time"></span>.
						</p>
						<hr />
						<h4 id="question-subject"></h4>
						<p id="question-body"></p>
						<hr />
						<p>
							Select a precompiled response or provide a custom response:
							<select id="question-responsetype" name="question-responsetype">
								<option value="yes">Yes</option>
								<option value="no">No</option>
								<option value="no_comment">No comment</option>
								<option value="invalid">Invalid question</option>
								<option value="answered">Answered in task description</option>
								<option value="custom">Custom response</option>
							</select>
						</p>
						<textarea rows=8 class="form-control" id="question-response" name="question-response" maxlength=255></textarea>
						<input type="hidden" id="question-id" name="question-id" value="-1" />
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="submit" class="btn btn-success" value="Send" name="response-send" maxlength=32 />
					</div>
				</form>
			</div>
		</div>

	</body>
</html>
