function api_request(request) {
	var xhttp = new XMLHttpRequest();
	var result = "";
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			result = this.responseText;
		}
	};
	xhttp.open("GET", "/contest/api/"+request, false);
	xhttp.send();
	return result;
}

function api_post(request, params) {
	var xhttp = new XMLHttpRequest();
	var result = "";
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			result = this.responseText;
		}
	};
	xhttp.open("POST", "/contest/api/"+request, false);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send(params);
	return result;
}
