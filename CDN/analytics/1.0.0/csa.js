import * as fw from "./framework.js";

fw.init();

window.onload = function () {
    var DOMloadTime = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;
	var FINloadTime = window.performance.timing.navigationStart-window.performance.timing.loadEventEnd;
    console.log('Page load time is '+ DOMloadTime);
    console.log('Page load time is '+ FINloadTime);
}
