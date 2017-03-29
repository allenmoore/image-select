import cssnano from 'cssnano';
import gulp from 'gulp';
import livereload from 'gulp-livereload';
import postcss from 'gulp-postcss';
import pump from 'pump';
import rename from 'gulp-rename';
import reporter from 'postcss-reporter';
import sourcemaps from 'gulp-sourcemaps';

const config = {
	src: './assets/css/dist/cmmis-admin-styles.css',
	dest: './assets/css/dist'
};

gulp.task( 'cssnano', function( cb ) {
	let processors = [
		cssnano( {
			autoprefixer: false,
			calc: {
				precision: 8
			},
			filterPlugins: false
		} ),
		reporter( {
			clearMessages: true,
			throwError: true
		} )
	];

	pump( [
		gulp.src( config.src ),
		postcss( processors ),
		rename( function( path ) {
			path.extname = '.min.css'
		} ),
		sourcemaps.init( {
			loadMaps: true
		} ),
		sourcemaps.write( './' ),
		gulp.dest( config.dest ),
		livereload()
	], cb );
} );
