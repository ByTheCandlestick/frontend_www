function init() {
	console.log('analytics initializing');
}
pageRequested = Date.now();
function loadTime() {
	console.log(Date.now() - pageRequested);
}
export {
	init,
	loadTime,
};