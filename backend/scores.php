<?php

function calc_score($solved, $num_submissions, $value, $decrement, $minscore) {
	if ($solved > 0) {
		$num_submissions -= 1;
		$score = $value - $decrement * $num_submissions;
		if ($score < $minscore) $score = $minscore;
		return $score;
	} else {
		return 0;
	}
}

?>
