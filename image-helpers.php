<?php

namespace Cmmarslender\ImageSelect;

function render_image_select( $args ) {
	$defaults = array(
		'label' => 'Upload an Image', // Label for the upload
		'name' => 'cmm-image-upload', // the HTML input name attribute
		'image_id' => 0, // The ID of the image currently selected for this uploader
		'image_size' => 'thumbnail',
	);

	$args = wp_parse_args( $args, $defaults );

	$image_src = wp_get_attachment_image_src( $args['image_id'], $args['image_size'] );
	$image_src = is_array( $image_src ) ? reset( $image_src ): '';

	if ( empty( $image_src ) ) {
		$image_src = apply_filters( 'cmm-image-select-fallback-url', 'http://placehold.it/150?text=No+Image' );
	}

	?>
	<div class="image-select-parent" data-image-size="<?php echo esc_attr( $args['image_size'] ); ?>">
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

function cmmisRenderImages( $args ) {
	$defaults = array(
		'label' => 'Upload an Image', // Label for the upload
		'name' => 'cmm-image-upload', // the HTML input name attribute
		'image_id' => 0, // The ID of the image currently selected for this uploader
		'image_size' => 'thumbnail',
	);

	$args = wp_parse_args( $args, $defaults );

	$image_src = wp_get_attachment_image_src( $args['image_id'], $args['image_size'] );
	$image_src = is_array( $image_src ) ? reset( $image_src ): '';

	if ( empty( $image_src ) ) {
		$image_src = apply_filters( 'cmm-image-select-fallback-url', 'http://placehold.it/150?text=No+Image' );
	}

	wp_enqueue_style( 'cmmis-admin-styles' );
	?>
	<div id="app"></div>
	<?php
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'cmmis-admin-scripts' );
}

/**
 * Localize scripts and enqueue
 */
function cmmisAdminScripts() {

	$postfix = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

	wp_register_style(
		'cmmis-admin-styles',
		CMMIS_URL . "assets/css/dist/cmmis-admin-styles{$postfix}.css",
		array(),
		CMMIS_VERSION
	);

	wp_register_script(
		'cmmis-admin-scripts',
		CMMIS_URL . "assets/js/dist/cmmis.js",
		array(
			'jquery'
		),
		CMMIS_VERSION,
		true
	);
}
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\cmmisAdminScripts' );

function marslender_image_select_filter_attachment_for_js( $attachment ) {
	$sizes = marslender_image_select_return_sizes( $attachment['id'] );

	if ( $sizes ) {
		$attachment['sizes'] = $sizes;
	}

	return $attachment;
}
add_filter( 'wp_prepare_attachment_for_js', __NAMESPACE__ . '\marslender_image_select_filter_attachment_for_js' );

function marslender_image_select_return_sizes( $post_id ) {
	$size_names = \get_intermediate_image_sizes( $post_id );

	if( ! is_array($size_names) || count($size_names) === 0 ) {
		return false;
	}

	$size_names[] = 'full';

	$size_data = array();

	/* Loop through each of the image sizes. */
	foreach ( $size_names as $size_name ) {

		$image = \wp_get_attachment_image_src( $post_id, $size_name );

		/* Return name, link, width, height */
		if ( ! empty( $image ) && ( true == $image[3] || 'full' == $size_name ) ) {
			$size_data[ $size_name ] = array (
				'url' => $image[0],
				'width' => $image[1],
				'height' => $image[2],
				'orientation' => $image[2] > $image[1] ? 'portrait' : 'landscape',
			);
		}
	}

	/* Return if array */
	if (is_array($size_data) && count($size_data) > 0) {
		return $size_data;
	}
}

