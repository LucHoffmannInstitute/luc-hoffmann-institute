require.config({
	paths: {
		getStyleProperty: '../bower_components/get-style-property/get-style-property',
		smartResize: '../bower_components/jquery-smartresize/jquery.debouncedresize',
		fitText: '../bower_components/fittext/fittext',
		skrollr: '../bower_components/skrollr/src/skrollr',
		fitVids: '../bower_components/fitvids/jquery.fitvids',
		//salvattore: '../bower_components/salvattore/dist/salvattore',
		royalSlider: '../assets/vendor/royalslider/dev/jquery.royalslider',
		slider: '../assets/scripts/src/modules/slider',
		handshake: '../assets/scripts/src/modules/handshake',
		projects: '../assets/scripts/src/modules/projects'
	}
});

define([
	'fitVids',
	'slider',
	//'projects',
	//'salvattore',
	'handshake'
], function () {
	'use strict';

	/**
	 * FitVids
	 */
	$('.entry').fitVids();

	/**
	 * Expand bio profiles
	 */
	$.fn.expandProfile = function () {
		return this.each( function () {

			var $link = $(this).find('.show-profile-content'),
				$content = $(this).find('.profile-content');

			$link.on( 'click', function ( ev ) {
				ev.preventDefault();
				$content.toggleClass('inactive');
				if ( $content.hasClass('inactive') ) {
					$link.text('Show details');
				} else {
					$link.text('Hide details');
				}
			} );

		} );
	};
	$('.profile').expandProfile();
});