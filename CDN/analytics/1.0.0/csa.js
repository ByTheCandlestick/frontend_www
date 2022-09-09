//import * as tti from "./vendors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	console.log(window.performance.timing);
	
	console.log("Domain lookup took "+fw.convertms(window.performance.timing.domainLookupEnd - window.performance.timing.domainLookupStart)+"ms");
	console.log("DOM interactive in "+fw.convertms(window.performance.timing.domInteractive - window.performance.timing.navigationStart)+"ms");
	console.log("DOM loaded in "+fw.convertms(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart)+"ms");
	console.log("DOM complete in "+fw.convertms(window.performance.timing.domComplete - window.performance.timing.navigationStart)+"ms");
	console.log("Fulliy loaded in "+fw.convertms(Date.now() - window.performance.timing.navigationStart)+"ms");
}
