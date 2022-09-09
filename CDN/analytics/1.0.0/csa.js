import { fw, f, a } from "./framework.js";

window.onload = function () {
	console.log(window.location);
	fw.saveLoadMetrics();
}
window.onbeforeunload = function(){
	fw.saveUnloadMetrics();
	a.Submit();
	return 'Are you sure you want to leave?'
}