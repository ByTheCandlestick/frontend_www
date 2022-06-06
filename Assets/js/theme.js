$( document ).ready(function() {
	// -----========== Dark mode toggle ==========----- //
		var modeSwitch	= $('.mode-switch');
		var root		= $('html');
		modeSwitch.click(function () {
			root.toggleClass('dark');
			modeSwitch.toggleClass('active');
		});
	// -----========== PRELOADER ==========----- //
	$('.app-preloader').fadeOut()
	// -----========== Search ==========----- //
	$(".search-area input").focusout( function(){
		if(search.suggestions.filter(":hover").length === 0) {
			search.suggestions.hide();
		}
	});
	$(".search-area input").focusin( function(){
		search.suggestions.show();
	});
	$.get('/Assets/search.json', function(data){
		search.jsonData = data
	})
	// -----========== Nestled functions ==========----- //
	website = {
		save: function() {
			var styles, scripts = [];
			$("div[name=styles]").find("input[type=checkbox]:checked").each(function(index, element) {
				console.log(element);
			});
			$("div[name=scripts]").find("input[type=checkbox]:checked").each(function(index, element) {
				console.log(element);
			});
			console.log(styles)
		}
	};
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
		}
	}
});