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
	if (isset($_POST["deleteID"])) {
		$conn = get_conn();
		if (is_null($conn)) {
			$has_alert = true;
			$alert_subject = "An error occurred.";
			$alert_body = "A connection to the database could not be established.";
			$alert_class = "danger";
		} else {
			$deleteID = mysqli_real_escape_string($conn, stripslashes($_POST["deleteID"]));
			$sql = "DELETE FROM submissions WHERE submission_id=$deleteID;";
			mysqli_query($conn, $sql);
			$conn->close();
			$has_alert = true;
			$alert_subject = "The submission has been deleted.";
			$alert_class = "success";
		}
	} else {
		$has_alert = true;
		$alert_subject = "You made an invalid request.";
		$alert_class = "danger";
	}
}

?>
