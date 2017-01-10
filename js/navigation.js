/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function ($) {

	var button, menu, subMenus;

	function setupNavigation() {

		button = $('.mainNavigation--toggle, .mainNavigation--subMenuToggle');

		button.on('click', function (e) {
			e.preventDefault();
			button = $(this);
			button.toggleClass('is-active');
			menu = button.next('ul');
			setNavigationState(button, menu);

			// bind event handlers to the links
			$('a', menu).on('click', function () {
				button.toggleClass('is-active');
				setNavigationState(button, menu);
			});

			// Each time a menu link is focused or blurred, toggle focus.
			$('a', menu).on('focus blur', function () {
				$('li', menu).removeClass('focus');
				$(this).parent('li').addClass('focus');
			});

		});

		// Setup sub menus
		subMenus = $('.mainNavigation--subMenu');
		subMenus.each(function (index, el) {
			$(el).parent().attr('aria-haspopup', 'true');
		});

	}

	function setNavigationState(button, menu) {
		if (button.hasClass('is-active')) {
			button.attr('aria-expanded', 'true');
			menu.attr('aria-expanded', 'true');
			menu.addClass('is-active');
		} else {
			button.attr('aria-expanded', 'false');
			menu.attr('aria-expanded', 'false');
			menu.removeClass('is-active');
		}
	}

	setupNavigation();


})(jQuery);
