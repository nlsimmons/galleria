export function qs(selector) {
	return document.querySelector(selector)
}
export function qsa(selector) {
	return document.querySelectorAll(selector)
}

export function toggle(selector) {
	qsa(selector).forEach( el => {
		if( el.classList.contains('active') )
		{
			el.classList.remove('active')
			el.classList.add('inactive')
		}
		else if( el.classList.contains('inactive') )
		{
			el.classList.remove('inactive')
			el.classList.add('active')
		}
	})
}

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
	return qs('meta[name=csrf-token]').content;
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

export function notify(type, message) {
	let note_window = qs('.notification-container')

	if( type == 'success' )
	{
		note_window.innerHTML = `<div class="notification is-success fadeout">
			${message}
		</div>`
	}
	if( type == 'error' ) {
		note_window.innerHTML = `<div class="notification is-danger fadeout">
			${message}
		</div>`
	}
}