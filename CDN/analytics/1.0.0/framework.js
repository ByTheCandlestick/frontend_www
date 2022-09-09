function init() {
	console.log('analytics initializing');
}
convert = {
	ms_to_MHS(ms) {
		var hrs = Math.floor(ms / 3600000),
			mns = ((ms % 60000) / 6000).toFixed(0),
			scs = ((ms % 3600000) / 1000).toFixed(0);
		return ((hrs>0)?(hrs < 10 ? '0' : '') + hrs + ":": "") + (mns < 10 ? '0' : '') + mns + ":" + (scs < 10 ? '0' : '') + scs + " (" + ms + "ms)";
	}
}
  
export {
	init,
	convert,
};