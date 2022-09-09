function init() {
	console.log('analytics initializing');
}

function convertms(ms) {
	var hours = Math.floor(ms / 60000),
		minutes = ((ms % 60000) / 1000).toFixed(0),
		seconds = ((ms % 3600000) / 1000).toFixed(0);
	return (hours < 10 ? '0' : '') + hours + ":" + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
  }
  
export {
	init,
	convertms,
};