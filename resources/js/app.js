function addEvent(el, type, handler) {
	if(!el) return;

	if(el instanceof NodeList)
	{
		el.forEach( e => e.addEventListener(type, handler) )
	}
	else
	{
		el.addEventListener(type, handler);
	}
}

function listen(selector, trigger, callback) {
	document.addEventListener(
		trigger,
		function (e) {
			if (!e.target.matches(selector)) return;
			callback(e);
	});
}

function context(path, selector) {
	for(let p of path) {
		if(p.matches(selector)) return p;
	}
}


/* Carousel */

listen(
	'input.add-photo-input',
	'change',
	function() {
		document.querySelector('form#upload-image-no-album').submit();
	}
)

addEvent(
	document.querySelector('.add-photo-btn.add-album'),
	'click',
	function() {
		document.querySelector('#modal-carousel-albums')
			.classList.add('active');
	}
)

addEvent(
	document.querySelectorAll('.carousel-track'),
	'wheel',
	function(e) {
		e.preventDefault();
		let slideshow_id = context(e.path, '.carousel').id;
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

/* Waterfall */
// Toggle active state
listen(
	'.waterfall img.display_img',
	'click',
	function(e) {

		let display = e.target;
		let full_id = display.id.replace('display', 'container');

		// alert(full_id)

		document.querySelector('#'+full_id)
			.classList.add('active')

		/*if( e.target.classList.contains('active') )
			e.target.classList.remove('active')
		else
			e.target.classList.add('active')*/
	}
)
// Remove active state
listen(
	'.waterfall .active, .waterfall .active *',
	'click',
	function(e) {
		document.querySelector('.active')
			.classList.remove('active');
	}
)
