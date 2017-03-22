import gulp from 'gulp';
import livereload from 'gulp-livereload';
import pump from 'pump';
import sass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';

const config = {
	src: './assets/css/scss/styles.scss',
	srcDir: './assets/css/src'
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
		sourcemaps.write( './' ),
		gulp.dest( config.srcDir ),
		livereload()
	], cb );
} );
