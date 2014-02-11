/**
 * ProjectList
 */
define([
], function () {
	'use strict';

	var ProjectList = function ( element, options ) {
		this.$el = element;
	//	this.init( options );
	};

	/**
	 * Settings
	 */
	ProjectList.prototype.settings = {
		itemSelector: '.Projects-list-item',
		itemInnerSelector: '.Projects-list-item-inner',
		itemHiddenClass: 'Projects-list-item--hidden'
	};

	/**
	 * Intialization
	 */
	ProjectList.prototype.init = function ( options ) {
		this.options = $.extend( true, {}, this.settings, options );

		this.$items = this.$el.find( this.options.itemSelector );

		// handle item selection
		this.itemSelection();
	};

	/**
	 * Handle item selection
	 */
	ProjectList.prototype.itemSelection = function () {
		var _this = this;

		this.$items.on( 'click', this.options.itemInnerSelector, function ( event ) {
			event.preventDefault();

			_this.loadProject( $(this).attr('href') );
		} );
	};

	/**
	 * Load a project
	 */
	ProjectList.prototype.loadProject = function ( url ) {
		var _this = this;

		// hide items
		this.hideItems();

		this.$el.load( url + ' #Single-project-ajax-container', function () {
			
		} );

	};

	/**
	 * Hide items
	 */
	ProjectList.prototype.hideItems = function () {
		this.$items.addClass( this.options.itemHiddenClass );
	};



	/**
	 * jQuery plugin
	 */
	$.fn.projectlist = function ( options ) {
		return this.each( function () {
			new ProjectList( $(this), options );
		} );
	};

	// auto init
	$('.Projects-list').projectlist();
});