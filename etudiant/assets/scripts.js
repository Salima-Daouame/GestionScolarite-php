function triggerClick() {
	document.querySelector('#Avatar').click();
}
function displayImage(e){
	if (e.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) {
			document.querySelector('#profileDisplay').setAttribute('src' , e.traget.result);

		}
		reader.readAsDataURL(e.files[0]);
	}
}