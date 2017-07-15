
var INTERVAL_MILLIS = 5000;
var alert_poll = null;

var num_new = 0;

function createAlert(subject, body, context) {
	var str = '<div class="alert alert-'+context+' alert-dismissable">\n';
	str += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\n';
	str += '<h4>'+subject+'</h4>\n';
	str += body+'\n';
	str += '</div>\n\n';
	str += document.getElementById("alerts").innerHTML;
	document.getElementById("alerts").innerHTML = str;
}

function get_questions() {
	return api_request("questions.php");
}

function getAlerts() {
	var cur_questions = get_questions();
	while (num_questions < cur_questions) {
		createAlert("New question", "", "warning");
		num_questions++;
		num_new++;
	}
	if (num_new != 0) {
		document.getElementById("num_questions").innerHTML = num_new;
	}
}

$(document).ready(function() {
	num_questions = get_questions();
	alert_poll = window.setInterval(getAlerts, INTERVAL_MILLIS);
});

