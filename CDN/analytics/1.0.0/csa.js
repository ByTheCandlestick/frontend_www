import { f, a } from "./framework.js";
import { w } from "../../lifecycle/0.1.1/lifecycle.js";

window.onload = () => {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();

	f.saveProductMetrics();
	f.saveProductMetrics();
}
window.onclick = (e) => {
	f.registerClick();
}
window.onunload = () => {
	f.saveUnloadMetrics();
	navigator.sendBeacon( "http://api.candlestick-indev.co.uk/v1/analytics/?api_key="+m.api_key+"&analytics="+JSON.stringify(a));
}