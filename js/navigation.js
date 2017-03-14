/**
 * File navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus
 *
 */
var slnmBaseNavigation = (function ($) {

	var buttons, button, menus, menu, mainMenu, subMenu;

	function setupNavigation() {

		// Gather the (sub)menu toggle buttons and (sub)menus
		buttons = $('.mainNavigation--toggle, .mainNavigation--subMenuToggle');
		menus = $('.mainNavigation--menu, .mainNavigation--subMenu');

		// bind the click event to the menu and submenu buttons
		buttons.on('click', function (e) {
			e.preventDefault();

			// set the clicked button as active
			button = $(this);
			button.toggleClass('is-active');
			// get the menu corresponding to the clicked button
			menu = button.next('ul');
			// set the navigation state to the clicked button and corresponding menu
			setNavigationState(button, menu);

		});

		// When a menu link is clicked close the menu and reset the state
		$('a', mainMenu).on('click', function () {
			buttons.removeClass('is-active');
			setNavigationState(button, menus);
		});

		// When a menu link is focused or blurred, toggle the focus class for accessibility
		$('a', mainMenu).on('focus blur', function () {
			$('li', mainMenu).removeClass('focus');
			$(this).parent('li').addClass('focus');
		});

		// Mark submenu parents as 'aria-haspopup'
		subMenu = $('.mainNavigation--subMenu');
		subMenu.each(function (index, el) {
			$(el).parent().attr('aria-haspopup', 'true');
		});

		// Close menu and reset state when clicked outside of menu
		// Using a class instead of id so it still works when the menu is cloned to other sections
		$(document).on('click', function (e) {
			if (!$(e.target).closest('.mainNavigation').length) {
				if (buttons.hasClass('is-active')) {
					buttons.removeClass('is-active');
					setNavigationState(button, menus);
				}
			}
		});

	}

	// Set the state for a menu or a submenu
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

	function init() {
		setupNavigation();
	}

	return {
		init: init
	};

})(jQuery);
