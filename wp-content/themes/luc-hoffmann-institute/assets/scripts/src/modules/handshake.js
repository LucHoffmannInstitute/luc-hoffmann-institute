'use strict';

var Handshake = function () {};

/**
 * Settings
 */
Handshake.prototype.settings = {
	elSelector: '.Handshake',
	animateElSelector: '.Handshake-inner',
	msgSelector: '.Handshake-message',
	menuItemsSelector: '.Menu a',
	menuDataAttribute: 'description',
	animateInClass: 'Handshake-inner--animate-in',
	animateOutClass: 'Handshake-inner--animate-out'
};

/**
 * Intialization
 */
Handshake.prototype.init = function ( options ) {
	this.options = $.extend( true, {}, this.settings, options );

	this.$el = $( this.options.elSelector );
	this.$animateEl = $( this.options.animateElSelector );
	this.$menuItems = $( this.options.menuItemsSelector );
	this.$currentMsg = $();
	this.currentIndex = null;

	// add all messages to handshake container
	this.addMessages();

	// handle menu interactions
	this.interactions();
};

/**
 * Add all messages to handshake container
 */
Handshake.prototype.addMessages = function () {
	var _this = this,
		firstIndex;

	$.each( this.$menuItems, function ( index ) {
		var msg = $(this).data( _this.options.menuDataAttribute ),
			$msg;

		if ( msg === undefined ) {
			return;
		}

		// set first index
		if ( firstIndex === undefined ) {
			firstIndex = index;
		}

		// clone first message and add message text
		$msg = _this.$animateEl.clone();
		$msg.find( _this.options.msgSelector ).text( msg );

		// keep track of menu item association
		$msg.data('menu-item', index);
		$(this).data('menu-item', index);

		// append message to message container
		_this.$el.append( $msg );

	} );

	// activate first item
	this.activate( firstIndex );
};

/**
 * Handle menu interactions
 */
Handshake.prototype.interactions = function () {
	var _this = this;

	this.$menuItems.on( 'mouseenter', function () {
		var index = $(this).data('menu-item');
		_this.activate( index );
	} );
};

/**
 * Activate message
 */
Handshake.prototype.activate = function ( index ) {
	var _this = this,
		$currentMsg,
		$newMsg;

	if ( index === this.currentIndex ) {
		return;
	}

	$newMsg = this.$el.find( this.options.animateElSelector ).filter( function () {
		if ( $(this).data( 'menu-item' ) === index ) { return true; }
	} );

	// animate out current message
	this.$currentMsg.removeClass( this.options.animateInClass );
	this.$currentMsg.addClass( this.options.animateOutClass );

	// animate in new item
	$newMsg.removeClass( this.options.animateOutClass );
	$newMsg.addClass( this.options.animateInClass );

	this.$currentMsg = $newMsg;
	this.currentIndex = index;
};

/**
 * Update handshake message
 */
Handshake.prototype.updateMsg = function ( msg ) {
	var _this = this;

	// clone first message into $msg object
	var	$msg = this.$animateEl.clone();

	// insert new msg into $msg object
	$msg.find( this.options.msgSelector ).text( msg );

	// deactivate current message
	this.$el.find( this.options.animateElSelector ).removeClass( this.options.animateOutClass );

	// 

	$msg.prependTo( this.$el );
	$msg.addClass( this.options.animateInClass );
};

module.exports = new Handshake();