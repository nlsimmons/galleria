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

addEvent(
	document.querySelector('.carousel'),
	'wheel',
	function(e) {
		let slideshow_id = this.id;
		scrollSlides(slideshow_id, e);
	}
)

var time = Date.now();
function scrollSlides(slideshow_id, e) {
	var wait = 500;
	if((time + wait - Date.now()) > 0)
		return;
	time = Date.now();

	let radios = document.querySelectorAll(`#${slideshow_id} input[type=radio]`);

	// left
	if( e.deltaX > 0 || e.deltaY < 0  )
	{
		// previous
		for(i=0; i<radios.length; i++)
		{
			let el = radios[i]

			if(el.checked)
			{
				el.checked = false;

				if(radios[i-1])
				{
					radios[i-1].checked = true;
				}
				else
				{
					radios[radios.length-1].checked = true;
				}

				return;
			}
		}
	}
	// right
	else if( e.deltaX < 0 || e.deltaY > 0 )
	{
		// next
		for(i=0; i<radios.length; i++)
		{
			let el = radios[i]

			if(el.checked)
			{
				el.checked = false;

				if(radios[i+1])
				{
					radios[i+1].checked = true;
				}
				else
				{
					radios[0].checked = true;
				}

				return;
			}
		}
	}
}