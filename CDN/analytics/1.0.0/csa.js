import { fw, v, f, a } from "./framework.js";


window.onload = function () {
	fw.initialize()
	fw.saveLoadMetrics();

}
window.onbeforeunload = function(){
	fw.immobilise();
	fw.saveUnloadMetrics();
	return 'Are you sure you want to leave?'
}