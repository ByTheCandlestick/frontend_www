var f = {};
	f.saveLoadMetrics = () => {
		//console.log('analytics initializing');
		a.timing.DOMLookup = (window.performance.timing.domainLookupEnd - window.performance.timing.domainLookupStart);
		a.timing.DOMInteractive = (window.performance.timing.domInteractive - window.performance.timing.navigationStart);
		a.timing.DOMLoaded = (window.performance.timing.domContentLoadedEventEnd - window.performance.timing.navigationStart);
		a.timing.DOMComplete = (window.performance.timing.domComplete - window.performance.timing.navigationStart);
		a.timing.DOMFinished = (Date.now() - window.performance.timing.navigationStart);
		a.domain.href = window.location.href;
		a.domain.Protocol = window.location.protocol;
		a.domain.Hostname = window.location.hostname;
		a.domain.Path = window.location.hostname;
		a.domain.Origin = window.location.origin;
		//console.log('analytics initialized');
	}
	f.saveUnloadMetrics = () => {
		//console.log('analytics immobilizing');
		a.timing.TimeSpent = ( Date.now() - window.performance.timing.navigationStart);
		//console.log('analytics immobilized');
	}
	f.saveUserAgent = () => {
		console.log(a.user.agent = window.navigator.userAgent);
	}
var a = {}
	a.timing = {};
		a.timing.DOMLookup = null;
		a.timing.DOMInteractive = null;
		a.timing.DOMLoaded = null;
		a.timing.DOMComplete = null;
		a.timing.DOMFinished = null;
		a.timing.TimeSpent = null;
	a.domain = {};
		a.domain.href = null;
		a.domain.Protocol = null;
		a.domain.Hostname = null;
		a.domain.Path = null;
		a.domain.Origin = null;
	a.user = {};
		a.user.agent = null;
	a.Submit = () => {

	}

export { f, a };