function init() {
	console.log('analytics initializing');
}

function convertms(ms) {
	var minutes = Math.floor(ms / 60000),
		seconds = ((ms % 60000) / 1000).toFixed(0),
		hours = ((ms % 3600000) / 1000).toFixed(0);
	return (hours < 10 ? '0' : '') + hours + ":" + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
  }
  
export {
	init,
	convertms,
};