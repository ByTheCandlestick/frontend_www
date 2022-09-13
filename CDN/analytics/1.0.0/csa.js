import { f, a } from "./framework.js";

window.onload = function () {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
}
window.onbeforeunload = function(){
	f.saveUnloadMetrics();
	alert(a.Submit());
}
window.onclick = (e) => {
	f.registerClick();
	console.log(a.clicks);
}