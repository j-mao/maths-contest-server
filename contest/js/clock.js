var clock_poll = null;
var start_time = 0, end_time = 0, time_offset = 0;

function timeIntervalDisplay(value) {
	value = Math.floor(value/1000);
	var SS = value%60; value = Math.floor(value/60);
	var MM = value%60; value = Math.floor(value/60);
	var HH = value;
	var res = HH + ':';
	if (MM < 10) {
		res += '0';
	}
	res += MM + ':';
	if (SS < 10) {
		res += '0';
	}
	res += SS;
	return res;
}

function currentTime() {
	return new Date().valueOf();
}

function updateClock() {
	var displayTime = currentTime()+time_offset;
	var str = 'Server time: '+new Date(displayTime).toLocaleTimeString()+'<br />';
	if (displayTime < start_time) {
		str += 'Until start: '+timeIntervalDisplay(start_time-displayTime);
	} else if (displayTime < end_time) {
		str += 'Until end: '+timeIntervalDisplay(end_time-displayTime);
	}
	document.getElementById("clock").innerHTML = str;
}

$(document).ready(function() {
	var result = api_request("clock.php").split(" ");
	start_time = parseInt(result[0]);
	end_time = parseInt(result[1]);
	time_offset = parseInt(result[2]) - currentTime();
	updateClock();
	clock_poll = window.setInterval(updateClock, 1000);
});

