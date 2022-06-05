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
});

var data = [{}];
var logTime = {};

function searchEngine(searchString, searchKey, searchData) {
	logTime.start = Date.now();
	var result = [];

	$.each(searchData, function(i, item) {
		console.log(this[searchKey].indexOf(searchString));
		if (this[searchKey].toLowerCase().indexOf(searchString) > 0) {
			result.push(item);
		}

	});
	//isotopeInit();
	return result;
};

var source = $("#results").html();
var template = Handlebars.compile(source);

$("#searchText, #searchField").on("change paste keyup", function() {
	var searchText = $("#searchText").val().toLowerCase();
	var searchField = $("#searchField").val();
	console.log(searchField);
	//console.log(searchEngine(searchText,'name',data));
	var searchResult = searchEngine(searchText, searchField, data)
	var html = template(searchResult);

	$("#output").html(html);
	var execTime = Date.now() - logTime.start;
	logTime.start = 0;
	$("#output").prepend("Search took " + execTime + "ms and returned " + searchResult.length + " result. </ br> No. of records " + data.length);
});

// $(".sort").click(function(){
// 	var sort = $(this).data("sort");
// 	tinysort("#output>.row",{
// 		data: $(this).data("sort")
// 	}).forEach(function(i){
// 		console.log(i);
// 		console.log(this);
// 	});
// });

var $results = $('#output').isotope({
	itemSelector: '.sort-item'
});

$('button.sort').click(function() {
	var filterValue = $(this).data(filter);
	$results.isotope({
		filter: filterValue
		
	});
});