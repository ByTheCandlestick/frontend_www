var codesEl;
var jsonData = [ 
	{
		"name": "amazon",
		"code": "aksdhfkjags"
	}, {
		"name": "aMaZoN",
		"code": "qiweuryqew"
	}, {
		"name": "flipkart",
		"code": "kjqwherklq"
	}, {
		"name": "flipkart",
		"code": "qmbewnqbwe"
	}, {
		"name": "flipkart",
		"code": "zzvzxcvvnmz"
	}, {
		"name": "ebay",
		"code": "tyjutynf"
	}, {
		"name": "ebay",
		"code": "asgcmngjhjser"
	}
];

function printData(Arr) {
	for(var i=0; i<Arr.length; i++) {
		codesEl.innerText += `\n${Arr[i].name} code: ${Arr[i].code}`;
	}
}

// it is a case insensitive search
function search(ev) {
	var key = ev.target.value;
	codesEl.innerText = null;
	
	printData(jsonData.filter((data)=>{
		var regex = new RegExp(key, "i");
		return data.name.match(regex) || data.code.match(regex);
	}));
}

window.onload = function() {
	codesEl = document.getElementById("codes");
	printData(jsonData);
}