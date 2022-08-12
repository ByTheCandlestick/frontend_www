$(document).ready(function() {
	// QZing library
		let selectedDeviceId;
		const codeReader = new ZXing.BrowserMultiFormatReader()
		console.log('ZXing reader initialized')
		codeReader.listVideoInputDevices().then((videoInputDevices) => {
			const sourceSelect = document.getElementById('sourceSelect');
			selectedDeviceId = videoInputDevices[0].deviceId;
			if(videoInputDevices.length >= 1) {
				videoInputDevices.forEach((element) => {
					const sourceOption = document.createElement('option')
					sourceOption.text = element.label;
					sourceOption.value = element.deviceId;
					sourceSelect.appendChild(sourceOption);
				})
				sourceSelect.onchange = () => {
					selectedDeviceId = sourceSelect.value;
				};
				const sourceSelectPanel = document.getElementById('sourceSelectPanel');
				sourceSelectPanel.style.display = 'block';
			}
			document.getElementById('startButton').addEventListener('click', () => {
				codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
					if (result) {
						console.log(result);
						document.getElementById('result').textContent = result.text;
					}
					if (err && !(err instanceof ZXing.NotFoundException)) {
						console.error(err);
						document.getElementById('result').textContent = err;
					}
				})
				console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
			})
			document.getElementById('resetButton').addEventListener('click', () => {
				codeReader.reset();
				document.getElementById('result').textContent = '';
				console.log('Reset.');
			})
		}).catch((err) => {
			console.error(err);
		})
	//
		const searchbar = $(".productSearch.bar");
		keypad = {
			click: (btn) => {
				if($("input[type=number]").length <= 1 && searchbar.length == 1) {
					if(/[0-9\.]/.test(btn)){
						searchbar.val(searchbar.val() + btn);
					} else {
						if(btn == 'clear') { searchbar.val(''); }
						else if(btn == 'back') {  }
						else if(btn == 'enter') {  }
					}
				}
			}
		}
});