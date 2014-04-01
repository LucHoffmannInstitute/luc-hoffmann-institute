'use strict';

/**
 * Load gulp and plugins
 *
 * http://gulpjs.com/
 * https://github.com/jackfranklin/gulp-load-plugins
 */
var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var gutil = require('gulp-util');

/**
 * JSHint
 *
 * Detect errors and potential problems in your javascript
 * https://github.com/wearefractal/gulp-jshint
 */
gulp.task('jshint', function (cb) {
	gulp.src('./assets/scripts/src/**/*.js')
		.pipe($.jshint('.jshintrc'))
		.pipe($.jshint.reporter('default'));
	cb();
});

/**
 * Scripts
 *
 * Combine and minify your javascript
 * https://github.com/deepak1556/gulp-browserify
 */
gulp.task('scripts', ['jshint'], function (cb) {
	gulp.src('./assets/scripts/src/main.js')
		.pipe($.browserify())
		.pipe($.uglify())
		.pipe(gulp.dest('./assets/scripts/build'));
	cb();
});

/**
 * Dependencies
 *
 * Copy SASS and javascript dependencies from /bower_components/
 */
gulp.task('dependencies', function (cb) {

	// Place SASS compatible version of normalize.css into vendor folder
	gulp.src('./bower_components/normalize-css/normalize.css')
		.pipe($.rename('normalize.scss'))
		.pipe(gulp.dest('./assets/vendor'));

	// Copy production-ready jQuery to production vendor folder
	gulp.src('./bower_components/jquery/dist/jquery.min.js')
		.pipe(gulp.dest('./assets/vendor'));

	// make sass version of icomoon styles
	gulp.src('./assets/vendor/icomoon/style.css')
		.pipe($.rename('style.scss'))
		.pipe(gulp.dest('./assets/vendor/icomoon'));

	// copy fonts to styles/build/
	gulp.src('./assets/vendor/icomoon/fonts/*')
		.pipe(gulp.dest('./assets/styles/build/fonts'));

	cb();
});

/**
 * Process SASS and autoprefix
 *
 * https://github.com/sindresorhus/gulp-ruby-sass
 * https://github.com/Metrime/gulp-autoprefixer
 */
gulp.task('styles', function (cb) {
	gulp.src('./assets/styles/src/*.scss')
		.pipe($.rubySass({
			style: 'expanded',
			loadPath: ['app/bower_components']
		}))
		.pipe($.autoprefixer('last 1 version'))
		.pipe(gulp.dest('./assets/styles/build'));
	cb();
});

/**
 * ImageMin
 *
 * Minify and copy images to /dist/assets/img/
 */
gulp.task('imagemin', function (cb) {
	gulp.src('./assets/img/src/**/*')
		.pipe($.cache($.imagemin({
			optimizationLevel: 3,
			progressive: true,
			interlaced: true
		})))
		.pipe(gulp.dest('./assets/img/build'));
	cb();
});

/**
 * Modernizr
 *
 * Create a custom modernizr build
 * https://github.com/doctyper/gulp-modernizr
 */
gulp.task('modernizr', ['scripts', 'styles'], function (cb) {
	gulp.src(['./assets/scripts/build/**/*.js','./assets/styles/build/**/*.css'])
		.pipe($.modernizr())
		.pipe($.uglify())
		.pipe(gulp.dest('./assets/vendor'));
	cb();
});

/**
 * Watch
 *
 * Watch files for changes
 */
gulp.task('watch', function () {

	var server = $.livereload();

	gulp.watch([
		'./assets/scripts/build/**/*.js',
		'./assets/styles/build/**/*.css',
		'./**/*.php'
	], function (file) {
		server.changed(file.path);
	});

	gulp.watch('./assets/scripts/src/**/*.js', ['jshint', 'scripts']);
	gulp.watch('./assets/styles/src/**/*.scss', ['styles']);
	gulp.watch('./assets/img/src/**/*', ['imagemin']);
});

gulp.task('default', ['dependencies'], function (cb) {
	gulp.start('jshint', 'scripts', 'styles', 'imagemin', 'modernizr');
	cb();
});

gulp.task('dev', ['default', 'watch']);
