import eslint from 'gulp-eslint';
import gulp from 'gulp';
import pump from 'pump';

gulp.task( 'eslint', function( cb ) {
	pump( [
		gulp.src( [
			'assets/js/src/**/*.js',
			'!node_modules/**'
		] ),
		eslint( {
			configFile: 'node_modules/eslint-config-allenmoore/.eslintrc'
		} ),
		eslint.format(),
		eslint.failAfterError()
	], cb );
} );
