import { f, a } from "./framework.js";

window.onload = function () {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
}
window.onclick = (e) => {
	f.registerClick();
}
window.onbeforeunload = () => {
	alert(a.Submit());
	f.saveUnloadMetrics();
}