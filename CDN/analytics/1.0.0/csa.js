import fw from "./framework.js";

console.log(fw.init());

window.onload = function () {
	console.log(window.performance.timing);
	
	console.log("Domain lookup took "+fw.ms_to_hms(window.performance.timing.domainLookupEnd - window.performance.timing.domainLookupStart));
	console.log("DOM interactive in "+fw.ms_to_hms(window.performance.timing.domInteractive - window.performance.timing.navigationStart));
	console.log("DOM loaded in "+fw.ms_to_hms(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart));
	console.log("DOM complete in "+fw.ms_to_hms(window.performance.timing.domComplete - window.performance.timing.navigationStart));
	console.log("Fulliy loaded in "+fw.ms_to_hms(Date.now() - window.performance.timing.navigationStart));
}
