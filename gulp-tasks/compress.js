import gulp from 'gulp';
import livereload from 'gulp-livereload';
import pump from 'pump';
import rename from 'gulp-rename';
import sourcemaps from 'gulp-sourcemaps';
import uglify from 'gulp-uglify';

const config = {
	src: [
		'assets/js/vendor/**/*.js',
		'assets/js/src/**/*.js'
	],
	dist: 'cmm-image-select.js',
	distDir: 'assets/js/dist'
};

gulp.task( 'compress', function( cb ) {
	pump( [
		gulp.src( [
			'assets/js/dist/**/*.js',
			'!assets/js/dist/**/*.min.js'
		] ),
		uglify(),
		rename( function( path ) {
			path.extname = '.min.js'
		} ),
		sourcemaps.init( {
			loadMaps: true
		} ),
		sourcemaps.write( './' ),
		gulp.dest( config.distDir ),
		livereload()
	], cb );
} );
