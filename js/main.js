/*
	Twenty by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

(function($) {

	skel.breakpoints({
		wide: '(max-width: 1680px)',
		normal: '(max-width: 1280px)',
		narrow: '(max-width: 980px)',
		narrower: '(max-width: 840px)',
		mobile: '(max-width: 736px)'
	});

	$(function() {

		var	$window = $(window),
			$body = $('body'),
			$header = $('#header'),
			$banner = $('#banner');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				$body.removeClass('is-loading');
			});

		// CSS polyfills (IE<9).
			if (skel.vars.IEVersion < 9)
				$(':last-child').addClass('last-child');

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on narrower.
			skel.on('+narrower -narrower', function() {
				$.prioritize(
					'.important\\28 narrower\\29',
					skel.breakpoint('narrower').active
				);
			});

		// Scrolly links.
			$('.scrolly').scrolly({
				speed: 1000,
				offset: -10
			});

		// Dropdowns.
			$('#nav > ul').dropotron({
				mode: 'fade',
				noOpenerFade: true,
				expandMode: (skel.vars.touch ? 'click' : 'hover')
			});

		// Off-Canvas Navigation.

			// Navigation Button.
				$(
					'<div id="navButton">' +
						'<a href="#navPanel" class="toggle"></a>' +
					'</div>'
				)
					.appendTo($body);

			// Navigation Panel.
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').navList() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body)
					.panel({
						delay: 500,
						hideOnClick: true,
						hideOnSwipe: true,
						resetScroll: true,
						resetForms: true,
						side: 'left',
						target: $body,
						visibleClass: 'navPanel-visible'
					});

			// Fix: Remove navPanel transitions on WP<10 (poor/buggy performance).
				if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
					$('#navButton, #navPanel, #page-wrapper')
						.css('transition', 'none');

		// Header.
		// If the header is using "alt" styling and #banner is present, use scrollwatch
		// to revert it back to normal styling once the user scrolls past the banner.
		// Note: This is disabled on mobile devices.
			if (!skel.vars.mobile
			&&	$header.hasClass('alt')
			&&	$banner.length > 0) {

				$window.on('load', function() {

					$banner.scrollwatch({
						delay:		0,
						range:		1,
						anchor:		'top',
						on:			function() { $header.addClass('alt reveal'); },
						off:		function() { $header.removeClass('alt'); }
					});

				});

			}

	});

	$(function(){
		var error_explanation = $("#error_explanation");
		var error_explanation_ul = $("#error_explanation ul");

		$("#data_form").submit(function(){
			var input_array = [$("#title"), $("#author"), $("#date_posted"), $("#blog_text"), $("#article_text"), $("#name"), $("#price"), $("#text"),
			$("#first_name"), $("#last_name"), $("#email"), $("#description"), $("#cost"), $("#qty"), $("#category")];
			var errors = 0;

			jQuery.each(input_array, function(i, val ){
				if(val.val() == "" && val.parent().hasClass("field_with_errors") == false){
					val.parent().addClass("field_with_errors");
					error_explanation_ul.append("<li id='" + i + "'>" + val.prevAll('label').text() + " must not be empty</li>");
					errors += 1;
				}
				else if(val.val() != "" && val.parent().hasClass("field_with_errors")){
					val.parent().removeClass("field_with_errors");
					$("#" + i).remove();
				}
				else if(val.val() == "" && val.parent().hasClass("field_with_errors")){
					errors += 1;
				}

			});

			if( errors > 0){
                error_explanation.show();
				return false;
			}
			else{
                error_explanation.hide();
				return true;
			}
		});

	});


    jQuery(document).ready(function() {
        jQuery("abbr.timeago").timeago();
    });


})(jQuery);