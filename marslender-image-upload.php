<?php
/*
 * Plugin Name: Marslender Image Upload
 * Description: Includes some helpers to make upload image fields really easy to implement. Example file (options-api-example.php) demonstrates how to use this with the options API, but you can utilize the helper function anywhere (such as meta boxes), and process the $_POST data (An Image ID) yourself as well.
 * Author: Chris Marslender
 * Author URI: http://chrismarslender.com
 * Version: 1.0.0
 */

namespace Marslender\ImageSelect;

include __DIR__ . '/image-helpers.php';

function admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'cmm-image-upload', plugin_dir_url( __FILE__ ) . '/image-upload.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'Marslender\ImageSelect\admin_scripts' );

// Include the example using the options api. Not required for customized implementations, but demonstrates how to use.
include __DIR__ . '/options-api-example.php';
