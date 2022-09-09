//import * as tti from "./vendors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	console.log("Dom loaded in "+(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.connectStart)+"ms");
}
