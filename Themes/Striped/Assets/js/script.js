
$(document).ready(function () {
	// -----========== VARIABLES ==========----- //
		const api_url = window.location.protocol + "//api." + window.location.hostname.slice(6) + "/v1";
		const api_key = "iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3";
	// -----========== Nestled functions ==========----- //
		search = {
			suggestions: $(".search-suggestions"),
			jsonData: null,
			process: function(ev) {
				if(ev.key == 'Enter'){
					var location = $(search.suggestions.children()[0]).find("a").attr("href");
					if(location !== undefined) {
						window.location = location;
					}
				} else {
					var key = ev.target.value;
					search.suggestions.html("");
					
					search.dispaySuggestions(search.jsonData.filter((data)=>{
						var regex = new RegExp(key, "i");
						return data.name.match(regex) || data.desc.match(regex) || data.url.match(regex);
					}));
				}
			},
			dispaySuggestions: function(Arr) {
				for(var i=0; i<Arr.length; i++) {
					search.suggestions.html(search.suggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
				}
			},
		}
	// -----========== Sidebar ==========----- //
		$('.titleBar .toggle').click(function() {
			$('.sidebar').addClass('open');
		});
		$('.sidebar .close').click(function(){
			$('.sidebar').removeClass('open');
		});
	// -----========== Search ==========----- //
		$(".search-area input").focusout( function(){
			if(search.suggestions.filter(":hover").length === 0) {
				search.suggestions.hide();
			}
		});
		$(".search-area input").focusin( function(){
			search.suggestions.show();
		});
		$.get($('.search-wrapper').attr('rel'), function(data){
			search.jsonData = data
		})
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
		//$('[data-toggle="tooltip"]').tooltip();
});
