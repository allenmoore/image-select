<?php
/*
 * Plugin Name: Marslender Image Upload
 * Description: Includes some helpers to make upload image fields really easy to implement. Example file (options-api-example.php) demonstrates how to use this with the options API, but you can utilize the helper function anywhere (such as meta boxes), and process the $_POST data (An Image ID) yourself as well.
 * Author: Chris Marslender
 * Author URI: http://chrismarslender.com
 * Version: 2.0.0
 */

namespace Cmmarslender\ImageSelect;

define( 'CMMIS_VERSION', '2.0.0' );
define( 'CMMIS_URL', plugin_dir_url( __FILE__ ) );
define( 'CMMIS_PATH', dirname( __FILE__ ) . '/' );
define( 'CMMIS_INC', CMMIS_PATH . 'includes/' );

include __DIR__ . '/image-helpers.php';

//function admin_scripts() {
//	wp_enqueue_media();
//	wp_enqueue_script( 'cmm-image-upload', \Cmmarslender\WPLibraryHelpers\library_url( 'image-upload.js', __FILE__ ), array( 'jquery' ), '2.0.0', true );
//}
//add_action( 'admin_enqueue_scripts', 'Cmmarslender\ImageSelect\admin_scripts' );
