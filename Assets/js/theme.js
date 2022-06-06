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
		if($(".search-suggestions *").not(":hover")) {
			$(".search-suggestions").hide();
		}
	});
	$(".search-area input").focusin( function(){
		$(".search-suggestions").show();
	});
	// -----========== Nestled functions ==========----- //
	website = {
		save: function() {
			alert("TODO: Save");
		}
	};
	search = {
		searchSuggestions: $(".search-suggestions"),
		jsonData: $.get('/Assets/search.json', function(data) { return data; }),
		process: function(ev) {
			var key = ev.target.value;
			searchSuggestions.html("");
			
			search.print(jsonData.filter((data)=>{
				var regex = new RegExp(key, "i");
				return data.name.match(regex) || data.desc.match(regex) || data.url.match(regex);
			}));
		},
		print: function(Arr) {
			for(var i=0; i<Arr.length; i++) {
				searchSuggestions.html(searchSuggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
			}
		}
	}
});