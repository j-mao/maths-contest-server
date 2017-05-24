<?php

require "../backend/session.php";
require_login();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contest overview</title>
		<?php require "include/header.html"; ?>
	</head>
	<body>

		<?php require "include/topbar.php"; ?>

		<div class="container-fluid">
			<div class="row">
				<?php require "include/sidebar.php"; ?>

				<div class="col-sm-8">
					<div class="page-header">
						<h1>Overview</h1>
					</div>
					Insert welcome message here.
				</div>

				<?php require "include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
