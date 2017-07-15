<?php

function same_day($t1, $t2) {
	return (date("j M Y", $t1) == date("j M Y", $t2));
}

function time_format($sql_time) {
	$php_time = strtotime($sql_time);
	if (same_day($php_time, time())) {
		$result = date('H:i:s', $php_time);
	} else {
		$result = date('j M Y \a\t H:i:s', $php_time);
	}
	return $result;
}

?>
