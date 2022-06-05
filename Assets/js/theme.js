var searchSuggestions, jsonData;
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
	searchSuggestions = $(".search-suggestions");
	$.get('/Assets/search.json', function(data) {
		jsonData = data;
	});
	$(".search-area input").focus(
		function(){
			$(".search-suggestions").show();
		},
		function(){
			$(".search-suggestions").hide();
		}
	);
});

function search(ev) {
	var key = ev.target.value;
	searchSuggestions.html("");
	
	printData(jsonData.filter((data)=>{
		var regex = new RegExp(key, "i");
		return data.name.match(regex) || data.desc.match(regex) || data.url.match(regex);
	}));
}
function printData(Arr) {
	for(var i=0; i<Arr.length; i++) {
		searchSuggestions.html(searchSuggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
	}
}