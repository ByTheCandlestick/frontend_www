function init() {
	console.log('analytics initializing');
}

function loadTime() {
	var pageRequested = Date.now();
	$(document).ready(function() {
		console.log("Time until DOMready: ", Date.now() - pageRequested);
	});
	$(window).load(function() {
		console.log(Date.now() - pageRequested);
	});
}
export {
	init,
	loadTime,
};