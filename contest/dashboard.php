<?php

require_once __DIR__."/../backend/session.php";
require_login();

require_once __DIR__."/../backend/make_dashboard.php";

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

		<div class="container-fluid">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-8">
					<div class="page-header">
						<h1>Dashboard</h1>
					</div>

					<?php make_dashboard($_SESSION["user_id"]); ?>

				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
