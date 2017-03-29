import Vue from 'vue';

/**
 * NewImage class.
 *
 * @author  Allen Moore, 10up
 * @returns {void}
 */
class NewImage extends Vue {

	/**
	 * Constructor Method.
	 *
	 * @author  Allen Moore, 10up
	 * @returns {void}
	 */
	constructor() {
		Vue.component( 'image-list', {
			template: `
				<div class="cmm-images">
					<ul class="image-list">
						<li v-for="image in images" class="image-item">
							{{ image.name }}
						</li>
					</ul>
				</div>
			`
		} );
		super( {el: '#root'} );
	}
}

new NewImage(); // eslint-disable-line no-new
