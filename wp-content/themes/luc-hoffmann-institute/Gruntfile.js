'use strict';

module.exports = function(grunt) {

	grunt.initConfig({

		paths: {
			dev: './',
			tmp: './.tmp/'
		},

		/**
		 * JSHint
		 */
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'<%= paths.dev %>assets/scripts/src/**/*.js'
			]
		},

		/**
		 * RequireJS
		 */
		requirejs: {
			compile: {
				options: {
					baseUrl: '<%= paths.dev %>',
					mainConfigFile: '<%= paths.dev %>assets/scripts/src/app.js',
					deps: ['assets/scripts/src/app.js'],
					insertRequire: ['assets/scripts/src/app.js'],
					name: 'bower_components/almond/almond',
					out: '<%= paths.dev %>assets/scripts/build/main.js',
					optimize: 'none'
				}
			}
		},

		/**
		 * Uglify
		 */
		uglify: {
			dist: {
				options: {
					sourceMap: '<%= paths.dev %>assets/scripts/build/main.js.map',
					sourceMapRoot: '../',
					sourceMappingURL: '../build/main.js.map',
					sourceMapPrefix: '3'
				},
				files: {
					'<%= paths.dev %>assets/scripts/build/main.js': [
						'<%= paths.dev %>bower_components/get-style-property/get-style-property.js',
						'<%= paths.dev %>bower_components/jquery-smartresize/jquery.debouncedresize.js',
						'<%= paths.dev %>bower_components/fittext/fittext.js',
						'<%= paths.dev %>bower_components/skrollr/src/skrollr.js',
						'<%= paths.dev %>bower_components/fitvids/jquery.fitvids.js',
						'<%= paths.dev %>assets/vendor/royalslider/jquery.royalslider.js',
						'<%= paths.dev %>assets/scripts/src/main.js',
					]
				}
			}
		},

		/**
		 * Copying/moving/renaming files
		 */
		copy: {
			grunticon: {
				files: [
					// make icomoon.scss
					{
						src: '<%= paths.dev %>assets/vendor/icomoon/style.css',
						dest: '<%= paths.dev %>assets/vendor/icomoon/style.scss'
					},

					// copy fonts
					{
						expand: true,
						flatten: true,
						cwd: '<%= paths.dev %>assets/vendor/icomoon/fonts',
						src: ['*'],
						dest: '<%= paths.dev %>assets/styles/build/fonts'
					}
				]
			},
			royalslider: {
				src: '<%= paths.dev %>assets/vendor/royalslider/royalslider.css',
				dest: '<%= paths.dev %>assets/vendor/royalslider/royalslider.scss'
			}
		},

		/**
		 * SASS
		 * preprocess assets/styles/src/*.scss into tmp
		 */
		sass: {
			dist: {
				files: [
					{
						expand: true,
						flatten: true,
						cwd: '<%= paths.dev %>assets/styles/src',
						src: ['*.scss'],
						dest: '<%= paths.tmp %>',
						ext: '.css'
					}
				]
			}
		},

		/**
		 * Autoprefixer
		 * process tmp/*.css in place
		 */
		autoprefixer: {
			dist: {
				options: {
					browsers: ['last 2 versions']
				},
				files: [
					{
						expand: true,
						flatten: true,
						cwd: '<%= paths.tmp %>',
						src: ['*.css'],
						dest: '<%= paths.tmp %>',
						ext: '.css'
					}
				]
			}
		},

		/**
		 * CSSMIN
		 * process tmp/*.css into assets/styles/build/
		 */
		cssmin: {
			dist: {
				expand: true,
				cwd: '<%= paths.tmp %>',
				src: ['*.css'],
				dest: '<%= paths.dev %>assets/styles/build',
				ext: '.css'
			}
		},

		/**
		 * Modernizr
		 * check styles and scripts for modernizr tests
		 */
		modernizr: {
			devFile: '<%= paths.dev %>bower_components/modernizr/modernizr.js',
			outputFile: '<%= paths.dev %>assets/scripts/build/modernizr.js',
			uglify: true,
			files: [
				'<%= paths.dev %>assets/styles/src/**/*.scss',
				'<%= paths.dev %>assets/scripts/**/*.js'
			]
		},

		/**
		 * Image minification
		 */
		imagemin: {
			dynamic: {
				files: [
					{
						expand: true,
						cwd: '<%= paths.dev %>assets/img/src',
						src: ['**/*.{png,gif,jpg,jpeg}'],
						dest: '<%= paths.dev %>assets/img/build/'
					}
				]
			}
		},

		/**
		 * Watch files for changes
		 */
		watch: {
			js: {
				files: ['Gruntfile.js', '<%= paths.dev %>assets/scripts/src/**/*.js'],
				tasks: ['jshint', 'requirejs']
			},
			sass: {
				files: ['<%= paths.dev %>assets/styles/src/**/*.scss'],
				tasks: ['sass', 'autoprefixer', 'cssmin']
			},
			livereload: {
				files: [
					'<%= paths.dev %>**/*.php',
					'<%= paths.dev %>assets/scripts/build/*.js',
					'<%= paths.dev %>assets/styles/build/*.css',
					'<%= paths.dev %>assets/img/*.{png,gif,jpg,jpeg}',
				],
				options: {
					livereload: true
				}
			}
		}

	});

	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-requirejs');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-modernizr');

	grunt.registerTask('dev', [
		'default',
		'watch'
	]);

	grunt.registerTask('default', [
		'jshint',
		'requirejs',
		'modernizr',
		'copy',
		'sass',
		'autoprefixer',
		'cssmin',
		'imagemin'
	]);

};