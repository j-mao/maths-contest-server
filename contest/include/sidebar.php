
<!-- Begin generated sidebar -->

<div class="col-sm-3">
	<div class="well" style="padding: 8px 0;">
		<ul class="nav nav-list">
			<li><a href="#" <?php if ($_SERVER["REQUEST_URI"] == "/" || $_SERVER["REQUEST_URI"] == "/index.php") echo 'class="list-group-item active"'; ?>>Overview</a></li>
			<li><a href="#" <?php if ($_SERVER["REQUEST_URI"] == "/communication.php") echo 'class="list-group-item active"'; ?>>Communication <span class="label label-warning" id="num_unread"></span></a></li>
			<li><a href="#" <?php if ($_SERVER["REQUEST_URI"] == "/dashboard.php") echo 'class="list-group-item active"'; ?>>Dashboard</a></li>
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

