import { fw, v, f, a } from "./framework.js";


window.onload = function () {
	fw.init()
	fw.saveLoadMetrics();

}
window.onbeforeunload = function(){
	vars.timing.navigationEnd = Date.now();
	fw.saveUnloadMetrics();
	console.log("Stayed on page for "+funcs.ms_to_hms(analytics.timing.TimeSpent));
	return 'Are you sure you want to leave?'
}