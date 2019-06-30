import * as fn from './functions.js'
/* Carousel */

// Sync
fn.listen(
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
)

// Async
/*fn.listen(
	'input#images-new-album',
	'change',
	function() {
		document.querySelector("#images-new-album-modal").classList.add('is-active')
		let files = document.querySelector("input#images-new-album").files
		const image_display = document.querySelector("#images-uploading")

		for(let file of files)
		{
			let fr = new FileReader();

			fr.onload = function(e) {
				console.log(e)
				let src = e.target.result
				let html = `<div>
					<img class="img-preview" src="${src}">
				</div>`
				image_display.innerHTML += html
		    }

	    	fr.readAsDataURL(file);
		}
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
		let path = e.path ? e.path : e.composedPath()
		let slideshow_id = fn.context(path, '.carousel').id;
		fn.scrollSlides(slideshow_id, e);
	}
)

fn.listen(
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
		console.log(uri)

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

