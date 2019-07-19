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

Vue.component( 'Waterfall', require('./components/Waterfall.vue').default );

if( fn.qs('#welcome') )
{
	const waterfall = new Vue({
		el: '#welcome',
	});
}
if( fn.qs('#user-home') )
{
	const waterfall = new Vue({
		el: '#user-home',
	});
}


