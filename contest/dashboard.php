<?php

require_once __DIR__."/../backend/session.php";
require_login();
require_not_admin();

require_once __DIR__."/../backend/make_dashboard.php";
require_once __DIR__."/../backend/clock_data.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contest dashboard</title>
		<?php require __DIR__."/include/header.php"; ?>
		<script src="js/access.js"></script>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid" id="everything">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-9">
					<div class="page-header">
						<h2>Dashboard</h2>
					</div>

					<?php if ($current_time < $start_time) { ?>
					<p>The problem list will appear here when the contest starts.</p>
					<?php } else {
						make_dashboard($_SESSION["user_id"]);
					}
					?>

				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
