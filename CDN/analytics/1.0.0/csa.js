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

	console.log("Domain lookup took "+funcs.ms_to_hms(fw.DOMlookup()));
	console.log("DOM interactive in "+funcs.ms_to_hms(fw.DOMinteractive()));
	console.log("DOM loaded in "+funcs.ms_to_hms(fw.DOMloaded()));
	console.log("DOM complete in "+funcs.ms_to_hms(fw.DOMcomplete()));
	console.log("Fulliy loaded in "+funcs.ms_to_hms(fw.Complete()));
}
window.onbeforeunload = function(){
	myfun();
	return 'Are you sure you want to leave?'
};
function myfun(){
	var end = window.performance.now();
	console.log(`Execution time: ${end - start} ms`);
}