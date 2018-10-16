var i = 0;

function add_item() {
	if (i == 19) {
		alert("Can't add more than 20");
		return -1;
	}
	var what = `
	<div class="form-group row" id="itemid_${i}">
		<label for="item${i}" class="col col-form-label sr-only"> Item </label>
		<div class="col">
			<input type="text" name="item${i}" id="item${i}" class="form-control" placeholder="Item">
		</div>
		<label for="price${i}" class="col col-form-label sr-only"> Price </label>
		<div class="col">
			<input lang="en" type="number" name="price${i}" id="price${i}" class="form-control" min="0" step="0.01">
		</div>
		<div class="col">
			<p> lv. </p>
		</div>
`;
	var values = [];
	for(var j = 0; j < i; j++) {
		values[j] = [document.getElementById("item" + j).value, document.getElementById("price" + j).value];
	}
	document.getElementById("add-here").innerHTML += what;
	for(var j = 0; j < i; j++) {
		document.getElementById("item" + j).value = values[j][0];
		document.getElementById("price" + j).value = values[j][1];
	}
	i++;
	document.getElementById("i").value = i;
}