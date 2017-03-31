<?php

namespace Cmmarslender\ImageSelect;

use Cmmarslender\ImageSelect\Modules\RenderImages;

/**
 * Function to render the image select instance when called.
 *
 * @author Allen Moore, Chris Marslender
 *
 * @param  array $args an array of options.
 *
 * @return void
 */
function render_image_select( $args ) {
	RenderImages::init( $args );
}