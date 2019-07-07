export function addEvent(el, type, handler) {
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

export function listen(selector, trigger, callback, bubble_down = false) {
	if(selector.split(' ')[0] == 'document')
	{
		let sel_arr = selector.split(' ')
		sel_arr.shift()
		selector = sel_arr.join(' ')
	}

	selector = bubble_down ? `${selector}, ${selector} *` : selector
	for ( let t of trigger.split(' ') )
	{
		document.addEventListener(
			t,
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
}

export function parent(event, selector) {
	let path = event.path ? event.path : event.composedPath()
	for(let p of path) {
		if(p.matches(selector)) return p;
	}
}

function get_csrf() {
	return document.querySelector('meta[name=csrf-token]').content;
}

export function request(method, url, data) {
	return new Promise((resolve, reject) => {
	    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    switch(method = method.toUpperCase())
	    {
	    	case 'PUT':
	    		method = 'POST';
	    		data['_method'] = 'PUT';
	    }

	    xhr.open(method , url);
	    xhr.onload = () => {
	        if (xhr.status >= 200 && xhr.status < 300)
	        	resolve(xhr.response);
	    	else
	    		reject(xhr.status + ' ' + xhr.statusText);
	    }
	    xhr.setRequestHeader('X-CSRF-TOKEN', get_csrf());
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

	    if(data) {
	    	let form = new FormData();

    		for(let d in data)
    		{
    			form.append(d, data[d]);
    		}

    		xhr.send(form);
	    } else {
	    	xhr.send();
	    }
	});
}

var time = Date.now();
export function scrollSlides(slideshow_id, e) {
	var wait = 500;
	if((time + wait - Date.now()) > 0)
		return;
	time = Date.now();

	let radios = document.querySelectorAll(`#${slideshow_id} input[type=radio]`);

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