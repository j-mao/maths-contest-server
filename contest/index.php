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
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container">
			<div class="row">

				<div class="col-sm-8 col-sm-offset-2">
					<div class="jumbotron">
						<h1>Welcome</h1>
						<p>Please log in</p>
						<form action="?" method="POST" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-2" for="username">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" name="username" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="password">Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password" name="password" />
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" class="btn btn-primary" value="Login" />
									<button type="reset" class="btn btn-default">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-sm-1"></div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
