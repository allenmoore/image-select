import Vue from 'vue';
import svgicon from 'vue-svgicon';
import App from './App.vue';

/**
 * Method to install the SVGIcon plugin.
 *
 * @author  Allen Moore
 * @returns {void}
 */
Vue.use( svgicon, {tagName: 'svgicon'} );

/**
 * Instantiate the Vue instance.
 *
 * @author  Allen Moore
 * @returns {void}
 */
new Vue( {
	el: '#app',
	render: h => h( App )
} );
