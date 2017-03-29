import gulp from 'gulp';
import livereload from 'gulp-livereload';
import pump from 'pump';
import rename from 'gulp-rename';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';

const config = {
	src: './assets/css/scss/admin.scss',
	dist: 'cmmis-admin-styles.css',
	dest: './assets/css/src'
};

gulp.task( 'sass', function( cb ) {
	pump( [
		gulp.src( config.src ),
		sass( {
			outputStyle: 'expanded'
		} ),
		sourcemaps.init( {
			loadMaps: true
		} ),
		rename( config.dist ),
		sourcemaps.write( './' ),
		gulp.dest( config.dest ),
		livereload()
	], cb );
} );
