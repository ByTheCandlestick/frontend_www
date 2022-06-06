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
	// -----========== Nestled functions ==========----- //
	website = {
		save: function() {
			alert("TODO: Save");
		}
	};
	search = {
		suggestions: $(".search-suggestions"),
		jsonData: $.get('/Assets/search.json'),
		process: function(ev) {
			var key = ev.target.value;
			search.suggestions.html("");
			
			search.print(search.jsonData.filter((data)=>{
				var regex = new RegExp(key, "i");
				return data.name.match(regex) || data.desc.match(regex) || data.url.match(regex);
			}));
		},
		print: function(Arr) {
			for(var i=0; i<Arr.length; i++) {
				search.suggestions.html(search.suggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
			}
		}
	}
	console.log(search.jsonData)
	console.log(search.jsonData[0])
	console.log(search.jsonData.responseJSON())
	console.log(search.jsonData.responseJSON)
});