import { f, a } from "./framework.js";

window.onload = () => {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
}
window.onclick = (e) => {
	f.registerClick();
	console.log(a.Submit());
}
window.onunload = () => {
	f.saveUnloadMetrics();
}