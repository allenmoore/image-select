<?php

namespace Cmmarslender\ImageSelect\Modules;

class RenderImages {

	/**
	 * Function to initialize the Rendering functionality.
	 *
	 * @author Allen Moore
	 *
	 * @param  array $args an array of image select options
	 * @return void
	 */
	public static function init( $args ) {
		self::render( $args );
	}

	/**
	 * Function to return the image data.
	 *
	 * @author Allen Moore
	 *
	 * @param  array      $imageIds an array of image ids.
	 *
	 * @return array|bool           an array of image data.
	 */
	private static function getImageData( $imageIds ) {

		if ( empty( $imageIds ) ) {
			return false;
		}

		$imageData = [];
		foreach ( $imageIds as $id ) {
			$editLink = \get_admin_url( null, 'post.php?post=' . $id . '&action=edit' );
			$imageData[] = [
				'edit' => \esc_url_raw( $editLink ),
				'id'   => (int) $id,
				'name' => \get_the_title( $id ),
				'src'  => \wp_get_attachment_image_src( $id )[0],
			];
		}

		return $imageData;
	}

	/**
	 * Function to return all images.
	 *
	 * @author Allen Moore
	 *
	 * @param  array             $images an array of images.
	 *
	 * @return array|bool|string         an array of all images.
	 */
	private static function getImages( $images ) {

		if ( empty( $images ) ) {
			return false;
		}

		$imageData = '';
		foreach ( $images as $image ) {
			$imageData = self::getImageData( $image );
		}

		return $imageData;
	}

	/**
	 * Function to return post meta for the post image select instance type.
	 *
	 * @author Allen Moore
	 *
	 * @param  string     $key the instance data key.
	 *
	 * @return bool|mixed      the post meta.
	 */
	private static function getPostMetaType( $key ) {
		global $post;

		if ( empty( $key ) ) {
			return false;
		}

		$postId = $post->ID;
		$imageData = \get_post_meta( $postId, $key );

		return $imageData;
	}

	/**
	 * Function to return option data for the option image select instance type.
	 *
	 * @author Allen Moore
	 *
	 * @param  string     $key the instance data key.
	 *
	 * @return bool|mixed      the option data.
	 */
	private static function getOptionType( $key ) {

		if ( empty( $key ) ) {
			return false;
		}

		$imageData = \get_option( $key );

		return $imageData;
	}

	/**
	 * Function to return the user meta data for the user image select instance type.
	 *
	 * @author Allen Moore
	 *
	 * @param  string     $key the instance data key.
	 *
	 * @return bool|mixed      the option data.
	 */
	private static function getUserType( $key ) {


		if ( empty( $key ) ) {
			return false;
		}

		$userId = \get_current_user_id();
		$imageData = \get_user_meta( $userId, $key );

		return $imageData;
	}

	/**
	 * Function to return the instance data type.
	 *
	 * @author Allen Moore
	 * @param  string            $type the instance type.
	 * @param  string            $key  the instance data key.
	 *
	 * @return bool|mixed|string       the image data.
	 */
	private static function getDataType( $type, $key ) {

		$imageData = '';

		switch ( $type ) {
			case 'option':
				$imageData = self::getOptionType( $key );
				break;
			case 'post':
				$imageData = self::getPostMetaType( $key );
				break;
			case 'user':
				$imageData = self::getUserType( $key );
				break;
		}

		return $imageData;
	}

	/**
	 * Function to render the image select instance.
	 *
	 * @author Allen Moore
	 * @param  array $args an array of options.
	 *
	 * @return void
	 */
	public static function render( $args ) {

		$defaults = array(
			'label'       => 'Upload an Image', // Label for the upload
			'name'        => 'cmm-image-upload', // the HTML input name attribute
			'image_id'    => 0, // The ID of the image currently selected for this uploader
			'image_size'  => 'thumbnail',
			'max_uploads' => 50,
			'type'        => 'option',
		);

		$args = \wp_parse_args( $args, $defaults );

		$image_src = \wp_get_attachment_image_src( $args['image_id'], $args['image_size'] );
		$image_src = is_array( $image_src ) ? reset( $image_src ): '';

		if ( empty( $image_src ) ) {
			$image_src = apply_filters( 'cmm-image-select-fallback-url', 'http://placehold.it/150?text=No+Image' );
		}

		\wp_enqueue_style( 'cmmis-admin-styles' );
		?>

		<div id="app"></div>

		<?php
		\wp_enqueue_script( 'media-upload' );
		\wp_enqueue_script( 'cmmis-admin-scripts' );

		$images = self::getDataType( $args['type'], $args['name'] );
		$fieldName = $args['name'];
		$imageData = self::getImages( $images );
		$data = [
			'fieldName'  => $fieldName,
			'images'     => $imageData,
			'maxUploads' => $args['max_uploads'],
		];

		\wp_localize_script(
			'cmmis-admin-scripts',
			'cmmisImageData',
			$data
		);
	}
}