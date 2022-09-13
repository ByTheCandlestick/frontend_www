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
lifecycle.addEventListener('statechange', function(event) {
	if (event.originalEvent == 'visibilitychange' && event.newState == 'hidden') {
		var url = "https://example.com/foo";
		var data = "bar";

		navigator.sendBeacon(url, data);
	}
});
window.onunload = () => {
	f.saveUnloadMetrics();
}