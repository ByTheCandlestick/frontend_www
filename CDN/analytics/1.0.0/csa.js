import { fw } from "./framework.js";

fw.init()

window.onload = function () {
	fw.vars.timing.navigationStart = window.performance.timing.navigationStart;
	fw.vars.timing.domainLookupStart = window.performance.timing.domainLookupStart;
	fw.vars.timing.domainLookupEnd = window.performance.timing.domainLookupEnd;
	fw.vars.timing.domInteractive = window.performance.timing.domInteractive;
	fw.vars.timing.domContentLoadedEventEnd = window.performance.timing.domContentLoadedEventEnd;
	fw.vars.timing.domComplete = window.performance.timing.domComplete;
	fw.vars.timing.complete = Date.now();

	console.log("Domain lookup took "+fw.funcs.ms_to_hms(fw.vars.timing.domainLookupEnd - fw.vars.timing.domainLookupStart));
	console.log("DOM interactive in "+fw.funcs.ms_to_hms(fw.vars.timing.domInteractive - fw.vars.timing.navigationStart));
	console.log("DOM loaded in "+fw.funcs.ms_to_hms(fw.vars.timing.domContentLoadedEventEnd - fw.vars.timing.navigationStart));
	console.log("DOM complete in "+fw.funcs.ms_to_hms(fw.vars.timing.domComplete - fw.vars.timing.navigationStart));
	console.log("Fulliy loaded in "+fw.funcs.ms_to_hms(fw.vars.timing.complete - fw.vars.timing.navigationStart));
}
window.onbeforeunload = function(){
	var end = window.performance.now();
	console.log(`Execution time: ${end - start} ms`);
	return 'Are you sure you want to leave?';
};