const fn = require('./functions.js')

fn.addEvent(
	fn.qs('.add-photo-btn.add-album'),
	'click',
	function() {
		fn.qs('#modal-carousel-albums')
			.classList.add('active');
	}
)

fn.addEvent(
	fn.qsa('.carousel-track'),
	'wheel',
	function(e) {
		e.preventDefault();
		let slideshow_id = fn.parent(e, '.carousel').id
		scrollSlides(slideshow_id, e);
	}
)



/*fn.listen(
	'.display_wrapper',
	'click',
	function(e, el) {
		let modal_id = el.id.replace('display', 'modal');

		let modal = fn.qs('#'+modal_id)
		if(modal)
			modal.classList.add('active')
		else
			return

		fn.qs('body')
			.classList.add('prevent-scroll')

	}
)*/
fn.listen(
	'.modal-background',
	'click',
	function(e) {
		fn.qsa('.modal.active')
			.forEach(e => e.classList.remove('active'))
		fn.qs('body')
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

var time = Date.now();
function scrollSlides(slideshow_id, e) {
	var wait = 500;
	if((time + wait - Date.now()) > 0)
		return;
	time = Date.now();

	let radios = fn.qsa(`#${slideshow_id} input[type=radio]`);

	// left
	if( e.deltaX > 0 || e.deltaY < 0  )
	{
		// previous
		for(let i=0; i<radios.length; i++)
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
		for(let i=0; i<radios.length; i++)
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