<?php

namespace Cmmarslender\ImageSelect\Modules;

class Uploads {

	/**
	 * Uploads constructor.
	 *
	 * @author Allen Moore
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'AdminScripts' ] );
	}

	/**
	 * Localize scripts and enqueue
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function AdminScripts() {

		$min = ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ? '' : '.min';

		wp_register_style(
			'cmmis-admin-styles',
			CMMIS_URL . "assets/css/dist/cmmis-admin-styles{$min}.css",
			array(),
			CMMIS_VERSION
		);

		wp_register_script(
			'cmmis-admin-scripts',
			CMMIS_URL . "assets/js/dist/cmmis{$min}.js",
			array(),
			CMMIS_VERSION,
			true
		);
	}
};

$cmmisUploads = new Uploads();