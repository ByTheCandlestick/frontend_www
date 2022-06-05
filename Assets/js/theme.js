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
});
function printData(Arr) {
	for(var i=0; i<Arr.length; i++) {
		searchSuggestions.html(searchSuggestions.html() + Arr[i].name + " code: " + Arr[i].code + "<br>");
	}
}

function search(ev) {
	var key = ev.target.value;
	searchSuggestions.html("");
	
	printData(jsonData.filter((data)=>{
		var regex = new RegExp(key, "i");
		return data.name.match(regex) || data.code.match(regex);
	}));
}