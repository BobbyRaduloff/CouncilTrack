function deliver(id, event, howmuch) {
	if(confirm("Are you sure?")) {
		document.getElementById("delivery" + id).innerHTML = "Nothing owed!";
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "delete_user_balance.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("&id=" + id + "&event=" + event + "&howmuch=" + howmuch);
	}
}