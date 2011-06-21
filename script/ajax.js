function load(filename) {

	http = new XMLHttpRequest();
	http.onreadystatechange = function () {
		if (http.readyState == 4) handleResponse(http.responseText);
		};
	http.open('GET',filename,true);
	http.send(null);
}

function handleResponse(responseText) {

	document.getElementById('content').innerHTML = responseText;
}

function showSolution() {
	document.getElementById('solution').style.visibility = "visible";
}
