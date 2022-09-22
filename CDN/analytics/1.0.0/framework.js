var m = {}
	m.api_key = 'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
	m.crypt = {};
		m.crypt.cipher = (salt) => {
			var	textToChars = text => text.split('').map(c => c.charCodeAt(0)),
				byteHex = n => ("0" + Number(n).toString(16)).substr(-2),
				applySaltToChar = code => textToChars(salt).reduce((a,b) => a ^ b, code);
			return text => text.split('').map(textToChars).map(applySaltToChar).map(byteHex).join('');
		}
	m.cookie = {};
		m.cookie.create = (name, value, expDays, path='/') => {
			let date = new Date();
			date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
			document.cookie = name + "=" + value + "; " + "expires=" + date.toUTCString() + "; path="+path;
		},
		m.cookie.read = (name) => {
			var name = name+"=",
				arr = decodeURIComponent(document.cookie).split('; '),
				res;
			arr.forEach(val => {
				if(val.indexOf(name) === 0) res = val.substring(name.length);
			})
			return res;
		},
		m.cookie.update = (name, value) => {
			m.cookie.create(name, value, 30);
		},
		m.cookie.delete = (name) => {
			document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
		},
		m.cookie.exists = (name) => {
			return (m.cookie.read(name) === undefined)? false: true;
		}
	m.removeEmpty = (arr) => {
		const arrFiltered = arr.filter(el => {
			r = el != null && el != '';
		});
		return r
	}
var f = {};
	f.registerAnalyticsID = () => {
		if(!m.cookie.exists('analytics_id')) {
			var d = new Date(),
				crypt = m.crypt.cipher('salt'),
				cypher = crypt(''+d.getTime()+window.navigator.userAgent+Math.random()+'');
			m.cookie.create('analytics_id', cypher, 365)
			a.user.analytics_id = cypher;
		} else {
			a.user.analytics_id = m.cookie.read('analytics_id');
		}
	}
	f.registerClick = () => {
		a.clicks[Object.keys(a.clicks).length] = {};
		a.clicks[Object.keys(a.clicks).length - 1]["X"] = event.screenX + window.scrollX;
		a.clicks[Object.keys(a.clicks).length - 1]["Y"] = event.screenY + window.scrollY;
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
	f.isProduct = () => {
		let p = a.domain.Path.split("/");
		if(p[0] == "Boutique" && p[1] == "Product") return m.removeEmpty(p);
		return false;
	}
	f.saveProductMetrics = () => {
		let p = f.isProduct();
		console.log(p);
		if(p != false) {
		}
	}
var a = {};
	a.user = {};
		a.user.analytics_id = null;	// A randomly generated string
	a.timing = {};
		a.timing.DOMLookup = null;		// time in MS
		a.timing.DOMInteractive = null;	// time in MS
		a.timing.DOMLoaded = null;		// time in MS
		a.timing.DOMComplete = null;	// time in MS
		a.timing.DOMFinished = null;	// time in MS
		a.timing.TimeSpent = null;		// time in MS
	a.domain = {};
		a.domain.href = null;		// Full url
		a.domain.Protocol = null;	// http / https
		a.domain.Hostname = null;	// domain
		a.domain.Path = null;		// path
	a.browser = {};
		a.browser.UserAgent = null;		// Browser user agent
		a.browser.Name = null;			// Browser version
		a.browser.FullVersion = null;	// Browser full version
		a.browser.MajorVersion = null;	// Browser version
		a.browser.Appname = null;		// Browser App name
	a.system = {};
		a.system.Name = null;			// OS name
		a.system.MajorVersion = null;	// OS version
		a.system.FullVersion = null;	// OS full version
		a.system.Base = null;			// OS base
		a.system.Architecture = null;	// OS architecture
	a.clicks = {};

export { f, a };