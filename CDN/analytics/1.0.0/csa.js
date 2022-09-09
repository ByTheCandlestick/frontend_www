import * as fw from "./framework.js";

fw.init();


$( document ).ready(() => {
	console.log("Time until DOMready: ", Date.now() - pageRequested);
});
window.onload = function () {
    var loadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart; 
    console.log('Page load time is '+ loadTime);
}
