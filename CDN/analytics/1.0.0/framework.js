var fw = {};
fw.init = () => {
	console.log('analytics initializing');
	vars.timing.navigationStart = window.performance.timing.navigationStart;
	vars.timing.domainLookupStart = window.performance.timing.domainLookupStart;
	vars.timing.domainLookupEnd = window.performance.timing.domainLookupEnd;
	vars.timing.domInteractive = window.performance.timing.domInteractive;
	vars.timing.domContentLoadedEventEnd = window.performance.timing.domContentLoadedEventEnd;
	vars.timing.domComplete = window.performance.timing.domComplete;
	vars.timing.complete = Date.now();
	console.log('analytics initialized');
}
fw.saveLoadMetrics = () => {
	analytics.timing.DOMLookup = (vars.timing.domainLookupEnd - vars.timing.domainLookupStart);
	analytics.timing.DOMInteractive = (vars.timing.domInteractive - vars.timing.navigationStart);
	analytics.timing.DOMLoaded = (vars.timing.domContentLoadedEventEnd - vars.timing.navigationStart);
	analytics.timing.DOMComplete = (vars.timing.domComplete - vars.timing.navigationStart);
	analytics.timing.DOMFinished = (vars.timing.complete - vars.timing.navigationStart);
}
fw.saveUnloadMetrics = () => {
	analytics.timing.TimeSpent = (vars.timing.navigationEnd - vars.timing.navigationStart);
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