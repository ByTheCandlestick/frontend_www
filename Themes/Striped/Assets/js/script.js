
$(document).ready(function () {
	var $window = $(window),
		$body = $("body"),
		$document = $(document);

	// Nav.

	// Height hack.
	var $sc = $("#sidebar, #content"),
		tid;

	$window
		.on("resize", function () {
			window.clearTimeout(tid);
			tid = window.setTimeout(function () {
				$sc.css("min-height", $document.height());
			}, 100);
		})
		.on("load", function () {
			$window.trigger("resize");
		})
		.trigger("resize");

	// Title Bar.
	$(
		'<div id="titleBar">' +
			'<a href="#sidebar" class="toggle"></a>' +
			'<span class="title">' +
			$("#logo").html() +
			"</span>" +
			"</div>"
	).appendTo($body);

	// -----========== VARIABLES ==========----- //
	const api_url =
		window.location.protocol +
		"//api." +
		window.location.hostname.slice(6) +
		"/v1";
	const api_key =
		"iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3";
	// -----========== Nestled functions ==========----- //
	// -----========== Dark mode toggle ==========----- //
	// -----========== Search ==========----- //
/*		$(".search-area input").focusout(function () {
			if (search.suggestions.filter(":hover").length === 0) {
				search.suggestions.hide();
			}
		});
		$(".search-area input").focusin(function () {
			search.suggestions.show();
		});
		$.get($(".search-wrapper").attr("rel"), function (data) {
			search.jsonData = data;
		});
*/
	// -----========== MENU BTN ==========----- //
		$(".app-icon").click(function () {
			$(".app-sidebar").toggleClass("sidebar-show");
		});
	// -----========== PRELOADER ==========----- //
		$(window).bind('beforeunload', function() {
			$('.preloader-container').fadeIn();
		});
		$('.preloader-container').fadeOut();
	// -----========== TOOL TIPS ==========----- //
//	$('[data-toggle="tooltip"]').tooltip();
});
