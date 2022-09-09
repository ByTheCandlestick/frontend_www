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
var funcs = {};
funcs.ms_to_hms = (ms) => {
	var hrs = parseInt((ms / 1000) / 3600 ),
		mns = parseInt(((ms/1000) % 3600) / 60 ),
		scs = (ms / 1000) % 60;
	return ((hrs>0)?(hrs < 10 ? '0' : '') + hrs + ":": "") + (mns < 10 ? '0' : '') + mns + ":" + (scs < 10 ? '0' : '') + scs;
}

var vars = {};
vars.timing = {};
vars.timing.navigationStart = null;
vars.timing.navigationEnd = null;
vars.timing.domainLookupStart = null;
vars.timing.domainLookupEnd = null;
vars.timing.domInteractive = null;
vars.timing.domContentLoadedEventEnd = null;
vars.timing.domComplete = null;
vars.timing.complete = null;

var analytics = {}
analytics.timing = {};
analytics.timing.DOMLookup = null;
analytics.timing.DOMInteractive = null;
analytics.timing.DOMLoaded = null;
analytics.timing.DOMComplete = fw.DOMcomplete();
analytics.timing.DOMFinished = fw.Complete();
analytics.timing.TimeSpent = fw.Active();
analytics.Submit = () => {

}


export {fw, funcs, vars, analytics};