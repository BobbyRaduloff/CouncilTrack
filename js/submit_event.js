var data = new Map();

function calculatePrice(what, price) {
	var p = parseInt(document.getElementById(what).value) * price;
	data.set(what, p);
	document.getElementById(what+"f").innerHTML = p.toFixed(2) + "lv.";
	var it = data.values();
	var res = it.next();
	var sum = 0;
	while(!res.done) {
		sum += res.value;
		res = it.next();
	}
	document.getElementById("total").innerHTML = sum.toFixed(2) + "lv.";
}

function toggleGrade() {
	g = document.getElementById("b_grade");
	if(g.style.display != "none") {
		g.style.display = "none";
	} else {
		g.style.display = "flex";
	}
}

function toggleGradeR() {
	g = document.getElementById("re_grade");
	if(g.style.display != "none") {
		g.style.display = "none";
	} else {
		g.style.display = "flex";
	}
}