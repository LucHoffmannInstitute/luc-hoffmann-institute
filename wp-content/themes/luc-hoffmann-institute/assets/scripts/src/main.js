jQuery(function () {
	'use strict';

	// sticky menu
	// fittext needs to fire before this
//	setTimeout( function () {
//		$('.menu').stickymenu();
//	}, 100 );

	// expand profile bios
	$('.profile').expandProfile();

	// fittext for home page handshake
//	if ( $('.handshake').length ) {
//		window.fitText( $('.handshake'), 1.9 );
//	}

	// handle royalslider for home page
	$('.projects-slider').projectsSlider();

	// skrollr for banners
	//var s = skrollr.init();

	// fitvids for videos
	$('.entry').fitVids();

	// handle menu expand button
	$('.show-menu').showMenu();

	// handshake animations
	$('.handshake').handshakeAnimations();

});

(function(window, $, undefined) {
	'use strict';

	var requestAnimationFrame = window.requestAnimationFrame ||
															window.mozRequestAnimationFrame ||
															window.webkitRequestAnimationFrame ||
															window.msRequestAnimationFrame;
	window.requestAnimationFrame = requestAnimationFrame;

	/**
	 * Show menu
	 */
	$.fn.showMenu = function () {
		var $showMenuButton = $(this),
			$menu = $('.menu');

		$showMenuButton.on( 'click', function ( event ) {
			event.preventDefault();
			//$('body').toggleClass('show-menu');
		} );
	};

	/**
	 * Sticky menu on scroll
	 */
	$.fn.stickymenu = function () {

		var $menu = $(this),
				winHeight = $(window).height(),
				scrollTop = $(window).scrollTop(),
				menuPos = $menu.offset().top,
				$body = $('body');

		$(window).on( 'scroll', function () {
			requestAnimationFrame( onScroll );
		} );

		$(window).on( 'debouncedresize', function () {
			winHeight = $(window).height();
		} );

		function onScroll() {
			scrollTop = $(window).scrollTop();

			// stick menu to top
			if ( scrollTop > menuPos ) {
				stickMenu();
			} else {
				unstickMenu();
			}
		}

		function stickMenu() {
			// add padding to top of body to account for menu height
			$body.css('padding-top', $menu.outerHeight());

			// fix menu to top
			$body.addClass('menu-fixed');
		}

		function unstickMenu() {
			$body.css('padding-top', 0);
			$body.removeClass('menu-fixed');
		}
	};

	/**
	 * Handshake animations
	 */
	$.fn.handshakeAnimations = function () {

		var $handshake = $(this),
			$items = $handshake.find('.handshake-item'),
			delay = 4000,
			$activeItem,
			$nextItem;

		function fadeIn() {
			$activeItem = $items.filter('.fadeUpAndIn');
			$nextItem = $activeItem.next();
			$nextItem = $nextItem.length ? $nextItem : $items.first();

			$activeItem.removeClass('fadeUpAndIn');
			$activeItem.addClass('fadeUpAndOut');

			$nextItem.removeClass('fadeUpAndOut');
			$nextItem.addClass('fadeUpAndIn');
		}

		setInterval( function () {
			fadeIn();
		}, delay );

	};

	/**
	 * Expand profile bios
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

	/**
	 * Handle RoyalSlider for home page
	 */
	$.fn.projectsSlider = function () {

		var $slider = $(this),
			$prev = $('.projects-arrows').find('.prev'),
			$next = $('.projects-arrows').find('.next');

		var opts = {
			arrowsNav: false
		};

		// initialiaze royalslider
		$slider.royalSlider( opts );

		var rsInstance = $slider.data('royalSlider');

		// handle arrows
		$prev.on( 'click', function ( ev ) {
			ev.preventDefault();
			$slider.royalSlider('prev');
		} );

		$next.on( 'click', function ( ev ) {
			ev.preventDefault();
			$slider.royalSlider('next');
		} );

	};
	

})(window, jQuery);