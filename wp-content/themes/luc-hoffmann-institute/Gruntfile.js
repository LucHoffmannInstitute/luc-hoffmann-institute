'use strict';

var rsyncConfig = require('./rsync-config.json');

module.exports = function(grunt) {

	grunt.initConfig({

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'./assets/scripts/src/{,*/}*.js'
			]
		},

		uglify: {
			dist: {
				options: {
					sourceMap: './assets/scripts/build/main.js.map',
					sourceMapRoot: '../',
					sourceMappingURL: '../build/main.js.map',
					sourceMapPrefix: '3'
				},
				files: {
					'./assets/scripts/build/main.min.js': [
						'./bower_components/get-style-property/get-style-property.js',
						'./bower_components/jquery-smartresize/jquery.debouncedresize.js',
						'./bower_components/fittext/fittext.js',
						'./bower_components/skrollr/src/skrollr.js',
						'./bower_components/fitvids/jquery.fitvids.js',
						'./assets/scripts/src/plugins/royalslider/jquery.royalslider.js',
						'./assets/scripts/src/main.js',
					]
				}
			}
		},

		sass: {
			dist: {
				options: {
					sourcemap: true
				},
				files: {
					'./assets/styles/build/screen.css': [
						'./assets/styles/src/screen.scss'
					]
				}
			}
		},

		autoprefixer: {
			dist: {
				options: {
					browsers: ['last 2 versions']
				},
				files: {
					'./assets/styles/build/screen.css': [
						'./assets/styles/build/screen.css'
					]
				}
			}
		},

		cssmin: {
			dist: {
				options: {
					//banner: '/*  */'
				},
				files: {
					'./assets/styles/build/screen.css': './assets/styles/build/screen.css'
				}
			}
		},

		watch: {
			scss: {
				files: ['./assets/styles/src/**/*.scss'],
				tasks: [ 'sass', 'autoprefixer', 'cssmin' ]
			},
			css: {
				files: ['./assets/styles/build/**/*.css'],
				options: {
					livereload: true
				}
			},
			scripts: {
				files: ['./assets/scripts/src/**/*.js'],
				tasks: [ 'jshint', 'uglify' ],
				options: {
					livereload: true
				}
			},
			files: {
				files: [
					'./**/*.html',
					'./**/*.php'
				],
				tasks: [],
				options: {
					livereload: true
				}
			}
		},

		imagemin: {
			dynamic: {
				options: {

				},
				files: [{
					expand: true,
					cwd: './assets/img/src/',
					src: ['**/*.{png,jpg,gif}'],
					dest: './assets/img/build/'
				}]
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-imagemin');


	grunt.registerTask('server', [
		'default',
		'watch'
	]);

	grunt.registerTask('default', [
		'jshint',
		'uglify',
		'sass',
		'autoprefixer',
		'cssmin'
	]);

};