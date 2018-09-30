function calculatePrice(what, price) {
	var p = parseInt(document.getElementById(what).value) * price;
	document.getElementById(what+"f").innerHTML = p.toFixed(2) + "lv.";
}
