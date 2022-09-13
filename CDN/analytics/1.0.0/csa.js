import { f, a } from "./framework.js";

window.onload = () => {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
}
window.onclick = (e) => {
	f.registerClick();
}
window.onbeforeunload = () => {
	//console.log(a.Submit());
	f.saveUnloadMetrics();
}