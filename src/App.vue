<template>
	<div id="app">
		<div class="cmmis-images">
			<div class="cmmis-image" v-for="image in images" v-bind:data-cmmis-image="image.id">
				<div class="image-item">
					<input class="image-id" type="hidden" name="cmm-image-upload" v-bind:id="image.id"
						   v-bind:value="image.id"/>
					<img class="image" v-bind:src="image.src" />
					<div class="image-actions">
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
	import './components/icons';
	import './components/icons';
	
	export default {
		name: 'app',
		data() {
			return {
				images: []
			}
		},
		methods: {
			selectImg( frame ) {
				const attachment = frame.state().get( 'selection' ).first(),
					sizes = attachment.get( 'sizes' );
				let imageUrl = attachment.get( 'url' );

				imageUrl = sizes.thumbnail.url;
				this.images.push( {
					id: attachment.id,
					name: attachment.name,
					src: imageUrl
				} );
			},
			openModal( event ) {
				const self = this;
				let frame;

				if ( event ) {
					event.preventDefault();
				}
				frame = wp.media.frames.chooseImage = wp.media( {
					title: 'Choose an Image',
					library: {
						type: 'image'
					},
					button: {
						text: 'Select Image'
					}
				} );
				frame.open();
				frame.on( 'select', function() {
					self.selectImg( frame );
				} );
			},
			deleteImage( img ) {
				this.images.splice( this.images.indexOf( img ), 1 );
			}
		}
	}
</script>