var fw = {};
fw.init = () => {
	//console.log('analytics initializing');
}
fw.funcs = {};
fw.funcs.ms_to_hms = (ms) => {
	var hrs = parseInt((ms / 1000) / 3600 ),
		mns = parseInt(((ms/1000) % 3600) / 60 ),
		scs = (ms / 1000) % 60;
	return ((hrs>0)?(hrs < 10 ? '0' : '') + hrs + ":": "") + (mns < 10 ? '0' : '') + mns + ":" + (scs < 10 ? '0' : '') + scs;
}
fw.vars = {};
fw.vars.timing = {};
fw.vars.timing.navigationStart = null;
fw.vars.timing.domainLookupStart = null;
fw.vars.timing.domainLookupEnd = null;
fw.vars.timing.domInteractive = null;
fw.vars.timing.domContentLoadedEventEnd = null;
fw.vars.timing.domComplete = null;
fw.vars.timing.complete = null;



export {fw};