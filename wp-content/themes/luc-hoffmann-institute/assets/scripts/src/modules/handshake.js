'use strict';

var Handshake = function () {};

Handshake.prototype = {
	$el: $('.Handshake'),
	$items: $('.Handshake-item'),
	itemSelector: '.Handshake-item',
	$menuItems: $('.Menu a'),
	msgSelector: '.Handshake-message',
	$currentItem: $(),
	currentIndex: null,
	menuDataAttribute: 'description',
	animateInClass: 'Handshake-item--animate-in',
	animateOutClass: 'Handshake-item--animate-out'
};

/**
 * Intialization
 */
Handshake.prototype.init = function () {

	// exit if csstransitions are not supported
	if ( ! $('html').hasClass('csstransitions') ) {
		return false;
	}

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
		firstIndex,
		items = [];

	$.each( this.$menuItems, function ( index ) {
		var msg = $(this).data( _this.menuDataAttribute ),
			$item;

		if ( msg === undefined ) {
			return;
		}

		// set first index
		if ( firstIndex === undefined ) {
			firstIndex = index;
		}

		// clone first message and add message text
		$item = _this.$items.clone();
		$item.find( _this.msgSelector ).text( msg );

		// keep track of menu item association
		$item.data('menu-item', index);
		$(this).data('menu-item', index);

		// add to items array
		items.push( $item );
	} );

	this.$el.empty();

    console.log(items);

	// append items
	this.$el.append(items);

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
		$currentItem,
		$newItem;

	if ( index === undefined ) {
		return;
	}

	if ( index === this.currentIndex ) {
		return;
	}

	$newItem = this.$el.find( this.itemSelector ).filter( function () {
		if ( $(this).data( 'menu-item' ) === index ) { return true; }
	} );

	// animate out current message
	this.$currentItem.removeClass( this.animateInClass );
	this.$currentItem.addClass( this.animateOutClass );

	// animate in new item
	$newItem.removeClass( this.animateOutClass );
	$newItem.addClass( this.animateInClass );

	this.$currentItem = $newItem;
	this.currentIndex = index;
};

module.exports = new Handshake();