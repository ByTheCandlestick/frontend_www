document.addEventListener('DOMContentLoaded', function () {
	var modeSwitch = document.querySelector('.mode-switch');

	modeSwitch.addEventListener('click', function () {                     document.documentElement.classList.toggle('dark');
		modeSwitch.classList.toggle('active');
	});
	
	var listView = document.querySelector('.list-view');
	var gridView = document.querySelector('.grid-view');
	
	document.querySelector('.messages-btn').addEventListener('click', function () {
		document.querySelector('.messages-section').classList.add('show');
	});
	
	document.querySelector('.messages-close').addEventListener('click', function() {
		document.querySelector('.messages-section').classList.remove('show');
	});
});