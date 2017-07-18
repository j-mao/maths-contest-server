<?php

require_once __DIR__."/../../backend/conn.php";
require_once __DIR__."/../../backend/session.php";

require_not_login();
require_admin();

$has_alert = false;
$alert_subject = "";
$alert_body = "";
$alert_class = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST["ann-send"])) {
		$result_subject = $_POST["ann-subject"];
		$result_body = $_POST["ann-body"];
		if ($result_subject == '' && $result_body == '') {
			$has_alert = true;
			$alert_subject = "Your announcement should not be empty.";
			$alert_class = "danger";
		} else {
			$conn = get_conn();
			if (is_null($conn)) {
				$has_alert = true;
				$alert_subject = "An error occurred.";
				$alert_body = "A connection to the database could not be established.";
				$alert_class = "danger";
			} else {
				$result_subject = mysqli_real_escape_string($conn, stripslashes($result_subject));
				$result_body = mysqli_real_escape_string($conn, stripslashes($result_body));
				$sql = "INSERT INTO announcements (subject, body) VALUES ('$result_subject', '$result_body');";
				mysqli_query($conn, $sql);
				$conn->close();
				$has_alert = true;
				$alert_subject = "Your announcement has been sent.";
				$alert_class = "success";
			}
		}
	} else if (isset($_POST["ann-delete"])) {
		$del_id = $_POST["deleteID"];
		$conn = get_conn();
		if (is_null($conn)) {
			$has_alert = true;
			$alert_subject = "An error occurred.";
			$alert_body = "A connection to the database could not be established.";
			$alert_class = "danger";
		} else {
			$del_id = mysqli_real_escape_string($conn, stripslashes($del_id));
			$sql = "DELETE FROM announcements WHERE announcement_id=$del_id;";
			mysqli_query($conn, $sql);
			$conn->close();
			$has_alert = true;
			$alert_subject = "Your announcement has been deleted.";
			$alert_class = "success";
		}
	} else {
		$has_alert = true;
		$alert_subject = "You made an invalid request.";
		$alert_class = "danger";
	}
}

?>
