import { f, a } from "./framework.js";
import { w } from "../../lifecycle/0.1.1/lifecycle.js";
import { g } from "../../lifecycle/0.1.1/lifecycle.native.js";

window.onload = () => {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
	console.log(lifecycle);
}
window.onclick = (e) => {
	f.registerClick();
	console.log(a.Submit());
}

g.addEventListener('statechange', function(event) {
	if (event.originalEvent == 'visibilitychange' && event.newState == 'hidden') {
		var url = "https://example.com/foo";
		var data = "bar";

		navigator.sendBeacon(url, data);
	}
});
window.onunload = () => {
	f.saveUnloadMetrics();
}