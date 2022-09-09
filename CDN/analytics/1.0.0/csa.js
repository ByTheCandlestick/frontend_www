import { init, loadTime } from "./framework.js";

init();
var pageRequested = Date.now();
$(document).ready(function() {
	console.log("Time until DOMready: ", Date.now() - pageRequested);
});
$(window).load(function() {
	console.log("Time until everything loaded: ", Date.now()-pageRequested);
});