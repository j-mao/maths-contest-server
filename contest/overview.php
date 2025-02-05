<?php

require_once __DIR__."/../backend/session.php";
require_login();
require_not_admin();
require_once __DIR__."/../backend/clock_data.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contest overview</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container-fluid" id="everything">
			<div class="row">
				<?php require __DIR__."/include/sidebar.php"; ?>

				<div class="col-sm-9">
					<div class="page-header">
						<h2>Overview</h2>
					</div>
					<?php
						$file = fopen(__DIR__."/include/overview.html", "r");
						echo fread($file, filesize(__DIR__."/include/overview.html"));
						fclose($file);
					?>
				</div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
