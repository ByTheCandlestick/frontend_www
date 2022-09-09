var fw = {};
fw.init = () => {
	console.log('analytics initializing');
}
fw.DOMlookup = () => {
	return (vars.timing.domainLookupEnd - vars.timing.domainLookupStart);
}
fw.DOMinteractive = () => {
	return (vars.timing.domInteractive - vars.timing.navigationStart);
}
fw.DOMloaded = () => {
	return (vars.timing.domContentLoadedEventEnd - vars.timing.navigationStart);
}
fw.DOMcomplete = () => {
	return (vars.timing.domComplete - vars.timing.navigationStart);
}	
fw.Complete = () => {
	return (vars.timing.complete - vars.timing.navigationStart);
}
fw.Active = () => {
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
analytics.timings.DOMLookup = fw.DOMlookup();
analytics.timings.DOMInteractive = fw.DOMinteractive();
analytics.timings.DOMLoaded = fw.DOMloaded();
analytics.timings.DOMComplete = fw.DOMcomplete();
analytics.timings.Loaded = fw.Complete();
analytics.timings.Total = fw.Active();
analytics.Submit = () => {

}


export {fw, funcs, vars, analytics};