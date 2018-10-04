function search() {
	var query = document.getElementById("query").value;
	var data = document.getElementById("data");
	for(var i = 1; i < data.rows.length - 1; i++) {
		if(data.rows[i].cells[1].innerText.toLowerCase().includes(query.toLowerCase()) || data.rows[i].cells[3].innerText.toLowerCase().includes(query.toLowerCase())) {
			data.rows[i].style.display = "";
		} else {
			data.rows[i].style.display = "none";
		}
	}
}