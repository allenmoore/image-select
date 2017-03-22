import babelify from 'babelify';
import browserify from 'browserify';
import buffer from 'vinyl-buffer';
import gulp from 'gulp';
import gUtil from 'gulp-util';
import livereload from 'gulp-livereload';
import rename from 'gulp-rename';
import source from 'vinyl-source-stream';
import sourcemaps from 'gulp-sourcemaps';

const config = {
	src: 'assets/js/src/cmm-image-select.js',
	dist: 'cmm-image-select.js',
	distDir: 'assets/js/dist'
};

gulp.task( 'js', function() {
	const b = browserify( config.src, {
		debug: true
	} ).transform( babelify, {
		presets: ['es2015']
	} );

	return b.bundle()
		.pipe( source( config.src ) )
		.pipe( buffer() )
		.pipe( sourcemaps.init( {
			loadMaps: true
		} ) )
		.on( 'error', gUtil.log )
		.pipe( rename( config.dist ) )
		.pipe( sourcemaps.write( './' ) )
		.pipe( gulp.dest( config.distDir ) )
		.pipe( livereload() );
} );
