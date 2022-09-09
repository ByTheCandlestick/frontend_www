//import * as tti from "./vendors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	console.log(window.performance.timing);
	
	console.log("Domain lookup took "+fw.convertmilliseconds(window.performance.timing.domainLookupEnd - window.performance.timing.domainLookupStart)+"ms");
	console.log("DOM interactive in "+fw.convertmilliseconds(window.performance.timing.domInteractive - window.performance.timing.navigationStart)+"ms");
	console.log("DOM loaded in "+fw.convertmilliseconds(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart)+"ms");
	console.log("DOM complete in "+fw.convertmilliseconds(window.performance.timing.domComplete - window.performance.timing.navigationStart)+"ms");
	console.log("Fulliy loaded in "+fw.convertmilliseconds(Date.now() - window.performance.timing.navigationStart)+"ms");
}
