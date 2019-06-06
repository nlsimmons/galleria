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
			let path = e.path ? e.path : e.composedPath()
			for(let el of path) {
				if ( el.matches && el.matches(selector) ) {
					callback(e, el);
					return;
				}
			}

			return;
		}
	);
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

listen(
	'.display_wrapper',
	'click',
	function(e, el) {
		let modal_id = el.id.replace('display', 'modal');

		let modal = document.querySelector('#'+modal_id)
		if(modal)
			modal.classList.add('active')
		else
			return

		document.querySelector('body')
			.classList.add('prevent-scroll')

	}
)
listen(
	'.modal-background',
	'click',
	function(e) {
		document.querySelectorAll('.modal.active')
			.forEach(e => e.classList.remove('active'))
		document.querySelector('body')
			.classList.remove('prevent-scroll')
	}
)

listen(
	'.carousel-slide .slide-title',
	'change',
	function(e, el) {
		el.value
		el.id
		// change
	}
)