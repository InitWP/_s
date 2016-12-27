/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
var hhvpNavigation = (function ($) {

	var container, button, menu, links, subMenus;

	function setupNavigation() {
		button = $('.mainNavigation--toggle');

		button.on('click', function () {
			console.log('click');
			button = $(this);
			container = $(this).parent('.mainNavigation');
			menu = $('.mainNavigation--menu', container);
			if (container.hasClass('toggled')) {
				container.removeClass(' toggled');
				button.attr('aria-expanded', 'false');
				menu.attr('aria-expanded', 'false');
			} else {
				container.addClass('toggled');
				button.attr('aria-expanded', 'true');
				menu.attr('aria-expanded', 'true');
			}

			// Get all the link elements within the menu.
			links = $('a', menu);
			subMenus = $('ul', menu);

			// bind event handlers to the links
			links.each(function (index, el) {
				$(el).on('click', function () {
					container.removeClass('toggled');
					button.attr('aria-expanded', 'false');
					menu.attr('aria-expanded', 'false');
				});
				// Each time a menu link is focused or blurred, toggle focus.
				$(el).on('focus blur', function () {
					toggleFocus(this);
				});
			});

			// Set menu items with submenus to aria-haspopup="true".
			subMenus.each(function (index, el) {
				$(el).parent().attr('aria-haspopup', 'true');
			});
		});

	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus(el) {
		// Move up through the ancestors of the current link until we hit .nav-menu.
		$(el).parentsUntil($('.mainNavigation--menu'), 'li').map(function () {
			if ($(this).hasClass('focus')) {
				$(this).removeClass('focus');
			} else {
				$(this).addClass('focus');
			}
		});

	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	(function (container) {
		var touchStartFn, i,
			parentLink = $('.menu-item-has-children > a, .page_item_has_children > a', container);

		if ('ontouchstart' in window) {
			touchStartFn = function (e) {
				var menuItem = this.parentNode,
					i;

				if (!menuItem.classList.contains('focus')) {
					e.preventDefault();
					for (i = 0; i < menuItem.parentNode.children.length; ++i) {
						if (menuItem === menuItem.parentNode.children[i]) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove('focus');
					}
					menuItem.classList.add('focus');
				} else {
					menuItem.classList.remove('focus');
				}
			};

			for (i = 0; i < parentLink.length; ++i) {
				parentLink[i].addEventListener('touchstart', touchStartFn, false);
			}
		}
	}(container));

	function init() {
		setupNavigation();
	}

	return {
		init: init
	};

})(jQuery);
