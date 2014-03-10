'use strict';

var rsyncConfig = require('./rsync-config.json');

module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		rsync: {
			options: {},
			stage: {
				options: {
					src: './',
					dest: rsyncConfig.staging.dest,
					host: rsyncConfig.staging.host,
					exclude: ['.git*', '.sass-cache', '.tmp', '.htaccess', 'rsync-config.json', 'node_modules'],
					recursive: true,
					syncDest: false
				}
			}
		}

	});

	grunt.registerTask('stage', [
		'rsync:stage'
	]);

};