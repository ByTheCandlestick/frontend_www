import { f, a } from "./framework.js";
import { w } from "../../lifecycle/0.1.1/lifecycle.js";

window.onload = () => {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
}
window.onclick = (e) => {
	f.registerClick();
}

w.addEventListener('statechange', function(event) {
	if (event.originalEvent == 'visibilitychange' && event.newState == 'hidden') {
		var url = "http://api.candlestick-indev.co.uk/v1/analytics/?api_key="+m.api_key+"&analytics="+JSON.stringify(a);
		navigator.sendBeacon(url);
	}
});
window.onunload = () => {
	f.saveUnloadMetrics();
}