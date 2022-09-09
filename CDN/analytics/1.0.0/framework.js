function init() {
	console.log('analytics initializing');
}

function loadTime() {
	var pageRequested = Date.now();
	$(document).ready(function() {
		console.log("Time until DOMready: ", Date.now() - pageRequested);
	});
	$(window).load(function() {
		console.log("Time until everything loaded: ", Date.now()-timerStart);
	});
}
export {
	init,
	loadTime,
};