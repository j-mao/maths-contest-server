function upd_checkbox_encrypt() {
	var numboxes = parseInt(document.getElementById("numboxes").value);
	var newval = "";
	for (var i = 0;i < numboxes;i++) {
		if (document.getElementById("i"+i).checked) {
			newval += "1";
		} else if (newval != "") {
			newval += "0";
		}
	}
	document.getElementById("answer").value = newval;
}

function decrypt_numbers(encrypted) {
	var numboxes = parseInt(document.getElementById("numboxes").value);
	while (encrypted.length < numboxes) {
		encrypted = "0" + encrypted;
	}
	for (var i = 0;i < numboxes;i++) {
		document.getElementById("i"+i).checked = (encrypted[i] == '1');
	}
}

$(document).ready(function() {
	if (document.getElementById("numboxes") != null) {
		for (var i = 0;;i++) {
			var prev_sub = document.getElementById("submission_"+i);
			if (prev_sub == null) {
				break;
			}
			prev_sub.innerHTML = "<button class=\"btn btn-xs btn-warning\" onclick=\"decrypt_numbers(\'" + prev_sub.innerHTML + "\');\">Click to show</button>";
		}
	}
});
