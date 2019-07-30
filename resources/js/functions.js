export function qs(selector) {
	return document.querySelector(selector)
}
export function qsa(selector) {
	return document.querySelectorAll(selector)
}

export function addClass(selector, className) {
	qsa(selector).forEach( el => {
		el.classList.add(className)
	})
}
export function removeClass(selector, className) {
	qsa(selector).forEach( el => {
		el.classList.remove(className)
	})
}

export function toggleElement(element, className="active") {
	if( element.classList.contains(className) )
	{
		element.classList.remove(className)
	}
	else
	{
		element.classList.add(className)
	}
}
export function toggleSelector(selector, className="active") {
	qsa(selector).forEach( el => {
		toggleElement(el, selector)
	})
}

export function addEvent(el, trigger, handler) {
	if(!el) return;

	if(el instanceof NodeList)
	{
		el.forEach( e => e.addEventListener(trigger, handler) )
	}
	else
	{
		el.addEventListener(trigger, handler);
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

export function request(method, url, data={}) {
	return new Promise((resolve, reject) => {
	    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	    switch(method = method.toUpperCase())
	    {
	    	case 'PUT':
	    		method = 'POST'
	    		data['_method'] = 'PUT'
	    		break
	    	case 'GET':
	    		for(let p in data)
	    		{
	    			url += url.indexOf('?') === -1 ? '?' : '&'
	    			url += `${p}=${data[p]}`
	    		}
	    }

	    xhr.open(method, url);
	    xhr.onload = () => {
	        if (xhr.status >= 200 && xhr.status < 300)
	        	resolve(xhr);
	    	else
	    		reject(xhr);
	    }
	    xhr.setRequestHeader('X-CSRF-TOKEN', get_csrf());
	    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    	let form = new FormData();
    	data['_api'] = true

		for(let d in data)
		{
			form.append(d, data[d]);
		}

		xhr.send(form);
	});
}

export function notify(type, message) {

	let note
	if( type == 'success' )
		note = qs('.notification.is-success')
	if( type == 'error' )
		note = qs('.notification.is-danger')

	note.classList.add('fadeout')
	note.innerText = message
}
listen(
	'.notification',
	'animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd',
	function(e) {
		e.target.classList.remove('fadeout')
		e.target.innerText = ''
	}
)