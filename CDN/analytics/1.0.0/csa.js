import { f, a } from "./framework.js";

window.onload = function () {
	f.saveLoadMetrics();
	f.saveBrowserMetrics();
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