'use strict';

var Tabs = function () {};

Tabs.prototype = {
	$el: $('.Tabs'),
	$menu: $('.Tabs-menu'),
	$menuItem: $('.Tabs-menu-item'),
	$tabs: $('.Tab'),
	tabActiveClass: 'Tab--active',
	menuItemActiveClass: 'Tabs-menu-item--active'
};

/**
 * Intialization
 */
Tabs.prototype.init = function () {

	// set up tabs
	this.setup();

	// handle interactions
	this.interactions();
};

/**
 * Setup
 */
Tabs.prototype.setup = function () {

	// activate first tab
	this.activate(0);
};

/**
 * Activate tab by index
 */
Tabs.prototype.activate = function ( index ) {

	// remove active class from menu items
	this.$menuItem.removeClass( this.menuItemActiveClass );

	// remove active class from tabs
	this.$tabs.removeClass( this.tabActiveClass );

	// add active class to menu item
	this.$menuItem.eq(index).addClass( this.menuItemActiveClass );

	// add active class to tab
	this.$tabs.eq(index).addClass( this.tabActiveClass );

};

/**
 * Handle interactions
 */
Tabs.prototype.interactions = function () {
	var _this = this;

	this.$menuItem.on( 'click', function (event) {
		event.preventDefault();

		_this.activate( $(this).index() );
	} );
};

module.exports = new Tabs();