
$(document).ready(function () {
	// -----========== VARIABLES ==========----- //
		const api_url = window.location.protocol + "//api." + window.location.hostname.slice(6) + "/v1";
		const api_key = "iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3";
	// -----========== Slick ==========----- //
		$('#topbar').slick({
			dots: false,
			arrows: false,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 3000,
		});
	// -----========== Back to top button ==========----- //
		let backtotop = $('.back-to-top')
		if (backtotop) {
			const toggleBacktotop = () => {
				if (window.scrollY > 100) {
					backtotop.addClass('active')
				} else {
					backtotop.removeClass('active')
				}
			}
			window.addEventListener('load', toggleBacktotop)
			$(document).scroll(toggleBacktotop);
		}
	// -----========== Scroll offset ==========----- //
		$('.scrollto').on('click', function(e) {
			if ($(this.hash)) {
				e.preventDefault()
				let navbar = $('.navbar')
				if (navbar.hasClass('navbar-mobile')) {
					navbar.removeClass('navbar-mobile')
					let navbarToggle = $('.mobile-nav-toggle')
					navbarToggle.toggleClass('fa-bars')
					navbarToggle.toggleClass('fa-times')
				}
				scrollto(this.hash)
			}
		})
		$(window).on('load', function() {
			if(window.location.hash) {
				if($(window.location.hash)) {
					$([document.documentElement, document.body]).animate({
						scrollTop: $(window.location.hash).offset().top - 70
					}, 2000);
				}
			}
		});
	// -----========== Header fixed to top on scroll ==========----- //
		if (selectHeader = $('.navbar')) {
			let headerOffset = selectHeader.offset().top
			let nextElement = selectHeader.next()
			const headerFixed = () => {
				if ((headerOffset - window.scrollY) <= 0) {
					selectHeader.addClass('fixed-top')
					nextElement.addClass('scrolled-offset')
				} else {
					selectHeader.removeClass('fixed-top')
					nextElement.removeClass('scrolled-offset')
				}
			}
			window.addEventListener('load', headerFixed)
			$(document).scroll(headerFixed)
		}
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
	// -----========== PRELOADER ==========----- //
		$(window).bind('beforeunload', function() {
			$('.preloader-container').fadeIn();
		});
		$('.preloader-container').fadeOut();
	// -----========== TOOL TIPS ==========----- //
		//$('[data-toggle="tooltip"]').tooltip();
});
