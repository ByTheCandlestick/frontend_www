$( document ).ready(function() {
	// -----========== Dark mode toggle ==========----- //
		var modeSwitch = $('.mode-switch');
		modeSwitch.click(function () {
			$( document ).toggleClass('dark');
			modeSwitch.toggleClass('active');
		});
	// -----========== PRELOADER ==========----- //
	$('.app-preloader').fadeOut()
});