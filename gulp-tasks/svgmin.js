import gulp from 'gulp';
import livereload from 'gulp-livereload';
import pump from 'pump';
import svgmin from 'gulp-svgmin';

const config = {
	src: 'assets/svg/src/**/*.svg',
	dist: 'assets/svg/dist'
};

/**
 * Function to handle SVG file minification.
 *
 * @author Allen Moore
 */
gulp.task( 'svgmin', function( cb ) {
	pump( [
		gulp.src( config.src ),
		svgmin( {
			plugins: [
				{removeViewBox: false},
				{removeRasterImages: false},
				{removeTitle: false},
				{sortAttrs: false}
			]
		} ),
		gulp.dest( config.dist ),
		livereload()
	], cb );
} );
