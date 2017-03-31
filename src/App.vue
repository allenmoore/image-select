<template>
	<div id="app">
		<div class="cmmis-images">
			<div class="cmmis-image" v-for="image in images" v-bind:data-cmmis-image="image.id">
				<div class="image-item">
					<input class="image-id" type="hidden" v-bind:name="field" v-bind:id="field"
						   v-bind:value="image.id"/>
					<img class="image" v-bind:src="image.src" />
					<div class="image-actions">
						<a v-bind:href="image.edit" class="cmmis-button -edit">
							<svgicon class="svg-edit" icon="edit" width="14" height="14"></svgicon>
							<span class="screen-reader-text">Edit Image</span>
						</a>
						<button class="cmmis-button -delete" aria-pressed="false" v-on:click="deleteImage( image )">
							<svgicon class="svg-delete" icon="delete" width="11" height="14"></svgicon>
							<span class="screen-reader-text">Delete Image</span>
						</button>
					</div>
				</div>
				<div class="image-caption">{{ image.name }}</div>
			</div>
		</div>
		<div class="cmmis-footer">
			<button class="button button-primary button-large" aria-pressed="false" v-on:click="openModal">
				<svgicon class="svg-plus" icon="plus" width="13" height="13"></svgicon>
				Add Image
			</button>
		</div>
	</div>
</template>

<script>
	/* global cmmisImageData */
	import './components/icons';
	import './components/icons';
	
	export default {
		/**
		 * The component name.
		 *
		 * @author Allen Moore
		 */
		name: 'app',
		
		/**
		 * Function to return the component data.
		 *
		 * @author  Allen Moore
		 * @returns {Object} an Object of component data.
		 */
		data() {
			return {
				field: `${cmmisImageData.fieldName}[]`,
				images: []
			}
		},
		
		/**
		 * The component methods.
		 *
		 * @author Allen Moore
		 */
		methods: {
			
			/**
			 * Method to get images.
			 *
			 * @author  Allen Moore
			 * @returns {void}
			 */
			getImages() {
				const images = cmmisImageData.images;
				let image;
				
				for ( let i = 0, len = images.length; i < len; i++ ) {
					image = images[i];
					this.images.push( image );
				}
			},

			/**
			 * Method to insert images into the instance.
			 *
			 * @author  Allen Moore
			 * @param   {Object} frame the wp media frame Object.
			 * @returns {void}
			 */
			insertImg( frame ) {
				const selection = frame.state().get( 'selection' ),
					length = selection.length,
					images = selection.models;
				let imgData = {},
					img,
					imgEditLink,
					imgId,
					imgTitle,
					imgUrl;

				for ( let i = 0; i < length; i++ ) {
					img = images[i];
					imgEditLink = img.changed.editLink;
					imgId = img.id;
					imgTitle = img.changed.title;
					imgUrl = img.changed.sizes.thumbnail.url;
					imgData = {
						edit: imgEditLink,
						id: imgId,
						name: imgTitle,
						src: imgUrl
					};
					this.images.push( imgData );
				}
			},

			/**
			 * Method to open the wp media modal instance.
			 *
			 * @author  Allen Moore
			 * @param   {Object} event the event Object.
			 * @returns {void}
			 */
			openModal( event ) {
				const self = this;
				let frame;

				if ( event ) {
					event.preventDefault();
				}
				frame = wp.media( {
					frame: 'post',
					title: 'Choose an Image',
					library: {
						type: 'image'
					},
					multiple: true,
					button: {
						text: 'Select Image'
					}
				} );
				frame.open();
				frame.on( 'insert', function() {
					self.insertImg( frame );
				} );
			},

			/**
			 * Method to delete an image.
			 *
			 * @author  Allen Moore
			 * @param   {Object} img the image Object to be deleted.
			 * @returns {void}
			 */
			deleteImage( img ) {
				this.images.splice( this.images.indexOf( img ), 1 );
			}
		},

		/**
		 * Function called after the instance has been mounted.
		 *
		 * @author  Allen Moore
		 * @returns {void}
		 */
		mounted() {
			this.getImages();
		}
	}
</script>