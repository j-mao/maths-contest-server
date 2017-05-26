
var INTERVAL_MILLIS = 5000;
var alert_poll = null;

var num_new = 0;
var num_announcements = 0;
var num_questions = 0;
var num_messages = 0;

function createAlert(subject, body, context) {
	var str = '<div class="alert alert-'+context+' alert-dismissable">\n';
	str += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\n';
	str += '<h4>'+subject+'</h4>\n';
	str += body+'\n';
	str += '</div>\n\n';
	str += document.getElementById("alerts").innerHTML;
	document.getElementById("alerts").innerHTML = str;
}

function get_announcements() {
	return api_request("announcements.php");
}

function get_questions() {
	return api_request("questions.php");
}

function get_messages() {
	return api_request("messages.php");
}

function getAlerts() {
	var cur_announcements = get_announcements();
	var cur_questions = get_questions();
	var cur_messages = get_messages();
	while (num_announcements < cur_announcements) {
		createAlert("New announcement", "", "warning");
		num_announcements++;
		num_new++;
	}
	while (num_questions < cur_questions) {
		createAlert("New answer", "", "warning");
		num_questions++;
		num_new++;
	}
	while (num_messages < cur_messages) {
		createAlert("New message", "", "warning");
		num_messages++;
		num_new++;
	}
	if (num_new != 0) {
		document.getElementById("num_unread").innerHTML = num_new+" unread";
	}
}

window.onload = function() {
	num_announcements = get_announcements();
	num_questions = get_questions();
	num_messages = get_messages();
	alert_poll = window.setInterval(getAlerts, INTERVAL_MILLIS);
}

