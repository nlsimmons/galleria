const fn = require('./functions.js')
require ('./upload.js')
/* Carousel */

// Sync
/*fn.listen(
	'input#images-new-album',
	'change',
	function() {
		document.querySelector('form#form-new-album').submit();
	}
)
fn.listen(
	'input#images-album',
	'change',
	function() {
		document.querySelector('form#form-album').submit();
	}
)*/

fn.addEvent(
	document.querySelector('.add-photo-btn.add-album'),
	'click',
	function() {
		document.querySelector('#modal-carousel-albums')
			.classList.add('active');
	}
)

fn.addEvent(
	document.querySelectorAll('.carousel-track'),
	'wheel',
	function(e) {
		e.preventDefault();
		let slideshow_id = fn.parent(e, '.carousel').id
		fn.scrollSlides(slideshow_id, e);
	}
)

/*fn.listen(
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
)*/
fn.listen(
	'.modal-background',
	'click',
	function(e) {
		document.querySelectorAll('.modal.active')
			.forEach(e => e.classList.remove('active'))
		document.querySelector('body')
			.classList.remove('prevent-scroll')
	}
)

fn.listen(
	'.carousel-slide .slide-title',
	'change',
	function(e, el) {

		let old_val = el.defaultValue;
		let new_val = el.value;

		if( old_val == new_val )
		{
			return;
		}

		let uri = '/'+el.id.replace(/\_/g, '/')

		fn.request('put', uri, { field: 'title', value: new_val })
			.then( e => {
				el.defaultValue = new_val;
				el.value = new_val;
			})
			.catch( err => {
				console.log(err)
			});
	}
)

