import './upload.js';
import './carousel.js';
import './buttons.js';

const fn = require('./functions')
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component( 'waterfall', require('./components/waterfall.vue').default );
Vue.component( 'waterfall-panel', require('./components/waterfall-panel.vue').default );
Vue.component( 'album-view', require('./components/album-view.vue').default );

if( fn.qs('#vw') ) {
	const vw = new Vue({
		el: '#vw',
	});
}

/*fn.addEvent(
	document,
	'click',
	function(e) {
		if( e.target.matches('.menu-toggle:not(.active)') )
		{
			fn.removeClass('.menu-toggle', 'active')
			e.target.classList.add('active')
		}
		else
		{
			fn.removeClass('.menu-toggle', 'active')
		}
	}
)*/
window.addEventListener('keydown', e => {
    if(e.code == 'Escape') {
    	fn.qsa('.menu-toggle').forEach( el => {
    		el.classList.remove('active')
    	})
    }
})