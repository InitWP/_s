/**
 * File searchform.js.
 *
 * Handles toggling the searchform overlay for small screens
 *
 */
(function ($) {

	function setupSearchOverlay() {
		$('.searchformToggle').click(function (e) {
			e.preventDefault();
			$('.searchOverlay').addClass('is-active');
			setTimeout(function () {
				$('.searchformContainer').addClass('is-active');
				$('.searchform--searchfield').focus();
			}, 200);
		});
		$('.searchOverlay').click(function (e) {
			$('.searchformContainer, .searchOverlay').removeClass('is-active');
		});
	}

	setupSearchOverlay();

})(jQuery);
