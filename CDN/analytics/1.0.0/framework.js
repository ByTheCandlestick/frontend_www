function init() {
	console.log('analytics initializing');
}

function convertmilliseconds(millis) {
	var minutes = Math.floor(millis / 60000);
	var seconds = ((millis % 60000) / 1000).toFixed(0);
	var hours = ((millis % 3600000) / 1000).toFixed(0);
	return (hours < 10 ? '0' : '') + hours + ":" + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
  }
  
export {
	init,
	convertmilliseconds,
};