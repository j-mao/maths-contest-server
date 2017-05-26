<?php

require_once __DIR__."/../backend/session.php";
require_login();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contest overview</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-8">
					<div class="page-header">
						<h1>Overview</h1>
					</div>
					Insert welcome message here.
				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
