import babelify from 'babelify';
import browserify from 'browserify';
import buffer from 'vinyl-buffer';
import gulp from 'gulp';
import gUtil from 'gulp-util';
import livereload from 'gulp-livereload';
import rename from 'gulp-rename';
import source from 'vinyl-source-stream';
import sourcemaps from 'gulp-sourcemaps';
import vueify from 'vueify';

const config = {
	src: 'assets/js/src/components/new-image/new-image.js',
	dist: 'cmmis.js',
	dest: 'assets/js/dist'
};

gulp.task( 'js', function() {
	const b = browserify( config.src, {
		debug: true
	} ).transform( babelify, {
		presets: ['es2015']
	} ).transform( vueify );

	return b.bundle()
		.pipe( source( config.src ) )
		.pipe( buffer() )
		.pipe( sourcemaps.init( {
			loadMaps: true
		} ) )
		.on( 'error', gUtil.log )
		.pipe( rename( config.dist ) )
		.pipe( sourcemaps.write( './' ) )
		.pipe( gulp.dest( config.dest ) )
		.pipe( livereload() );
} );
