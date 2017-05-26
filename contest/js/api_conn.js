function api_request(request) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			return parseInt(this.responseText);
		}
	};
	xhttp.open("GET", "/contest/api/"+request, true);
	xhttp.send();
}

function api_post(request, params) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			return parseInt(this.responseText);
		}
	};
	xhttp.open("POST", "/contest/api/"+request, true);
	xhttp.send(params);
}
