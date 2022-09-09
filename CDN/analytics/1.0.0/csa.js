import { fw } from "./framework.js";

console.log(fw.init());

window.onload = function () {
	console.log(window.performance.timing);
	fw.vars.initTime = window.performance.timing.navigationStart;
	console.log("Domain lookup took "+fw.funcs.ms_to_hms(window.performance.timing.domainLookupEnd - window.performance.timing.domainLookupStart));
	console.log("DOM interactive in "+fw.funcs.ms_to_hms(window.performance.timing.domInteractive - window.performance.timing.navigationStart));
	console.log("DOM loaded in "+fw.funcs.ms_to_hms(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart));
	console.log("DOM complete in "+fw.funcs.ms_to_hms(window.performance.timing.domComplete - window.performance.timing.navigationStart));
	console.log("Fulliy loaded in "+fw.funcs.ms_to_hms(Date.now() - window.performance.timing.navigationStart));
}
window.onbeforeunload = function(){
	var end = window.performance.now();
	console.log(`Execution time: ${end - start} ms`);
	return 'Are you sure you want to leave?';
};