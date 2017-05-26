
var INTERVAL_MILLIS = 5000;
var LEADERBOARD_SIZE = 5;
var leaderboard_poll = null;

function makeLeaderboard() {
	var leaderboard = JSON.parse(api_request("leaderboard.php"));
	var str = "", place = 1, displayed = 0;
	for (var i = 0;i < leaderboard.length;i++) {
		if (i > 0 && leaderboard[i].score != leaderboard[i-1].score) {
			place = i + 1;
		}
		if (displayed < LEADERBOARD_SIZE || leaderboard[i].me) {
			if (leaderboard[i].me) {
				str += "<li class=\"list-group-item list-group-item-info\">";
			} else {
				str += "<li class=\"list-group-item\">";
			}
			str += place+". ";
			str += leaderboard[i].username;
			str += "<span class=\"pull-right\">";
			if (leaderboard[i].score == 1) {
				str += leaderboard[i].score+" pt";
			} else {
				str += leaderboard[i].score+" pts";
			}
			str += "</span></li>\n";
			displayed++;
		}
	}
	document.getElementById("leaderboard").innerHTML = str;
}

window.onload = function() {
	makeLeaderboard();
	leaderboard_poll = window.setInterval(makeLeaderboard, INTERVAL_MILLIS);
}

