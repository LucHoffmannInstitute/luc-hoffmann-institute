
var autoprefixer    = require('gulp-autoprefixer');
var browserify      = require('browserify');
var browserSync     = require('browser-sync');
var buffer          = require('vinyl-buffer');
var cache           = require('gulp-cache');
var gulp            = require('gulp');
var imagemin        = require('gulp-imagemin');
var minify          = require('gulp-minify-css');
var modernizr       = require('gulp-modernizr');
var notify          = require('gulp-notify');
var rename          = require('gulp-rename');
var sass            = require('gulp-sass');
var sequence        = require('run-sequence');
var source          = require('vinyl-source-stream');
var uglify          = require('gulp-uglify');

/**
 * Project-specific configuration
 */
var config = {

    hostname: 'luchoffmanninstitute.dev',

    vendor: './bower_components/',

    assets: {
        src: './assets/src/',
        dist: './assets/dist/'
    },

    styles: {
        src: './assets/src/styles/',
        dist: './assets/dist/styles/'
    },

    scripts: {
        src: './assets/src/scripts/',
        dist: './assets/dist/scripts/'
    },

    images: {
        src: './assets/src/img/',
        dist: './assets/dist/img/'
    }

};

/**
 * Default task
 */
gulp.task('default', ['build'], function() {

    // Run modernizr task last
    gulp.run('modernizr');
});

/**
 * Build task
 *
 * Run tasks in sequence.
 */
gulp.task('build', function(callback) {
    
    sequence(

        // Copy dependencies
        'dependencies',

        // Compile styles, scripts, and minify images
        ['styles', 'scripts', 'images'],

        // Browser sync
        'browserSync',

        // Watch
        'watch',

        // Finish sequence
        callback
    );

});

/**
 * Copy dependencies
 *
 * Copy over dependencies from /bower_components
 */
gulp.task('dependencies', function(callback) {

    // Create a local version of jQuery
    gulp.src(config.vendor + 'jquery/dist/jquery.min.js')
        .pipe(gulp.dest(config.scripts.dist));

    // Create a SASS compatible version of normalize.css
    gulp.src(config.vendor + 'normalize-css/normalize.css')
        .pipe(rename('normalize.scss'))
        .pipe(gulp.dest(config.vendor + 'normalize-css'));

    // Create a SASS compatible version of icomoon styles
    gulp.src(config.assets.src + 'vendor/icomoon/styles.css')
        .pipe(rename('style.scss'))
        .pipe(gulp.dest(config.assets.src + 'vendor/icomoon'));

    // Copy icomoon font files to dist/styles/fonts
    gulp.src(config.assets.src + 'vendor/icomoon/fonts/*')
        .pipe(gulp.dest(config.styles.dist + 'fonts'));

    callback();
});

/**
 * Compile styles
 */
gulp.task('styles', function() {
    return gulp.src(config.styles.src + '*.scss')
        .pipe(sass({
            errLogToConsole: true,
            includePaths: [config.vendor]
        }))
        .pipe(autoprefixer({
            map: true
        }))
        //.pipe(minify())
        .pipe(gulp.dest(config.styles.dist))
        .pipe(browserSync.reload({stream: true}));;
});

/**
 * Compile scripts
 */
gulp.task('scripts', function() {
    return browserify({
        paths: [
            './bower_components'
        ],
        entries: [config.scripts.src + 'main.js']
    })
    .bundle()
    .on('error', handleErrors)
    .pipe(source('main.js'))
    .pipe(buffer())
    .pipe(uglify())
    .pipe(gulp.dest(config.scripts.dist))
    .pipe(browserSync.reload({stream: true}));
});

/**
 * Minify images
 */
gulp.task('images', function() {
    return gulp.src(config.images.src + '**/*.{jpg,jpeg,gif,png}')
        .pipe(imagemin({
            optimizationLevel: 3,
            progressive: true,
            interlaced: true
        }))
        .pipe(gulp.dest(config.images.dist))
        .pipe(browserSync.reload({stream: true}));
});

/**
 * Browser sync
 */
gulp.task('browserSync', function() {
    return browserSync({
        notify: false,
        open: false,
        proxy: 'ddcsp.dev'
    });
});

/**
 * Watch files for changes
 */
gulp.task('watch', function() {
    gulp.watch(config.scripts.src + '**/*.js', ['scripts']);
    gulp.watch(config.styles.src + '**/*.scss', ['styles']);
    gulp.watch(config.images.src + '**/*', ['images']);
    gulp.watch('**/*.php', function() {
        browserSync.reload();
    });
});

/**
 * Modernizr
 *
 * This is an in-progress and somewhat unstable task,
 * and must run after other tasks.
 */
gulp.task('modernizr', function() {
    gulp.src([
            config.scripts.src + '**/*.js',
            config.styles.src + '**/*.scss'
        ])
        .pipe(modernizr())
        .pipe(uglify())
        .pipe(gulp.dest(config.scripts.dist))
        .pipe(browserSync.reload({stream: true}));
});

/**
 * Error handler
 */
var handleErrors = function() {
    notify.onError({
        title: 'Compile Error',
        message: '<%= error.message %>'
    }).apply(this, arguments);

    this.emit('end');
};