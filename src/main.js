import Vue from 'vue';
import svgicon from 'vue-svgicon';
import App from './App.vue';

Vue.use( svgicon, {
	tagName: 'svgicon'
} );

new Vue( {
	el: '#app',
	render: h => h( App )
} );
