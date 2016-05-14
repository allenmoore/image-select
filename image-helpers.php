<?php

namespace Cmmarslender\ImageSelect;

function render_image_select( $args ) {
	$defaults = array(
		'label' => 'Upload an Image', // Label for the upload
		'name' => 'cmm-image-upload', // the HTML input name attribute
		'image_id' => 0, // The ID of the image currently selected for this uploader
	);

	$args = wp_parse_args( $args, $defaults );

	$image_src = wp_get_attachment_image_src( $args['image_id'], 'thumbnail' );
	$image_src = is_array( $image_src ) ? reset( $image_src ): '';

	if ( empty( $image_src ) ) {
		// @TODO THEME SPECIFIC - Specify URL to fallback here
		$image_src = 'http://placehold.it/150&text=No+Image';
	}

	?>
	<div class="image-select-parent">
		<label for="<?php echo esc_attr( $args['name'] ); ?>"><?php echo esc_html( $args['label'] ); ?></label>
		<input class="image-id-input" type="hidden" name="<?php echo esc_attr( $args['name'] ); ?>" id="<?php echo esc_attr( $args['name'] ); ?>" value="<?php echo intval( $args['image_id'] ); ?>"/>
		<div>
			<img src="<?php echo esc_url( $image_src ); ?>"/>
		</div>
		<div>
			<div class="button select-image">Select Image</div>
			<div class="button remove-image">Remove Image</div>
		</div>
	</div>
	<?php
}