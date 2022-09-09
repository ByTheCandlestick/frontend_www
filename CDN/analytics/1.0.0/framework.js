var fw = {};
fw.init = () => {
	console.log('analytics initializing');
}
fw.DOMlookup = () => {}
fw.DOMinteractive = () => {}
fw.DOMloaded = () => {}
fw.DOMcomplete = () => {}
fw.Complete = () => {
	return (vars.timing.complete - vars.timing.navigationStart);
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
vars.timing.domainLookupStart = null;
vars.timing.domainLookupEnd = null;
vars.timing.domInteractive = null;
vars.timing.domContentLoadedEventEnd = null;
vars.timing.domComplete = null;
vars.timing.complete = null;



export {fw, funcs, vars};