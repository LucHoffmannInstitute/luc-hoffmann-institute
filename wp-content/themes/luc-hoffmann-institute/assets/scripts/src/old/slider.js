/**
 * Home page slider
 */
define([
	'royalSlider'
], function () {
	'use strict';

	var Slider = function ( element, options ) {
		this.$el = element;
		this.init( options );
	};

	Slider.prototype = {
	};

	Slider.prototype.settings = {
		arrowPrevSelector: '.projects-arrows .prev',
		arrowNextSelector: '.projects-arrows .next',
		sliderOpts: {
			arrowsNav: false
		}
	};

	Slider.prototype.init = function ( options ) {
		this.options = $.extend( true, {}, this.settings, options, this.$el.data('slider') );

		// initialize royalslider
		this.initRoyalSlider();

		// handle arrows
		this.handleArrows();
	};

	/**
	 * Initialize RoyalSlider
	 */
	Slider.prototype.initRoyalSlider = function () {
		var _this = this;

		// initialize
		this.$el.royalSlider( this.options.sliderOpts );
	};

	/**
	 * Handle arrows
	 */
	Slider.prototype.handleArrows = function () {
		var _this = this,
			$prev = $( this.options.arrowPrevSelector ),
			$next = $( this.options.arrowNextSelector );

		$prev.on( 'click', function ( event ) {
			event.preventDefault();
			_this.$el.royalSlider('prev');
		} );

		$next.on( 'click', function ( event ) {
			event.preventDefault();
			_this.$el.royalSlider('next');
		} );
	};

	/**
	 * jQuery plugin
	 */
	$.fn.slider = function ( options ) {
		return this.each( function () {
			new Slider( $(this), options );
		} );
	};

	// auto init
	$('.projects-slider').slider();
});