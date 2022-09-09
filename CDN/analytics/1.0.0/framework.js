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
	return (vars.timing.domainLookupEnd - vars.timing.domainLookupStart);
	return (vars.timing.domInteractive - vars.timing.navigationStart);
	return (vars.timing.domContentLoadedEventEnd - vars.timing.navigationStart);
	return (vars.timing.domComplete - vars.timing.navigationStart);
	return (vars.timing.complete - vars.timing.navigationStart);
}
fw.saveUnloadMetrics = () => {
	return (vars.timing.navigationEnd - vars.timing.navigationStart);
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
analytics.timing.DOMLookup = fw.DOMlookup();
analytics.timing.DOMInteractive = fw.DOMinteractive();
analytics.timing.DOMLoaded = fw.DOMloaded();
analytics.timing.DOMComplete = fw.DOMcomplete();
analytics.timing.Loaded = fw.Complete();
analytics.timing.Total = fw.Active();
analytics.Submit = () => {

}


export {fw, funcs, vars, analytics};