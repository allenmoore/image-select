import colorRgbaFallback from 'postcss-color-rgba-fallback';
import cssnext from 'postcss-cssnext';
import gulp from 'gulp';
import livereload from 'gulp-livereload';
import postcss from 'gulp-postcss';
import pump from 'pump';
import reporter from 'postcss-reporter';
import rgbPlz from 'postcss-rgb-plz';
import sourcemaps from 'gulp-sourcemaps';

const config = {
	src: './assets/css/scss/styles.scss',
	srcDir: './assets/css/src',
	distDir: './assets/css/dist'
};

gulp.task( 'postcss', function( cb ) {
	let processors = [
		rgbPlz(),
		cssnext( {
			features: {
				autoprefixer: {
					browsers: [
						'last 2 versions'
					]
				}
			}
		} ),
		colorRgbaFallback(),
		reporter( {
			clearMessages: true,
			throwError: true
		} )
	];

	pump( [
		gulp.src( './assets/css/src/styles.css' ),
		postcss( processors ),
		sourcemaps.init( {
			loadMaps: true
		} ),
		sourcemaps.write( './' ),
		gulp.dest( config.distDir ),
		livereload()
	], cb );
} );
