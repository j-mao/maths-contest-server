<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_not_admin();
require_once __DIR__."/action/login.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body class="contains-scroll">
		<div class="hidden-xs contains-scroll">
			<div class="row contains-scroll">
				<?php require __DIR__."/include/sidebar.html"; ?>
				<div class="col-sm-9 contains-scroll scrollable">
					<div class="container-fluid">
						<?php require __DIR__."/include/alerts.php"; ?>
						<div class="page-header">
							<h2>Please log in.</h2>
						</div>
						<form action="?" method="POST">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" />
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" />
							</div>
							<input type="submit" class="btn btn-default" value="Log in" />
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php require __DIR__."/include/screen_xs.html"; ?>
	</body>
</html>
