//import * as tti from "./vendors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	console.log(window.performance.timing);
	
	console.log("DOM interactive in "+(window.performance.timing.domInteractive - window.performance.timing.navigationStart)+"ms");
	console.log("DOM loaded in "+(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart)+"ms");
	console.log("DOM complete in "+(window.performance.timing.domComplete - window.performance.timing.navigationStart)+"ms");
	console.log("Fulliy loaded in "+(Date.now() - window.performance.timing.navigationStart)+"ms");
}
