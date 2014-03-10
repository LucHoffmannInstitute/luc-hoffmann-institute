'use strict';

// requiring plugin in /bower_components:
//var plugin = require('../../../../bower_components/plugin/plugin');

var Example = function() {
};

Example.prototype.init = function () {
	console.log('Example module says "hello".');
};

module.exports = new Example();