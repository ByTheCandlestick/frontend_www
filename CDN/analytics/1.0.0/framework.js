const cipher = salt => {
    const textToChars = text => text.split('').map(c => c.charCodeAt(0));
    const byteHex = n => ("0" + Number(n).toString(16)).substr(-2);
    const applySaltToChar = code => textToChars(salt).reduce((a,b) => a ^ b, code);

    return text => text.split('')
      .map(textToChars)
      .map(applySaltToChar)
      .map(byteHex)
      .join('');
}
var f = {};
	f.registerAnalyticsID = () => {
		var d = new Date(),
			currTime = d.getTime(),
			randomID = Math.random(),
			userAgent = window.navigator.userAgent;
	
		a.user.analytics_id = cipher(currTime+userAgent+randomID);
	}
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
		a.domain.Path = window.location.pathname;
		//console.log('analytics initialized');
	}
	f.saveBrowserMetrics = () => {
		var uAgt = navigator.userAgent,
			browserName  = navigator.appName,
			fullVersion  = ''+parseFloat(navigator.appVersion),
			majorVersion = parseInt(navigator.appVersion,10),
			nameOffset, verOffset, ix;
		if ((verOffset=uAgt.indexOf("Opera"))!=-1) {
			browserName = "Opera";
			fullVersion = uAgt.substring(verOffset+6);
			if ((verOffset=uAgt.indexOf("Version"))!=-1) fullVersion = uAgt.substring(verOffset+8);
		} else if ((verOffset=uAgt.indexOf("MSIE"))!=-1) {		// In MSIE, the true version is after "MSIE" in userAgent
			browserName = "Microsoft Internet Explorer";
			fullVersion = uAgt.substring(verOffset+5);
		} else if ((verOffset=uAgt.indexOf("Edg"))!=-1) {		// In MSIE, the true version is after "MSIE" in userAgent
			browserName = "Microsoft Edge";
			fullVersion = uAgt.substring(verOffset+4);
		} else if ((verOffset=uAgt.indexOf("Chrome"))!=-1) {	// In Chrome, the true version is after "Chrome" 
			browserName = "Google Chrome";
			fullVersion = uAgt.substring(verOffset+7);
		} else if ((verOffset=uAgt.indexOf("Safari"))!=-1) {	// In Safari, the true version is after "Safari" or after "Version" 
			browserName = "Safari";
			fullVersion = uAgt.substring(verOffset+7);
			if ((verOffset=uAgt.indexOf("Version"))!=-1) fullVersion = uAgt.substring(verOffset+8);
		} else if ((verOffset=uAgt.indexOf("Firefox"))!=-1) {	// In Firefox, the true version is after "Firefox"
			browserName = "Firefox";
			fullVersion = uAgt.substring(verOffset+8);
		} else if ( (nameOffset=uAgt.lastIndexOf(' ')+1) < (verOffset=uAgt.lastIndexOf('/')) ) {	// In most other browsers, "name/version" is at the end of userAgent 
			browserName = uAgt.substring(nameOffset,verOffset);
			fullVersion = uAgt.substring(verOffset+1);
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
		var uAgt = navigator.userAgent,
			systemName  = navigator.appName,
			systemFullVersion  = ''+parseFloat(navigator.appVersion),
			systemMajorVersion = parseInt(navigator.appVersion,10),
			nameOffset, verOffset, ix, systemArch, systemBase;
		if((verOffset=uAgt.indexOf("Windows NT"))!=-1) {
			systemName = "Windows";
			systemFullVersion = uAgt.substring(verOffset+11);
			systemBase = uAgt.substring(verOffset+17);
			systemArch = uAgt.substring(verOffset+24);
		} else if((verOffset=uAgt.indexOf("X11"))!=-1) {
			systemName = "Linux";
			systemFullVersion = 'Unknown';
			systemArch = uAgt.substring(verOffset+11);
		} else if((verOffset=uAgt.indexOf("Macintosh"))!=-1) {
			systemName = "Mac OS";
			systemFullVersion = uAgt.substring(verOffset+11);
			systemArch = 'Unknown';
		} else if((verOffset=uAgt.indexOf("iPhone OS"))!=-1) {
			systemName = "iPhone OS";
			systemFullVersion = uAgt.substring(verOffset+10).replace('_', '.');
			systemArch = 'Unknown';
		}
		if ((ix=systemFullVersion.indexOf(";"))!=-1) systemFullVersion=systemFullVersion.substring(0,ix);
		if ((ix=systemFullVersion.indexOf(" "))!=-1) systemFullVersion=systemFullVersion.substring(0,ix);
		if ((ix=systemFullVersion.indexOf("."))!=-1) systemMajorVersion=systemFullVersion.substring(0,ix);
		if ((ix=systemBase.indexOf(";"))!=-1) systemBase=systemBase.substring(0,ix);
		if ((ix=systemBase.indexOf(" "))!=-1) systemBase=systemBase.substring(0,ix);
		if ((ix=systemArch.indexOf(")"))!=-1) systemArch=systemArch.substring(0,ix);
		
		a.system.Name = systemName;
		a.system.MajorVersion = systemMajorVersion;
		a.system.FullVersion = systemFullVersion;
		a.system.Base = systemBase;
		a.system.Architecture = systemArch;
	}
	f.saveUnloadMetrics = () => {
		//console.log('analytics immobilizing');
		a.timing.TimeSpent = ( Date.now() - window.performance.timing.navigationStart);
		//console.log('analytics immobilized');
	}
var a = {}
	a.user = {};
		a.user.analytics_id = null;
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
	a.browser = {};
		a.browser.UserAgent = null;
		a.browser.Name = null;
		a.browser.FullVersion = null;
		a.browser.MajorVersion = null;
		a.browser.Appname = null;
	a.system = {}
		a.system.Name = null;
		a.system.MajorVersion = null;
		a.system.FullVersion = null;
		a.system.Base = null;
		a.system.Architecture = null;
	a.Submit = () => {

	}

export { f, a };