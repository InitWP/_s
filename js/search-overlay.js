/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function ($) {

	function setupSearchOverlay() {
		$('.searchform-toggle').click(function (e) {
			e.preventDefault();
			$('.search-overlay').addClass('show-search');
			setTimeout(function () {
				$('.searchform-container').addClass('show-search');
				$('.search-field').focus();
			}, 200);
		});
		$('.search-overlay').click(function (e) {
			$('.searchform-container, .search-overlay').removeClass('show-search');
		});
	}

	setupSearchOverlay();

})(jQuery);
