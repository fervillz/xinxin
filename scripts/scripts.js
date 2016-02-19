jQuery( document ).ready( function ( $ ) {
	'use strict';

	/*
	|--------------------------------------------------------------------------
	| Developer mode
	|--------------------------------------------------------------------------
	|
	| Set to true - it will allow printing in the console. Alsways check for this
	| variables when running tests so you dont forget about certain console.logs.
	| Id needed for development testing this variable should be used.
	|
	*/
	var devMode = function() {
		return true;
	};

	/**
	 * Run alert only if devMode is on. This is only for testing purposes, if the
	 * alert is needed use the normal alert().
	 */
	var devAlert = function( string ) {
		if ( devMode() ) {
			alert( devMode() );
		}
	};

	// Disable console.log for production site.
	if ( ! devMode() ) {
		console.log = function() {};

		// This is too much, so maybe keep it commented.
		// console.error = function() {}
	}


	/**
	 * Those will be events like clicking, dragging, scrolling or whatever
	 * that will change afer certain user interaction with the site. Default
	 * changes that are happening whitout the controll of the user should be
	 * in another object. Keep the WordPress coding guidelines for javascript.
	 */
	var scriptRun = (function () {

		/**
		 * Settings. Its ok to use jquery selectors in the functions and not
		 * set them here, but if they are used in more then one function and
		 * can be used as setting (like fixed element height) better to  set
		 * it here.
		 */
		var _s = {};

		/**
		 * Scripts to be run on page load
		 */
		var init = function () {
			beforeBodyOverlay();
		};

		/**
		 * Fire all functions that will be used in the page.
		 */
		var events = function () {
			$('.js-search-trigger').click( openSearchForm );
			$('.js-subscribe-trigger').click( openSubscribeForm );
			$('.overlay-base').click( removeAllVisible );
			$('.summary-label').click( toggleSummary );
		};

		var openSearchForm = function (event) {
			$('.search-form-wrapper').toggleClass('is-visible');
			toggleOverlayBase();
		};

		var openSubscribeForm = function (event) {
			$('.subscribe-form-wrapper').toggleClass('is-visible');
			toggleOverlayBase();
		};

		/**
		 * Removes all is-visible classes
		 */
		var removeAllVisible = function () {
			$('.is-visible').each(function () {
				$(this).removeClass('is-visible');
			});
		};

		var toggleOverlayBase = function () {
			$('.overlay-base').toggleClass('is-visible');
		};

		var toggleSummary = function () {
			$('.summary .author').toggleClass('is-opened');
		};

		/**
		 * This will add HTML Element before the closing body tag, that
		 * will be used for custom popup elements.
		 **/
		var beforeBodyOverlay = function () {
			$( "body" ).append( "<div class='overlay-base'></div>" );
		};

		/**
		 * Call the events.
		 * -> scriptRun.watch();
		 */
		return {
			watch: events,
			run: init
		};

	})();


	scriptRun.run();
	scriptRun.watch();

	$('.entry-slider').owlCarousel({
		loop: true,
		items: 1,
		nav: true,
		autoplay: 1,
		autoplayHoverPause: 1,
		navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"]
	});


	var owl = $(".owl-carousel");

	owl.owlCarousel({
		loop: true,
		responsiveRefreshRate: 1,
		//autoplay:true,
	    autoplayTimeout:5000,
	    autoplayHoverPause:true,
	    responsive:{
	        0:{
	            items:1,
	            nav:true
	        },
	        600:{
	            items:1,
	            nav:true
	        },
	        1000:{
	            items:1,
	            nav:true
	        }
	    },
	 	 margin: 0,
	 	 navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
	});
});