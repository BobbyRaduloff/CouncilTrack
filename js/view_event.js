function search() {
	var query = document.getElementById("query").value;
	var data = document.getElementById("data");
	for(var i = 1; i < data.rows.length - 1; i++) {
		var yes = false;
		for(var j = 1; j <= 4; j++) {
			if(j == 2) {
				continue;
			}
			if(data.rows[i].cells[j].innerText.toLowerCase().includes(query.toLowerCase())) {
				yes = true;
			}
		}
		if(yes) {
			data.rows[i].style.display = "";
		} else {
			data.rows[i].style.display = "none";
		}
	}
}

document.getElementById('query').addEventListener('keydown', function(k){
    if(k.keyCode == 13) return false;
});