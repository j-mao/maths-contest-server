
<!-- Begin generated information bar -->
<?php

require "../../backend/conn.php";

$conn = get_conn();
$contest_title = "";
if (is_null($conn)) {
} else {
	$sql = "SELECT data_varchar FROM contest WHERE variable='contest_name';";
	if ($result = mysqli_query($conn, $sql) {
		if (mysqli_num_rows($result) == 1) {
			$contest_title = $result["data_varchar"];
		}
		mysqli_free_result($result);
	} else {
	}
	$conn->close();
}

?>

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<span class="navbar-brand">
				<?php echo $contest_title; ?>
			</span>
		</div>
<?php if ($logged_in) { ?>
		<ul class="nav navbar-nav navbar-right">
			<li class="navbar-text">
				Logged in as <b><?php echo $_SESSION["nickname"]; ?></b> (<?php echo $_SESSION["username"]; ?>)
			</li>
			<li>
				<button class="btn btn-warning btn-sm navbar-btn" onclick="window.location='/contest/logout.php';">Logout</button>
			</li>
		</ul>
<?php } ?>

	</div>
</nav>

<!-- End generated information bar -->

