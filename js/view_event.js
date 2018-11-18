function deliver(id, event) {
	if(confirm("Are you sure?")) {
		document.getElementById("delivery" + id).innerHTML = "Yes";
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "deliver.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("event=" + event + "&id=" + id);
	}
}