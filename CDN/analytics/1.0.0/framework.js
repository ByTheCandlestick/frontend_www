function init() {
	console.log('analytics initializing');
}
pageRequested = Date.now();
funcs = {
	loadTime() {
		console.log(Date.now() - pageRequested);
	}
}
export { init };