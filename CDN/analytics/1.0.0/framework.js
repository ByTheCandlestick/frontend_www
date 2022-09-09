var fw = {};
	fw.saveLoadMetrics = () => {
		console.log('analytics initializing');
		a.timing.DOMLookup = (window.performance.timing.domainLookupEnd - window.performance.timing.domainLookupStart);
		a.timing.DOMInteractive = (window.performance.timing.domInteractive - window.performance.timing.navigationStart);
		a.timing.DOMLoaded = (window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart);
		a.timing.DOMComplete = (window.performance.timing.domComplete - window.performance.timing.navigationStart);
		a.timing.DOMFinished = (Date.now() - window.performance.timing.navigationStart);
		console.log('analytics initialized');
	}
	fw.saveUnloadMetrics = () => {
		console.log('analytics immobilizing');
		var unloadTime = Date.now();
		a.timing.TimeSpent = ( unloadTime - window.performance.timing.navigationStart);
		console.log('analytics immobilized');
	}
var f = {};
	f.ms_to_hms = (ms) => {
		var hrs = parseInt((ms / 1000) / 3600 ),
			mns = parseInt(((ms/1000) % 3600) / 60 ),
			scs = (ms / 1000) % 60;
		return ((hrs>0)?(hrs < 10 ? '0' : '') + hrs + ":": "") + (mns < 10 ? '0' : '') + mns + ":" + (scs < 10 ? '0' : '') + scs;
	}
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

export { fw, f, a };