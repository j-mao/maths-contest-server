<?php

require_once __DIR__."/../backend/session.php";
require_not_login();
require_not_admin();
require_once __DIR__."/action/register.php";

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<?php require __DIR__."/include/header.php"; ?>
	</head>
	<body>

		<?php require __DIR__."/include/topbar.php"; ?>

		<div class="container" id="everything">
			<div class="row">

				<div class="col-sm-8 col-sm-offset-2">
					<div class="jumbotron">
						<h1>Register</h1>
						<p>Please provide some details below to register an account.</p>
						<form action="?" method="POST" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-2" for="nickname">Nickname</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nickname" name="nickname" />
								</div>
							</div>
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
								<label class="control-label col-sm-2" for="password2">Confirm password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password2" name="password2" />
								</div>
							</div>
							<div class="form-group"> 
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" class="btn btn-primary" value="Register" />
									<button type="reset" class="btn btn-default">Reset</button>
									<div class="pull-right">
										<a class="btn btn-warning" href="/contest/">Go back</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="col-sm-2"></div>

				<?php require __DIR__."/include/alerts.php"; ?>
			</div>
		</div>

	</body>
</html>
