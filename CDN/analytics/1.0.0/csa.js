import { fw, vars, funcs, analytics } from "./framework.js";

fw.init()

window.onload = function () {
	vars.timing.navigationStart = window.performance.timing.navigationStart;
	vars.timing.domainLookupStart = window.performance.timing.domainLookupStart;
	vars.timing.domainLookupEnd = window.performance.timing.domainLookupEnd;
	vars.timing.domInteractive = window.performance.timing.domInteractive;
	vars.timing.domContentLoadedEventEnd = window.performance.timing.domContentLoadedEventEnd;
	vars.timing.domComplete = window.performance.timing.domComplete;
	vars.timing.complete = Date.now();

	console.log("Domain lookup took "+funcs.ms_to_hms(analytics.timing.DOMLookup));
	console.log("DOM interactive in "+funcs.ms_to_hms(analytics.timing.DOMInteractive));
	console.log("DOM loaded in "+funcs.ms_to_hms(analytics.timing.DOMLoaded));
	console.log("DOM complete in "+funcs.ms_to_hms(analytics.timing.DOMComplete));
	console.log("Fulliy loaded in "+funcs.ms_to_hms(analytics.timing.Loaded));
}
window.onbeforeunload = function(){
	myfun();
	return 'Are you sure you want to leave?'
};
function myfun(){
	vars.timing.navigationEnd = Date.now();
	console.log("Stayed on page for "+funcs.ms_to_hms(analytics.timing.Total));
}