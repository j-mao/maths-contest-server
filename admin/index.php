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
		<div class="row">
		</div>
	</body>
</html>
