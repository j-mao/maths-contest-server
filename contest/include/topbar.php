
<!-- Begin generated information bar -->
<?php

require_once __DIR__."/../../backend/conn.php";

$conn = get_conn();
$contest_title = "";
if (is_null($conn)) {
} else {
	$sql = "SELECT data_varchar FROM contest WHERE variable='contest_name';";
	if ($result = mysqli_query($conn, $sql) {
		if (mysqli_num_rows($result) == 1)) {
			$row = mysqli_fetch_assoc($result);
			$contest_title = $row["data_varchar"];
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
			<a class="navbar-brand" href="/contest/">
				<?php echo $contest_title; ?>
			</a>
		</div>
<?php if ($logged_in) { ?>
		<form action="/contest/logout.php" method="GET" class="navbar-form pull-right">
			<button type="submit" class="btn btn-warning">Logout</button>
		</form>
		<p class="navbar-text pull-right">
			Logged in as <b><?php echo $_SESSION["nickname"]; ?></b> (<?php echo $_SESSION["username"]; ?>)
		</p>
<?php } ?>

	</div>
</nav>

<!-- End generated information bar -->

