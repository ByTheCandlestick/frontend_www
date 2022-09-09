import { v, a } from "./classes.js";
import { fw, f } from "./framework.js";


window.onload = function () {
	fw.initialize()
	fw.saveLoadMetrics();
}
window.onbeforeunload = function(){
	fw.immobilize();
	fw.saveUnloadMetrics();
	return 'Are you sure you want to leave?'
}