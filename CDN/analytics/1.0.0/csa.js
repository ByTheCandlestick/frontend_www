//import * as tti from "./vendors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	console.log(window.performance.timing);
	console.log("Dom loaded in "+(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.requestStart)+"ms");
	console.log("Fully loaded in "+(window.performance.timing.responseEnd - window.performance.timing.requestStart)+"ms");
}
