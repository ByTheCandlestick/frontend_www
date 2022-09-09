import { fw, vars, funcs, analytics } from "./framework.js";


window.onload = function () {
	fw.init()
	fw.saveLoadMetrics();

	console.log("Domain lookup took "+funcs.ms_to_hms(analytics.timing.DOMLookup));
	console.log("DOM interactive in "+funcs.ms_to_hms(analytics.timing.DOMInteractive));
	console.log("DOM loaded in "+funcs.ms_to_hms(analytics.timing.DOMLoaded));
	console.log("DOM complete in "+funcs.ms_to_hms(analytics.timing.DOMComplete));
	console.log("Fulliy loaded in "+funcs.ms_to_hms(analytics.timing.Loaded));
}
window.onbeforeunload = function(){
	vars.timing.navigationEnd = Date.now();
	fw.saveUnloadMetrics();
	console.log("Stayed on page for "+funcs.ms_to_hms(analytics.timing.Total));
	return 'Are you sure you want to leave?'
}