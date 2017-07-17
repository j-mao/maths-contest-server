<?php

require_once(__DIR__."/../../backend/clock_data.php");

if ($current_time < $start_time) {
	echo "<script>window.setTimeout(function(){window.location = '/contest/dashboard.php';}, " . ($start_time-$current_time+100) . ");</script>";
} else if ($current_time < $end_time) {
	echo "<script>window.setTimeout(function(){window.location = '/contest/dashboard.php';}, " . ($end_time-$current_time-100) . ");</script>";
}

?>
