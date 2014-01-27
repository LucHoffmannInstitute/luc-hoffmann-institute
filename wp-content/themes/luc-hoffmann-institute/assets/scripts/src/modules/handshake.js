/**
 * Handshake animations
 */
define([
], function () {
	'use strict';

	var Handshake = function ( element, options ) {
		this.$el = element;
		this.init( options );
	};

	Handshake.prototype = {
	};

	Handshake.prototype.settings = {
		itemSelector: '.handshake-item',
		animateActiveClass: 'fadeUpAndIn',
		animateInactiveClass: 'fadeUpAndOut',
		delay: 4000
	};

	Handshake.prototype.init = function ( options ) {
		var _this = this;

		this.options = $.extend( true, {}, this.settings, options, this.$el.data('slider') );

		// get items
		this.$items = $( this.options.itemSelector );

		// run intervals
		setInterval( function () {
			_this.animateHandshake();
		}, this.options.delay );
	};

	/**
	 * Run animations
	 */
	Handshake.prototype.animateHandshake = function () {
		var $activeItem = this.$items.filter( '.' + this.options.animateActiveClass );
		var $nextItem = $activeItem.next();

		$nextItem = $nextItem.length ? $nextItem : this.$items.first();

		$activeItem.removeClass( this.options.animateActiveClass );
		$activeItem.addClass( this.options.animateInactiveClass );

		$nextItem.removeClass( this.options.animateInactiveClass );
		$nextItem.addClass( this.options.animateActiveClass );
	};

	/**
	 * jQuery plugin
	 */
	$.fn.handshake = function ( options ) {
		return this.each( function () {
			new Handshake( $(this), options );
		} );
	};

	// auto init
	$('.handshake').handshake();
});