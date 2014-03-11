'use strict';

var Profiles = function () {};

Profiles.prototype = {
	$el: $('.profile'),
	linkSelector: '.show-profile-content',
	contentSelector: '.profile-content',
	inactiveClass: 'inactive',
	showDetailsText: 'Show details',
	hideDetailsText: 'Hide details'
};

/**
 * Intialization
 */
Profiles.prototype.init = function () {
	var _this = this;

	$.each( this.$el, function () {

		var $link = $(this).find( _this.linkSelector ),
			$content = $(this).find( _this.contentSelector );

		$link.on( 'click', function ( event ) {
			event.preventDefault();

			$content.toggleClass( _this.inactiveClass );

			if ( $content.hasClass( _this.inactiveClass ) ) {
				$link.text( _this.showDetailsText );
			} else {
				$link.text( _this.hideDetailsText );
			}
		} );

	} );

};

module.exports = new Profiles();