var codesEl, jsonData;
$( document ).ready(function() {
	// -----========== Dark mode toggle ==========----- //
		var modeSwitch	= $('.mode-switch');
		var root		= $('html');
		modeSwitch.click(function () {
			root.toggleClass('dark');
			modeSwitch.toggleClass('active');
		});
	// -----========== PRELOADER ==========----- //
	$('.app-preloader').fadeOut()
	// -----========== Search ==========----- //
	codesEl = document.getElementById("codes");
	$.get('/Assets/search.json', function(data) {
		jsonData = data;
	});
});
function printData(Arr) {
	for(var i=0; i<Arr.length; i++) {
		codesEl.innerText += `\n${Arr[i].name} code: ${Arr[i].code}`;
	}
}

function search(ev) {
	var key = ev.target.value;
	codesEl.innerText = null;
	
	printData(jsonData.filter((data)=>{
		var regex = new RegExp(key, "i");
		return data.name.match(regex) || data.code.match(regex);
	}));
}