import * as tti from "./vandors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	console.log(window.performance.timing);
    var DOMloadTime = window.performance.timing.domContentLoadedEventStart-window.performance.timing.navigationStart;
	var FINloadTime = window.performance.timing.connectStart-window.performance.timing.navigationStart;
    console.log('Page load time is '+ DOMloadTime);
    console.log('Page load time is '+ FINloadTime);
}
