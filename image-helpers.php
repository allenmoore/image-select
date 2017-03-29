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
	<div class="cmmis-images">
		<div class="cmmis-image">
			<img class="image" src="https://placeimg.com/131/131/tech" />
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-caption"><?php esc_html_e( 'title-goes-here', 'cmmis' ); ?></div>
		</div>
		<div class="cmmis-image">
			<img class="image" src="https://placeimg.com/131/131/tech" />
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-caption"><?php esc_html_e( 'title-goes-here', 'cmmis' ); ?></div>
		</div>
		<div class="cmmis-image">
			<img class="image" src="https://placeimg.com/131/131/tech" />
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-caption"><?php esc_html_e( 'title-goes-here', 'cmmis' ); ?></div>
		</div>
		<div class="cmmis-image">
			<img class="image" src="https://placeimg.com/131/131/tech" />
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-caption"><?php esc_html_e( 'title-goes-here', 'cmmis' ); ?></div>
		</div>
		<div class="cmmis-image">
			<img class="image" src="https://placeimg.com/131/131/tech" />
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-caption"><?php esc_html_e( 'title-goes-here', 'cmmis' ); ?></div>
		</div>
		<div class="cmmis-image">
			<img class="image" src="https://placeimg.com/131/131/tech" />
			<div class="image-actions">
				<button class="cmmis-button -edit" aria-pressed="false">
					<svg class="svg-edit" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><title>Edit</title><path class="path" d="M10.89.39l2.71 2.72c.46.46.42 1.24.03 1.64l-8.01 8.02-5.56 1.16 1.16-5.58S8.82.72 9.21.32c.39-.39 1.22-.39 1.68.07zM8.16 3.18L2.57 8.79 3.68 9.9l5.54-5.65-1.06-1.07zm-2.97 8.23l5.58-5.6L9.7 4.73l-5.59 5.6 1.08 1.08z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Edit Image', 'cmmis' ); ?></span>
				</button>
				<button class="cmmis-button -delete" aria-pressed="false">
					<svg class="svg-delete" viewBox="0 0 13 16" xmlns="http://www.w3.org/2000/svg"><title>Delete</title><path class="path" d="M9 2h3c.55 0 1 .45 1 1v1H0V3c0-.55.45-1 1-1h3C4.23.86 5.29 0 6.5 0S8.77.86 9 2zM5 2h3c-.21-.58-.85-1-1.5-1S5.21 1.42 5 2zM1 5h11v10c0 .55-.45 1-1 1H2c-.55 0-1-.45-1-1V5zm3 9V7H3v7h1zm3 0V7H6v7h1zm3 0V7H9v7h1z"/></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'Delete Image', 'cmmis' ); ?></span>
				</button>
			</div>
			<div class="image-caption"><?php esc_html_e( 'title-goes-here', 'cmmis' ); ?></div>
		</div>
	</div>
	<div class="cmmis-footer">
		<button class="button button-primary button-large" aria-pressed="false">
			<svg class="svg-plus" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg"><title>Plus</title><path class="path" d="M13 5v3H8v5H5V8H0V5h5V0h3v5z"/></svg>
			<?php esc_html_e( 'Add Image', 'cmmis' ); ?>
		</button>
	</div>
	<?php
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

