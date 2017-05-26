
<!-- Begin generated sidebar -->

<div class="col-sm-3">
	<div class="well side-nav">
		<ul class="nav nav-list">
			<li><a href="#" <?php if ($_SERVER["REQUEST_URI"] == "/" || $_SERVER["REQUEST_URI"] == "/index.php") echo 'class="active"'; ?>>Overview</a></li>
			<li><a href="#" <?php if ($_SERVER["REQUEST_URI"] == "/communication.php") echo 'class="active"'; ?>>Communication <span class="label label-warning" id="num_unread"></span></a></li>
			<li><a href="#" <?php if ($_SERVER["REQUEST_URI"] == "/dashboard.php") echo 'class="active"'; ?>>Dashboard</a></li>
		</ul>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Leaderboard
		</div>
		<ul class="list-group" id="leaderboard">
		</ul>
	</div>
</div>

<!-- End generated sidebar -->

