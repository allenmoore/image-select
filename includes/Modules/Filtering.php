<?php

namespace Cmmarslender\ImageSelect\Modules;

class Filtering {

	/**
	 * Filtering constructor.
	 *
	 * @author Allen Moore
	 */
	public function __construct() {
		add_filter( 'wp_prepare_attachment_for_js', [ $this, 'filterAttachmentForJs' ] );
	}

	/**
	 * Function to return the image sizes.
	 *
	 * @author Allen Moore, Chris Marslender
	 *
	 * @param  int        $postId the post id.
	 *
	 * @return array|bool         an image size array.
	 */
	public function returnSizes( $postId ) {
		
		$sizeNames = \get_intermediate_image_sizes();

		if ( ! is_array( $sizeNames ) || 0 === count( $sizeNames ) ) {
			return false;
		}

		$sizeNames[] = 'full';
		$sizeData = [];

		/* Loop through each of the image sizes. */
		foreach ( $sizeNames as $sizeName ) {

			$image = \wp_get_attachment_image_src( $postId, $sizeName );

			/* Return name, link, width, height */
			if ( ! empty( $image ) && ( true === $image[3] || 'full' === $sizeName ) ) {
				$sizeData[ $sizeName ] = [
					'url' => $image[0],
					'width' => $image[1],
					'height' => $image[2],
					'orientation' => $image[2] > $image[1] ? 'portrait' : 'landscape',
				];
			}
		}

		/* Return if array */
		if ( is_array( $sizeData ) && count( $sizeData ) > 0 ) {
			return $sizeData;
		}
	}

	/**
	 * Function to filter attachments for JavaScript.
	 *
	 * @author Allen Moore, Chris Marslender
	 *
	 * @param  object $attachment the attachment object.
	 *
	 * @return object             the attachment object.
	 */
	public function filterAttachmentForJs( $attachment ) {
		$sizes = $this->returnSizes( $attachment['id'] );

		if ( $sizes ) {
			$attachment['sizes'] = $sizes;
		}

		return $attachment;
	}
}

$cmmisFiltering = new Filtering();