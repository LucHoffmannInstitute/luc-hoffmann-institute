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
		handshakeMessageSelector: '.Handshake-message',
		handshakeInnerClass: 'Handshake-message-inner',
		handshakeItemActiveClass: 'Handshake--active',
		menuItemSelector: '.menu a',
		messageDataAttribute: 'description',
		animateInClass: 'Handshake--animate-in',
		animateOutClass: 'Handshake--animate-out'
	};

	Handshake.prototype.init = function ( options ) {
		var _this = this;

		this.options = $.extend( true, {}, this.settings, options, this.$el.data('slider') );

		this.$handshakeMessage = $( this.options.handshakeMessageSelector );
		this.$menuItems = $( this.options.menuItemSelector );

		// handle interactions
		this.interactions();
	};

	/**
	 * Handle interactions
	 */
	Handshake.prototype.interactions = function () {
		var _this = this;

		this.$menuItems.on( 'mouseenter', function () {
			var message = $(this).data( _this.options.messageDataAttribute );
			_this.addMessage( message );
		} );
	};

	/**
	 * Add handshake message
	 */
	Handshake.prototype.addMessage = function ( msg ) {
		var _this = this;
		var $msg = '<span class="' + this.options.handshakeInnerClass + '">' + msg + '</span>';
		this.$handshakeMessage.html( $msg );
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
	$('.Handshake').handshake();
});