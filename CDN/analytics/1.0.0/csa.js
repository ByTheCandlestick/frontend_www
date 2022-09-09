//import * as tti from "./vendors/tti-polyfill.js";
import * as fw from "./framework.js";

fw.init();

window.onload = function () {
	timings = window.performance.timing;
	timings.forEach(function(item){
		date = new Date(item);
		console.log(date)
	})

	/*
	console.log("DOM loaded in "+(window.performance.timing.domContentLoadedEventEnd - window.performance.timing.requestStart)+"ms");
	console.log("DOM complete in "+(window.performance.timing.domComplete - window.performance.timing.requestStart)+"ms");
	console.log("DOM interactive in "+(window.performance.timing.domInteractive - window.performance.timing.requestStart)+"ms");
	*/
}
