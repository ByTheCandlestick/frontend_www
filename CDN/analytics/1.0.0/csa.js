import { f, a } from "./framework.js";
import "//cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js";

window.onload = function () {
	f.registerAnalyticsID();
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
	f.saveSystemMetrics();
	console.log(a);
}
window.onbeforeunload = function(){
	f.saveUnloadMetrics();
	a.Submit();
}

function ms_to_hms(ms) {
	var hrs = parseInt((ms / 1000) / 3600 ),
		mns = parseInt(((ms/1000) % 3600) / 60 ),
		scs = (ms / 1000) % 60;
	return ((hrs>0)?(hrs < 10 ? '0' : '') + hrs + ":": "") + (mns < 10 ? '0' : '') + mns + ":" + (scs < 10 ? '0' : '') + scs;
}