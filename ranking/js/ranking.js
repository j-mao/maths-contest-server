
var INTERVAL_MILLIS = 5000;
var refresh_poll = null;
var cur_state = {};

function get_ranklist() {
	return api_request('ranklist.php');
}

function getTier(scored, available) {
	return Math.floor(scored*8/available);
}

function updateRanking() {
	new_state = get_ranklist();
	var str = '';
	var idx = 1, rank = 1, prev_score = -1000;
	for (user in new_state) {
		var changed = false;
		if (!(user['nickname'] in cur_state)) {
			cur_state[user['nickname']] = user['total'];
		} else if (cur_state[user['nickname']] != user['total']) {
			cur_state[user['nickname']] = user['total'];
			changed = true;
		}
		if (user['total'] != prev_score) {
			rank = idx;
			prev_score = user['total'];
		}
		str += '<tr>';
		if (changed) {
			str += '<td class="changed">'+rank+'</td>';
		} else {
			str += '<td>'+rank+'</td>';
		}
		str += '<td>'+user['nickname']+'</td>';
		str += '<td class="tier'+getTier(user['total'], total_points)+'">'+user['total']+'</td>';
		for (var i = 0;i < user['scores'].length;i++) {
			str += '<td class="tier'+getTier(user['scores'][i], problem_values[i])+'">'+user['scores'][i]+'</td>';
		}
		str += '</tr>';
		idx++;
	}
	document.getElementById('ranklist').innerHTML = str;
}

$(document).ready(function() {
	updateRanking();
	alert_poll = window.setInterval(updateRanking, INTERVAL_MILLIS);
});

