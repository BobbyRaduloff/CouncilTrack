var i = 0;

function add_item() {
	if (i == 9) {
		alert("Can't add more than 10");
		return -1;
	}
	var what = `
	<div class="form-group row">
		<label for="item${i}" class="col col-form-label sr-only"> Item </label>
		<div class="col">
			<input type="text" name="item${i}" class="form-control" placeholder="Item">
		</div>
		<label for="price${i}" class="col col-form-label sr-only"> Price </label>
		<div class="col">
			<input lang="en" type="number" name="price${i}" class="form-control" min="0" step="0.01">
		</div>
		<div class="col">
			<p> lv. </p>
		</div>
	</div>
`;
	document.getElementById("add-here").innerHTML += what;
	i++;
	document.getElementById("i").value = i;
}