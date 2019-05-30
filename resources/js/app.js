function addEvent(el, type, handler) {
	if (el.attachEvent) el.attachEvent('on'+type, handler);
	else el.addEventListener(type, handler);
}

addEvent(
	document.querySelector('input.add-photo-input'),
	'change',
	function() {
		document.querySelector('form#upload-image-no-album').submit();
})