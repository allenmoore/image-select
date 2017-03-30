'use strict';

/**
 * Global Variables.
 *
 * @author Allen Moore
 */
import gulp from 'gulp';
import requireDir from 'require-dir';
import runSequence from 'run-sequence';

requireDir( './gulp-tasks' );

gulp.task( 'watch', function() {
	gulp.watch( 'assets/css/scss/**/*.scss', ['sass', 'postcss', 'cssnano'] );
	gulp.watch( 'assets/svg/src/**/*.svg', ['svgmin'] );
} );

/**
 * The default gulp task.
 *
 * @author Allen Moore
 * @example
 * gulp
 */
gulp.task( 'default', function() {
	runSequence(
		'sass',
		'postcss',
		'cssnano',
		'svgmin'
	);
} );
