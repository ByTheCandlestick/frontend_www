var fw = {};
fw.initialize = () => {
	console.log('analytics initializing');
	v.timing.navigationStart = window.performance.timing.navigationStart;
	v.timing.domainLookupStart = window.performance.timing.domainLookupStart;
	v.timing.domainLookupEnd = window.performance.timing.domainLookupEnd;
	v.timing.domInteractive = window.performance.timing.domInteractive;
	v.timing.domContentLoadedEventEnd = window.performance.timing.domContentLoadedEventEnd;
	v.timing.domComplete = window.performance.timing.domComplete;
	v.timing.complete = Date.now();
	console.log('analytics initialized');
}
fw.initialize = () => {
	console.log('analytics immobilizing');
	v.timing.navigationEnd = Date.now();
	console.log('analytics immobilized');
}

fw.saveLoadMetrics = () => {
	a.timing.DOMLookup = (v.timing.domainLookupEnd - v.timing.domainLookupStart);
	a.timing.DOMInteractive = (v.timing.domInteractive - v.timing.navigationStart);
	a.timing.DOMLoaded = (v.timing.domContentLoadedEventEnd - v.timing.navigationStart);
	a.timing.DOMComplete = (v.timing.domComplete - v.timing.navigationStart);
	a.timing.DOMFinished = (v.timing.complete - v.timing.navigationStart);
}
fw.saveUnloadMetrics = () => {
	a.timing.TimeSpent = (v.timing.navigationEnd - v.timing.navigationStart);
}
var f = {};
f.ms_to_hms = (ms) => {
	var hrs = parseInt((ms / 1000) / 3600 ),
		mns = parseInt(((ms/1000) % 3600) / 60 ),
		scs = (ms / 1000) % 60;
	return ((hrs>0)?(hrs < 10 ? '0' : '') + hrs + ":": "") + (mns < 10 ? '0' : '') + mns + ":" + (scs < 10 ? '0' : '') + scs;
}

var v = {};
v.timing = {};
v.timing.navigationStart = null;
v.timing.navigationEnd = null;
v.timing.domainLookupStart = null;
v.timing.domainLookupEnd = null;
v.timing.domInteractive = null;
v.timing.domContentLoadedEventEnd = null;
v.timing.domComplete = null;
v.timing.complete = null;

var a = {}
a.timing = {};
a.timing.DOMLookup = null;
a.timing.DOMInteractive = null;
a.timing.DOMLoaded = null;
a.timing.DOMComplete = null;
a.timing.DOMFinished = null;
a.timing.TimeSpent = null;
a.Submit = () => {

}


export {fw, funcs, vars, analytics};