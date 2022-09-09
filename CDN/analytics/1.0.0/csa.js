import * as fw from "./framework.js";

fw.init();

var pageRequested = Date.now();
$( document ).ready(() => {
	console.log("Time until DOMready: ", Date.now() - pageRequested);
});
$( window ).load(() => {
	console.log("Time until loaded: ", Date.now() - pageRequested);
});