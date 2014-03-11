'use strict';

var gulp = require('gulp');
var sass = require('gulp-ruby-sass');

// load plugins
var plugins = require('gulp-load-plugins')({ 
	camelize: true 
});

gulp.task('jshint', function () {
	return gulp.src(['./assets/scripts/src/**/*.js'])
		.pipe(plugins.jshint('.jshintrc'))
		.pipe(plugins.jshint.reporter('default'));
});

gulp.task('scripts', function () {
	return gulp.src('./assets/scripts/src/main.js')
		.pipe(plugins.browserify())
		.pipe(plugins.uglify())
		.pipe(gulp.dest('./assets/scripts/build'));
});

gulp.task('styles', function () {
	return gulp.src('./assets/styles/src/*.scss')
		.pipe(sass())
		.pipe(plugins.autoprefixer('last 2 versions', 'ie 8', 'ie 7'))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest('./assets/styles/build'));
});

gulp.task('modernizr', function () {
	return gulp.src(['./assets/scripts/build/**/*.js','./assets/styles/build/**/*.css'])
		.pipe(plugins.modernizr())
		.pipe(plugins.uglify())
		.pipe(gulp.dest('./assets/vendor'));
});

gulp.task('setup', function () {
	// make sass version of normalize.css
	gulp.src('./bower_components/normalize-css/normalize.css')
		.pipe(plugins.rename('normalize.scss'))
		.pipe(gulp.dest('./assets/vendor'));

	// make sass version of icomoon styles
	gulp.src('./assets/vendor/icomoon/style.css')
		.pipe(plugins.rename('style.scss'))
		.pipe(gulp.dest('./assets/vendor/icomoon'));

	// copy fonts to styles/build/
	gulp.src('./assets/vendor/icomoon/fonts/*')
		.pipe(gulp.dest('./assets/styles/build/fonts'));

	// copy over jquery.min.js
	gulp.src('./bower_components/jquery/dist/jquery.min.js')
		.pipe(gulp.dest('./assets/vendor'));
});

gulp.task('watch', function () {

	var server = plugins.livereload();

	gulp.watch('./assets/scripts/src/**/*.js', ['jshint', 'scripts']);
	gulp.watch('./assets/styles/src/**/*.scss', ['styles']);

	gulp.watch([
			'./assets/scripts/build/**/*.js', 
			'./assets/styles/build/**/*.css',
			'./**/*.php'
		]).on('change', function (file) {
			server.changed(file.path);
		});
});

gulp.task('default', ['jshint', 'scripts', 'styles', 'modernizr']);

gulp.task('dev', ['default', 'watch']);