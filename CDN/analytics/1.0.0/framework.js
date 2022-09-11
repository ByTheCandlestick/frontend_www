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
	f.saveBrowserMetrics = () => {
		var nAgt = navigator.userAgent,
			browserName  = navigator.appName,
			fullVersion  = ''+parseFloat(navigator.appVersion),
			majorVersion = parseInt(navigator.appVersion,10),
			nameOffset, verOffset, ix;
		if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
			browserName = "Opera";
			fullVersion = nAgt.substring(verOffset+6);
			if ((verOffset=nAgt.indexOf("Version"))!=-1) fullVersion = nAgt.substring(verOffset+8);
		} else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {	// In MSIE, the true version is after "MSIE" in userAgent
			browserName = "Microsoft Internet Explorer";
			fullVersion = nAgt.substring(verOffset+5);
		} else if ((verOffset=nAgt.indexOf("Edg"))!=-1) {	// In MSIE, the true version is after "MSIE" in userAgent
			browserName = "Microsoft Edge";
			fullVersion = nAgt.substring(verOffset+4);
		} else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {	// In Chrome, the true version is after "Chrome" 
			browserName = "Google Chrome";
			fullVersion = nAgt.substring(verOffset+7);
		} else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {	// In Safari, the true version is after "Safari" or after "Version" 
			browserName = "Safari";
			fullVersion = nAgt.substring(verOffset+7);
			if ((verOffset=nAgt.indexOf("Version"))!=-1) fullVersion = nAgt.substring(verOffset+8);
		} else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {	// In Firefox, the true version is after "Firefox"
			browserName = "Firefox";
			fullVersion = nAgt.substring(verOffset+8);
		} else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < (verOffset=nAgt.lastIndexOf('/')) ) {	// In most other browsers, "name/version" is at the end of userAgent 
			browserName = nAgt.substring(nameOffset,verOffset);
			fullVersion = nAgt.substring(verOffset+1);
			if (browserName.toLowerCase()==browserName.toUpperCase()) browserName = navigator.appName;
		}
		// trim the fullVersion string at semicolon/space if present
		if ((ix=fullVersion.indexOf(";"))!=-1) fullVersion=fullVersion.substring(0,ix);
		if ((ix=fullVersion.indexOf(" "))!=-1) fullVersion=fullVersion.substring(0,ix);
		majorVersion = parseInt(''+fullVersion,10);
		if (isNaN(majorVersion)) {
			fullVersion  = ''+parseFloat(navigator.appVersion); 
			majorVersion = parseInt(navigator.appVersion,10);
		}
		a.browser.UserAgent = navigator.userAgent;
		a.browser.Name = browserName;
		a.browser.FullVersion = fullVersion;
		a.browser.MajorVersion = majorVersion;
		a.browser.Appname = navigator.appName;
	}
	f.saveSystemMetrics = () => {
		var nAgt = navigator.userAgent;
		if ((verOffset=nAgt.indexOf("Windows NT"))!=-1) {
			systemName = "Firefox";
			systemVersion = nAgt.substring(verOffset+11);
		}
	}
	f.saveUnloadMetrics = () => {
		//console.log('analytics immobilizing');
		a.timing.TimeSpent = ( Date.now() - window.performance.timing.navigationStart);
		//console.log('analytics immobilized');
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
	a.browser = {};
		a.browser.UserAgent = null;
		a.browser.Name = null;
		a.browser.FullVersion = null;
		a.browser.MajorVersion = null;
		a.browser.Appname = null;
	a.system = {}
		a.system.name = null;
	a.Submit = () => {

	}

export { f, a };