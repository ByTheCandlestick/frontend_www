import { fw, vars, funcs } from "./framework.js";

fw.init()

window.onload = function () {
	vars.timing.navigationStart = window.performance.timing.navigationStart;
	vars.timing.domainLookupStart = window.performance.timing.domainLookupStart;
	vars.timing.domainLookupEnd = window.performance.timing.domainLookupEnd;
	vars.timing.domInteractive = window.performance.timing.domInteractive;
	vars.timing.domContentLoadedEventEnd = window.performance.timing.domContentLoadedEventEnd;
	vars.timing.domComplete = window.performance.timing.domComplete;
	vars.timing.complete = Date.now();

	console.log("Domain lookup took "+funcs.ms_to_hms(vars.timing.domainLookupEnd - vars.timing.domainLookupStart));
	console.log("DOM interactive in "+funcs.ms_to_hms(vars.timing.domInteractive - vars.timing.navigationStart));
	console.log("DOM loaded in "+funcs.ms_to_hms(vars.timing.domContentLoadedEventEnd - vars.timing.navigationStart));
	console.log("DOM complete in "+funcs.ms_to_hms(vars.timing.domComplete - vars.timing.navigationStart));
	console.log("Fulliy loaded in "+funcs.ms_to_hms(fw.Complete()));
}
window.onbeforeunload = function(){
	var end = window.performance.now();
	console.log(`Execution time: ${end - start} ms`);
	return alert('Are you sure you want to leave?');
};