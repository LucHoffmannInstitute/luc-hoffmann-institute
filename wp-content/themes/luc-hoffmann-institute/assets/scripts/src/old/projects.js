/**
 * Projects
 */
define([
	'masonry'
], function (Masonry) {
	'use strict';

	var Projects = function ( element, options ) {
		this.$el = element;
		this.init( options );
	};

	/**
	 * Settings
	 */
	Projects.prototype = {
		$masonryContainer: $('.Projects-masonry-container'),
		itemSelector: '.Project'
	};

	/**
	 * Intialization
	 */
	Projects.prototype.init = function ( options ) {
		this.options = $.extend( true, {}, this.settings, options );

		// initialize masonry
		//this.initMasonry();
	};

	/**
	 * Intialize Masonry
	 */
	Projects.prototype.initMasonry = function () {
		var _this = this;

		var msnry = new Masonry( this.$masonryContainer.get(0), {
			itemSelector: '.Project'
		});
	};

	new Projects();
});