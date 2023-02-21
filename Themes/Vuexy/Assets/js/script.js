// -----========== CONSTANTS ==========----- //
	const api_url = window.location.protocol+'//api.'+window.location.hostname.slice(6) + '/v1';
	const api_key = 'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
// -----========== Nestled functions ==========----- //
	/** @final */
	alert = {
		/** @final */
		simple(text, colour="info", fadeIn=500, stay=5000, fadeOut=500) {
			$('\
				<div class="alert alert-'+colour+'" role="alert">\
					'+text+'\
				</div>\
			').hide().appendTo(".alerts").fadeIn(fadeIn, () => {
				setTimeout(() => {
					$($(".alerts").children()[0]).fadeOut(fadeOut, () => {
						$($(".alerts").children()[0]).remove();
					});
				}, stay);
			});
		},
		/** @final */
		additional(title, content, additional, colour="info", fadeIn=500, stay=5000, fadeOut=500) {
			$('\
				<div class="alert alert-'+colour+'" role="alert"> \
					<h4 class="alert-heading">'+title+'</h4>\
					<p>'+content+'</p>\
					<hr>\
					<p class="mb-0">'+additional+'</p>\
				</div>\
			').hide().appendTo(".alerts").fadeIn(fadeIn, () => {
				setTimeout(() => {
					$($(".alerts").children()[0]).fadeOut(fadeOut, () => {
						$($(".alerts").children()[0]).remove();
					});
				}, stay);
			});
		}
	}
	/** @final */
	assistance = {
		jsonData: {},
		id1: null,
		id2: null,
		id3: null,
		/** @final */
		markActive(name, elem) {
			$("div[name="+name+"]").find("li.active").removeClass('active');
			$(elem).addClass('active');
		},
		/** @final */
		loadLV1() {
			$("div[name=lv1], div[name=lv2], div[name=lv3], div[name=lv4]").html('');
			assistance.jsonData.forEach((data) => {
				$("div[name=lv1]").html(
					$("div[name=lv1]").html()+
					"<li onClick=\"assistance.loadLV2(this, "+data['id']+");\">"+
						data['title']+
					"</li>"
				);
			});
		},
		/** @final */
		loadLV2(elem, id) {
			this.markActive("lv1", elem)
			this.id1 = id;
			$("div[name=lv2], div[name=lv3], div[name=lv4]").html('');
			assistance.jsonData[this.id1]['lv2'].forEach((data) => {
				$("div[name=lv2]").html(
					$("div[name=lv2]").html()+
					"<li onClick=\"assistance.loadLV3(this, "+data['id']+");\">"+
						data['title']+
					"</li>"
				);
			});
		},
		/** @final */
		loadLV3(elem, id) {
			this.id2 = id;
			$("div[name=lv3], div[name=lv4]").html('');
			this.markActive("lv2", elem)
			assistance.jsonData[this.id1]['lv2'][this.id2]['lv3'].forEach((data) => {
				$("div[name=lv3]").html(
					$("div[name=lv3]").html()+
					"<li onClick=\"assistance.loadLV4(this, "+data['id']+");\">"+
						data['title']+
					"</li>"
				);
			});
		},
		/** @final */
		loadLV4(elem, id) {
			this.id3 = id
			this.markActive("lv3", elem)
			$.get(assistance.jsonData[this.id1]['lv2'][this.id2]['lv3'][this.id3]['lv4'], (data) =>{
				$("div[name=lv4]").html(
					markdown.toHTML(data)
				);
			})

		}
	}
	/** @final */
	config = {
		/** @final */
		permissions: {
			/** @final */
			new(n=$(".suffix option:selected").val()+'-'+$(".name").val(), d=$(".default").val()) {
				$.ajax({
					url: api_url + '/Config/Permission/',
					data: {
						'api_key': api_key,
						'name': n,
						'default': d,
					},
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							alert.simple("Successfully created", "success");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			save(o, n=$(".newname").val(), d=$(".default").val()) {
				$.ajax({
					url: api_url + '/Config/Permission/',
					data: {
						'api_key': api_key,
						'newName': n,
						'oldName': o,
						'default': d,
					},
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							alert.simple("Successfully updated", "success");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			delete(n) {
				$.ajax({
					url: api_url + '/Config/Permission/',
					data: {
						'api_key': api_key,
						'name': n,
					},
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							alert.simple("Successfully deleted", "success");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				})
			},
		},
	}
	/** @final */
	cookie = {
		/** @final */
		create(name, value, expDays, path='/') {
			let date = new Date();
			date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
			document.cookie = name + "=" + value + "; " + "expires=" + date.toUTCString() + "; path="+path;
		},
		/** @final */
		read(name) {
			var name = name+"=",
				arr = decodeURIComponent(document.cookie).split('; '),
				res;
			arr.forEach(val => {
				if(val.indexOf(name) === 0) res = val.substring(name.length);
			})
			return res;
		},
		/** @final */
		update(name, value) {
			cookie.create(name, value, 30);
		},
		/** @final */
		delete(name) {
			document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
		},
		/** @final */
		exists(name) {
			return (cookie.read(name) === undefined)? false: true;
		},
	}
	/** @wip */
	images = {
		/** @wip */
		modify: {
			/** @wip */
			openModal(slug, location) {
				infoDiv = $('#image-cropper[data-slug=' + slug + ']');
				$('.cropper-image').attr('src', location)
				$('#imageEditorModal').modal('show');	
			},
			/** @wip */
			closeModal() {
				$('#imageEditorModal').modal('hide');
			},
			/** @wip */
			save() {
				
			},
		}
	}
	/** @final */
	mail = {
		/** @final */
		send(f=$(".mail-from").val(),		t=$(".mail-to").val(),
			 c=$(".mail-cc").val(),			b=$(".mail-bcc").val(),
			 s=$(".mail-subject").val(),	m=$("iframe").contents().find('.mce-content-body').html()) {
			$.ajax({
				url: api_url + '/Mail/Send/',
				data: {
					'api_key': api_key,
					'f':f, 't':t, 'c':c,
					'b':b, 's':s, 'm':m,
				},
				type: 'PUT',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					$(location).attr('href', '/Products/?al_ty=success&al_tx=Email%20sent%20successfully');
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
	}
	/** @final */
	misc = {
		currencies: null,
		/** @final */
		getQueryParams(params) {
			let regexp = new RegExp( '[?&]' + params + '=([^&#]*)', 'i' );
			let qString = regexp.exec(window.location.href);
			return qString ? qString[1] : null;
		},
		/** @final */
		round(value, step) {
			step || (step = 1.0);
			var inv = 1.0 / step;
			return Math.ceil(value * inv) / inv;
		},
		/** @final */
		closestNum(goal, numbers) {
			return numbers.reduce((prev, curr) => (Math.abs(curr - goal) < Math.abs(prev - goal) ? curr : prev));
		},
		/** @final */
		currSymbol(str) {
			Object.entries(misc.currencies).forEach(([key, value]) => {
				if(value.code == str) {
					return ''+value.symbol;
				}
			});
		},
		/** @final */
		redirect(url) {
			window.location.href = url;
		},
		/** @final */
		copyToClipboard(str) {
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val(str).select();
			document.execCommand("copy");
			$temp.remove();
		},
		/** @final */
		openInNewTab(str) {
			window.open(str, '_blank');
			window.focus();
		},
		/** @final */
		mcebogus(str) {
			return (str == "%3Cp%3E%3Cbr%20data-mce-bogus%3D%221%22%3E%3C%2Fp%3E")?"":str;
		},
		/** @final */
		wait(sec, func) {
			setTimeout(func,sec*1000);
		},
		
	}
	/** @final */
	mode = {
		switch: null,
		root: $('html'),
		/** @final */
		initialize() {
			mode.switch = $('.mode-switch');
			if(cookie.exists('cs_adm_mode')) {
				mode.set(cookie.read('cs_adm_mode'))
			} else {
				cookie.create("cs_adm_mode", "light")
				mode.set("light")
			};
		},
		/** @final */
		toggle() {
			(cookie.read('cs_adm_mode') == 'dark')? mode.set('light'): mode.set('dark');
		},
		/** @final */
		set(val) {
			cookie.update('cs_adm_mode', val);
			if(val == "dark") {
				mode.root.removeClass('light');
				mode.switch.find('i').removeClass('fa-moon');

				mode.root.addClass('dark');
				mode.switch.find('i').addClass('fa-sun');
			} else {
				mode.root.removeClass('dark');
				mode.switch.find('i').removeClass('fa-sun');

				mode.root.addClass('light');
				mode.switch.find('i').addClass('fa-moon');
			}
		},
	}
	/** @wip */
	orders = {
		/** @final */
		refunds: {
			/** @final */
			modal() {
				$('#refundModal').modal('show');
			},
			/** @final */
			check() {
				var currValue = $('input[name=refundCurrValue]'),
					maxValue = $('input[name=refundMaxValue]');
				if(currValue.val() > maxValue.val()) {
					currValue.val(maxValue.val());
				}
				if(currValue.val().match(/\./).length > 0) {
					val = currValue.val().match(/([0-9]+)\.([0-9]+)/);
					if(val[2] > 9) {
						currValue.val(parseFloat(currValue.val()).toFixed(2));
					}
				}
			},
			/** @final */
			confirm() {
				$('#refundModal').modal('hide');
				$('#refundConfirmModal').modal('show');
			},
			/** @final */
			commit() {
				$.ajax({
					url: api_url + '/Stripe/Refund/',
					data: {
						'api_key': api_key,
						'value': $('input[name=refundCurrValue]').val(),
						'ch_id': $('a[name=charge_id]').html()
					},
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						$('#refundConfirmModal').modal('hide');
						alert.simple("Successfully refunded", "success")
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
		},
		/** @final */
		displayRefunds() {
			$('#allRefundModal').modal('show');
		},
		confirmStatus(newStatus, invoice) {
			$('#orderStatusChangeModal').modal('show');
			$('#orderStatusChangeModal').find('button.confirmStausChange').attr('onClick', 'javascript:orders.updateStatus('+newStatus+',\''+invoice+'\');');
		},
		/** @final */
		updateStatus(newStatus, invoice) {
			$.ajax({
				url: api_url + '/Orders/Status/',
				data: {
					'api_key': api_key,
					'status': newStatus,
					'invoice': invoice,
				},
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					console.log(body);
					if(body.status == "success") {
						alert.simple("Successfully updated", "success");
						misc.wait(2);
						window.location.reload();
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @wip */
		printOrder() {
			// TODO: Send printer the customer order
		},
		/** @wip */
		printReciept() {
			// TODO: Send reciept printer order info
		}
	}
	/** @wip */
	product = {
		/** @final */
		create() {
			$.ajax({
				url: api_url + '/Product/',
				data: {
					'api_key': api_key,
					'title': $("div[name=title] input").val(),
					'collection': $("div[name=range]").find("option:selected").val(),
					'images': $("div[name=images] input").val(),
					'category': $("div[name=category]").find("option:selected").val(),
					'discontinued': (($("div[name=status] input[name=discontinued]:checked").length === 0) ? 0 : 1),
					'active': (($("div[name=status] input[name=available]:checked").length === 0) ? 0 : 1),
					'currency': $("div[name=currency] input").val(),
					'profit': $("div[name=profit] input").val(),
					'retail': $("div[name=retail] input").val(),
					'net': $("div[name=net] input").val(),
					'gross': $("div[name=gross] input").val(),
					'margin': $("div[name=margin] input").val(),
					'discounted': (($("div[name=pricing] input[name=discounted]:checked").length === 0) ? 0 : 1),
					'auto_calculate': (($("div[name=pricing] input[name=auto_calculate]:checked").length === 0) ? 0 : 1),
					'discount_type': $("div[name=discount_type]").find("option:selected").val(),
					'discount_amount': $("div[name=discount_amount] input").val(),
					'container': $("div[name=container]").find("option:selected").val(),
					'wick': $("div[name=wick]").find("option:selected").val(),
					'wick_stand': $("div[name=wick_stand]").find("option:selected").val(),
					'material': $("div[name=material]").find("option:selected").val(),
					'fragrance': $("div[name=fragrance]").find("option:selected").val(),
					'colour': $("div[name=colour]").find("option:selected").val(),
					'packaging': $("div[name=packaging]").find("option:selected").val(),
					'shipping': $("div[name=shipping]").find("option:selected").val(),
					'made_by': $("div[name=made_by]").find("option:selected").val(),
					'description_long': misc.mcebogus(encodeURIComponent($("div[name=description_long] iframe").contents().find('.mce-content-body').html())),
					'description_short': misc.mcebogus(encodeURIComponent($("div[name=description_short] iframe").contents().find('.mce-content-body').html())),
					'slug': $("div[name=slug] input").val(),
				},
				type: 'PUT',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Products/Edit/'+body.info.sku+'/?al_ty=success&al_tx=Successfully updated the product');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		update(pid) {
			$.ajax({
				url: api_url + '/Product/',
				data: {
					'api_key': api_key,
					'id': pid,
					'title': $("div[name=title] input").val(),
					'collection': $("div[name=range]").find("option:selected").val(),
					'images': $("div[name=images] input").val(),
					'category': $("div[name=category]").find("option:selected").val(),
					'discontinued': (($("div[name=status] input[name=discontinued]:checked").length === 0) ? 0 : 1),
					'active': (($("div[name=status] input[name=available]:checked").length === 0) ? 0 : 1),
					'currency': $("div[name=currency] input").val(),
					'profit': $("div[name=profit] input").val(),
					'retail': $("div[name=retail] input").val(),
					'net': $("div[name=net] input").val(),
					'gross': $("div[name=gross] input").val(),
					'margin': $("div[name=margin] input").val(),
					'discounted': (($("div[name=pricing] input[name=discounted]:checked").length === 0) ? 0 : 1),
					'auto_calculate': (($("div[name=pricing] input[name=auto_calculate]:checked").length === 0) ? 0 : 1),
					'discount_type': $("div[name=discount_type]").find("option:selected").val(),
					'discount_amount': $("div[name=discount_amount] input").val(),
					'container': $("div[name=container]").find("option:selected").val(),
					'wick': $("div[name=wick]").find("option:selected").val(),
					'wick_stand': $("div[name=wick_stand]").find("option:selected").val(),
					'material': $("div[name=material]").find("option:selected").val(),
					'fragrance': $("div[name=fragrance]").find("option:selected").val(),
					'colour': $("div[name=colour]").find("option:selected").val(),
					'packaging': $("div[name=packaging]").find("option:selected").val(),
					'shipping': $("div[name=shipping]").find("option:selected").val(),
					'made_by': $("div[name=made_by]").find("option:selected").val(),
					'description_long': misc.mcebogus(encodeURIComponent($("div[name=description_long] iframe").contents().find('.mce-content-body').html())),
					'description_short': misc.mcebogus(encodeURIComponent($("div[name=description_short] iframe").contents().find('.mce-content-body').html())),
					'slug': $("div[name=slug] input").val(),
				},
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Products/?al_ty=success&al_tx=Successfully updated the product');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		delete(pid) {
			$.ajax({
				url: api_url + '/Product/',
				data: {
					'api_key': api_key,
					'id': pid,
				},
				type: 'DELETE',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Products/?al_ty=success&al_tx=Successfully deleted the product');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		calculate() {
			container_size	= Number($("div[name=container]").find("option:selected").attr('size'));
			container_price	= Number($("div[name=container]").find("option:selected").attr('price'));
			wick_price		= Number($("div[name=wick]").find("option:selected").attr('price'));
			wickStand_price	= Number($("div[name=wick_stand]").find("option:selected").attr('price'));
			material_price	= Number($("div[name=material]").find("option:selected").attr('price'));
			fragrance_price	= Number($("div[name=fragrance]").find("option:selected").attr('price'));
			colour_price	= Number($("div[name=colour]").find("option:selected").attr('price'));
			packaging_price	= Number($("div[name=packaging]").find("option:selected").attr('price'));
			shipping_price	= Number($("div[name=shipping]").find("option:selected").attr('price'));
			margin			= Number($("div[name=margin] input").val());
			discount_type	= Number($("div[name=discount_type]").find("option:selected").attr('value'));
			discount_amount = Number($("div[name=discount_amount] input").val());

			// Calculate the final prices
			grossPrice = (container_price + wick_price + wickStand_price + (material_price * container_size) + (fragrance_price * container_size) + (colour_price * container_size) + packaging_price + shipping_price).toFixed(2);
			net = (Number(grossPrice) + (grossPrice * (margin / 100))).toFixed(2);
			if(discount_type == 1) { // Percentage
				netPrice = (net - (net * (discount_amount / 100))).toFixed(2);
			} else if(discount_type == 2) {
				netPrice = (net - discount_amount).toFixed(2);
			} else {
				netPrice = net;
			}
			netProfit = (netPrice - grossPrice).toFixed(2);

			// Round to nearest 5 0r 9
			retailPrice = misc.closestNum(grossPrice, [
				(misc.round(netPrice, 1.00) - 0.00).toFixed(2),	// 00
				(misc.round(netPrice, 0.10) - 0.01).toFixed(2),	// 09, 19, 29, 39, 49, 59, 69, 79, 89, 99
				(misc.round(netPrice, 0.10) - 0.05).toFixed(2),	// 05, 15, 25, 35, 45, 55, 65, 75, 85, 95
			]);

			$('div[name=net]').find('input').val(netPrice);
			$('div[name=gross]').find('input').val(grossPrice);
			$('div[name=profit]').find('input').val(netProfit);
			$('div[name=retail]').find('input').val(retailPrice);
		},
		/** @final */
		generateBarcode(u) {
			var upc = u.split('');
			var ns = u.substring(0, 1); //Number System
			var mc = u.substring(1, 6); //Manufactures Code
			var pc = u.substring(6, 11); //Product Code
			var cd = u.substring(11, 12); //Check Digit

			// Modules for barcodes
			var sg = ["101"]; //Start and End Guards are 3 modules
			var mg = ["01010"]; //Middle Guard is 5 modules
			// Left side of the Middle Guard (manufactures code) is odd parity
			var op = ["0001101", "0011001", "0010011", "0111101", "0100011", "0110001", "0101111", "0111011", "0110111", "0001011"];
			// Right side of Middle Guard (product code) is even parity
			var ep = ["1110010", "1100110", "1101100", "1000010", "1011100", "1001110", "1010000", "1000100", "1001000", "1110100"];

			// Loop through the first 6 digits of the barcode and find their corresponding modules in the odd parity array
			upcOP = "";
			var i = 0;
			while (i <= 5) {
				upcOP += op[upc[i]];
				i++;
			}
			// Loop through the last 6 digits of the barcode and find their corresponding modules in the even parity array
			upcEP = "";
			var i = 6;
			while (i <= 11) {
				upcEP += ep[upc[i]];
				i++;
			}

			// Create a string of all the modules including the guards
			var data = sg + upcOP + mg + upcEP + sg;

			// Set height and width of the barcode modules
			var height = 300,
				barWidth = 6;

			// Sets scale range for barcode
			var x = d3.scale.linear()
				.domain([0, d3.max(data)]) // length
			.range([0, height]); // height

			d3.select("#upcCode").remove(); //Clear the SVG container if a new upc code has been entered
			// Select container div and create new holder for the upc
			var chart = d3.select("#barcodeContainer").append("svg:svg").attr("id", "upcCode")
			// Set the size of the upc holder
			var chart = d3.select("#upcCode").attr("height", "390px").attr("width", barWidth * data.length + 120);

			// Draw the barcode
			var bar = chart.selectAll("g")
				.data(data)
				.enter().append("g")
				.attr("transform", function (d, i) {
				return "translate(" + i * barWidth + ")";
			});
			bar.append("rect").attr("x",60).attr("height",function(d, i) { 
				if (i==0||i==2||i==46||i==48||i==92||i==94){
					return (d*300)
				} else {
					return (d*240)
				};
			}).attr("width", barWidth);

			// Write human readable numbers under the barcode
			chart.append("g")
				.append("text")
				.attr("x", "3px")
				.attr("y", "300px")
				.style("font-size", "72px")
				.style("font-family", "sans-serif")
				.text(ns);
			chart.append("g")
				.append("text")
				.attr("x", "114px")
				.attr("y", "300px")
				.style("font-size", "72px")
				.style("font-family", "sans-serif")
				.text(mc);
			chart.append("g")
				.append("text")
				.attr("x", "384px")
				.attr("y", "300px")
				.style("font-size", "72px")
				.style("font-family", "sans-serif")
				.text(pc);
			chart.append("g")
				.append("text")
				.attr("x", "645px")
				.attr("y", "300px")
				.style("font-size", "72px")
				.style("font-family", "sans-serif")
				.text(cd);

			$('#productBarcodeModal').modal('show');
		},
		/** @final */
		downloadBarcode() {
			var svg = document.querySelector("#barcodeContainer > svg");
			var svg_xml = (new XMLSerializer).serializeToString(svg);
			var blob = new Blob([svg_xml]);
			var url = window.URL || window.webkitURL;
			var blobURL = url.createObjectURL(blob);
			var a = document.createElement('a');
			a.download = "Barcode.svg";
			a.href = blobURL;
			document.body.appendChild(a);
			a.click();
		},
		/** @wip */
		comodities: {
			/** @wip */
			container: {
				/** @wip */
				create() {
					$.ajax({
						url: api_url + '/Product/Container/' + cid + '/',
						data: {
							'api_key': api_key,
							'name': $("div[name=name] input").val(),
							'supplier': $("div[name=supplier]").find("option:selected").val(),
							'supplier_ref': $("div[name=itemref] input").val(),
							'size': $("div[name=size] input").val(),
							'price_b': $("div[name=price_b] input").val(),
							'quantity': $("div[name=quantity] input").val(),
							'price_e': $("div[name=price_e] input").val(),
							'active': (($("div[name=status] input[name=active]:checked").length === 0) ? 0 : 1),
						},
						type: 'POST',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							if(body.status == "success") {
								$(location).attr('href', '/Products/Containers/?al_ty=success&al_tx=Successfully created the container');
							} else {
								alert.simple("An error has occurred. Please try again later", "danger");
							}
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
				/** @wip */
				update(cid) {
					$.ajax({
						url: api_url + '/Product/Container/' + cid + '/',
						data: {
							'api_key': api_key,
							'name': $("div[name=name] input").val(),
							'supplier': $("div[name=supplier]").find("option:selected").val(),
							'supplier_ref': $("div[name=itemref] input").val(),
							'size': $("div[name=size] input").val(),
							'price_b': $("div[name=price_b] input").val(),
							'quantity': $("div[name=quantity] input").val(),
							'price_e': $("div[name=price_e] input").val(),
							'active': (($("div[name=status] input[name=active]:checked").length === 0) ? 0 : 1),
						},
						type: 'POST',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							if(body.status == "success") {
								$(location).attr('href', '/Products/Containers/?al_ty=success&al_tx=Successfully updated the container');
							} else {
								alert.simple("An error has occurred. Please try again later", "danger");
							}
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
				/** @wip */
				delete() {
					// TODO: Delete container
				},
				/** @final */
				calculate() {
					price_b	= Number($("div[name=price_b] input").val());
					quantity= Number($("div[name=quantity] input").val());
					$('div[name=price_e] input').val((price_b / quantity).toFixed(2));
				},
			},
			/** @wip */
			wick: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
			/** @wip */
			wick_stand: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
			/** @wip */
			material: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
			/** @wip */
			fragrance: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
			/** @wip */
			colour: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
			/** @wip */
			packaging: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
			/** @wip */
			shipping: {
				/** @wip */
				create() {
					/** @todo */
				},
				/** @wip */
				update(id) {
					/** @todo */
				},
				/** @wip */
				delete(id) {
					/** @todo */
				},
				/** @wip */
				calculate() {
					/** @todo */
				},
			},
		}
	}
	/** @final */
	search = {
		suggestions: null,
		jsonData: null,
		/** @final */
		initialize() {
			search.suggestions = $(".search-suggestions");
		},
		/** @final */
		process(ev) {
			if(ev.key == 'Enter'){
				var location = $(search.suggestions.children()[0]).find("a").attr("href");
				if(location !== undefined) {
					window.location = location;
				}
			} else {
				var key = ev.target.value;
				search.suggestions.html("");
				
				search.dispaySuggestions(search.jsonData.filter((data)=>{
					var regex = new RegExp(key, "i");
					return data.name.match(regex) || data.desc.match(regex) || data.url.match(regex);
				}));
			}
		},
		/** @final */
		dispaySuggestions(Arr) {
			for(var i=0; i<Arr.length; i++) {
				search.suggestions.html(search.suggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
			}
		},
	}
	/** @final */
	supplier = {
		/** @final */
		create() {
			$.ajax({
				url: api_url + '/Supplier/',
				data: {
					'api_key': api_key,
					'reference': $("div[name=reference] input").val(),
					'name': $("div[name=name] input").val(),
					'website': $("div[name=website] input").val(),
					'email': $("div[name=email] input").val(),
					'phone': $("div[name=phone] input").val(),
					'hours': $("div[name=hours] input").val(),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0) ? 0 : 1),
				},
				type: 'PUT',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Suppliers/?al_ty=success&al_tx=Successfully created the supplier');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		update(sid) {
			$.ajax({
				url: api_url + '/Supplier/' + sid + '/',
				data: {
					'api_key': api_key,
					'reference': $("div[name=reference] input").val(),
					'name': $("div[name=name] input").val(),
					'email': $("div[name=email] input").val(),
					'phone': $("div[name=phone] input").val(),
					'hours': $("div[name=hours] input").val(),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0) ? 0 : 1),
				},
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Suppliers/?al_ty=success&al_tx=Successfully updated the supplier information');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		delete(sid) {
			$.ajax({
				url: api_url + '/Supplier/' + sid + '/',
				data: {
					'api_key': api_key,
				},
				type: 'DELETE',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Users/?al_ty=success&al_tx=Successfully deleted the supplier');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
	}
	/** @final */
	user = {
		/** @final */
		create() {
			$.ajax({
				url: api_url + '/Users/',
				data: {
					'api_key': api_key,
					'uname': $("div[name=username] input").val(),
					'fname': $("div[name=firstname] input").val(),
					'lname': $("div[name=lastname] input").val(),
					'email': $("div[name=email] input").val(),
					'phone': $("div[name=phone] input").val(),
					'r_pass': (($("div[name=misc] input[name=reset_pass]:checked").length === 0) ? 0 : 1),
					'd_analytics': (($("div[name=misc] input[name=disable_analytics]:checked").length === 0) ? 0 : 1),
					'e_active': (($("div[name=misc] input[name=email_active]:checked").length === 0) ? 0 : 1),
					'u_active': (($("div[name=misc] input[name=user_active]:checked").length === 0) ? 0 : 1),
				},
				type: 'PUT',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Users/Edit'+body.info.id+'/?al_ty=success&al_tx=Successfully created the user');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		update(uid) {
			$.ajax({
				url: api_url + '/Users/' + uid + '/',
				data: {
					'api_key': api_key,
					'uname': $("div[name=username] input").val(),
					'fname': $("div[name=firstname] input").val(),
					'lname': $("div[name=lastname] input").val(),
					'email': $("div[name=email] input").val(),
					'phone': $("div[name=phone] input").val(),
					'r_pass': (($("div[name=misc] input[name=reset_pass]:checked").length === 0) ? 0 : 1),
					'd_analytics': (($("div[name=misc] input[name=disable_analytics]:checked").length === 0) ? 0 : 1),
					'e_active': (($("div[name=misc] input[name=email_active]:checked").length === 0) ? 0 : 1),
					'u_active': (($("div[name=misc] input[name=user_active]:checked").length === 0) ? 0 : 1),
				},
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Users/?al_ty=success&al_tx=Successfully updated the user');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		delete(uid) {
			$.ajax({
				url: api_url + '/Users/' + uid + '/',
				data: {
					'api_key': api_key,
				},
				type: 'DELETE',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Users/?al_ty=success&al_tx=Successfully deleted the user');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		savePerm(uid) {
			data = {
				'api_key': api_key,
			};
			$.each($(".form-check").find("label"), function() {
				var name = $(this).attr('for'),
					isChecked = (($("input#"+name+":checked").length === 0) ? 0 : 1);
				data[name] = isChecked;
			});
			$.ajax({
				url: api_url + '/Users/Perms/' + uid + '/',
				data: data,
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Users/Edit/'+uid+'?al_ty=success&al_tx=Successfully updated the users permissions');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
	}
	/** @final */
	website = {
		/** @final */
		domain: {
			/** @final */
			create() {
				var styles = [];	$("div[name=styles]").children().find("input[type=checkbox]:checked").each((index, element) => { styles.push($(element).val()); });
				var scripts = [];	$("div[name=scripts]").children().find("input[type=checkbox]:checked").each((index, element) => { scripts.push($(element).val()); });
				$.ajax({
					url: api_url + '/Website/',
					data: {
						'api_key': api_key,
						'styles': styles.join(","),
						'scripts': scripts.join(","),
						'name': $("div[name=name] input").val(),
						'domain': $("div[name=domain] input").val(),
						'page_type': $("div[name=page_type]").find("option:selected").val(),
						'maintenance': (($("div[name=status] input[name=maintenance]:checked").length === 0)?0:1),
						'meta_title': $("div[name=meta_title]").find("input").val(),
						'meta_keywords': $("div[name=meta_keywords]").find("input").val(),
						'meta_description': $("div[name=meta_description]").find("input").val(),
						'meta_colour': $("div[name=meta_colour]").find("input").val(),
						'title': $("div[name=title]").find("input").val(),
						'slogan': $("div[name=slogan]").find("input").val(),
						'email': $("div[name=email]").find("input").val(),
						'phone': $("div[name=phone]").find("input").val(),
						'primary_colour': $("div[name=primary_colour]").find("input").val(),
						'secondary_colour': $("div[name=secondary_colour]").find("input").val(),
						'logo': $("div[name=logo]").find("input").val(),
						'favicon': $("div[name=favicon]").find("input").val(),
						'permission': $("div[name=permission]").find("option:selected").val(),
					},
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/?al_ty=success&al_tx=Successfully created the website');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			update(sid) {
				var styles = [];	$("div[name=styles]").children().find("input[type=checkbox]:checked").each((index, element) => { styles.push($(element).val()); });
				var scripts = [];	$("div[name=scripts]").children().find("input[type=checkbox]:checked").each((index, element) => { scripts.push($(element).val()); });
				$.ajax({
					url: api_url + '/Website/' + sid + '/',
					data: {
						'api_key': api_key,
						'styles': styles.join(","),
						'scripts': scripts.join(","),
						'name': $("div[name=name] input").val(),
						'domain': $("div[name=domain] input").val(),
						'page_type': $("div[name=page_type]").find("option:selected").val(),
						'maintenance': (($("div[name=status] input[name=maintenance]:checked").length === 0)?0:1),
						'meta_title': $("div[name=meta_title]").find("input").val(),
						'meta_keywords': $("div[name=meta_keywords]").find("input").val(),
						'meta_description': $("div[name=meta_description]").find("input").val(),
						'meta_colour': $("div[name=meta_colour]").find("input").val(),
						'title': $("div[name=title]").find("input").val(),
						'slogan': $("div[name=slogan]").find("input").val(),
						'email': $("div[name=email]").find("input").val(),
						'phone': $("div[name=phone]").find("input").val(),
						'primary_colour': $("div[name=primary_colour]").find("input").val(),
						'secondary_colour': $("div[name=secondary_colour]").find("input").val(),
						'logo': $("div[name=logo]").find("input").val(),
						'favicon': $("div[name=favicon]").find("input").val(),
						'permission': $("div[name=permission]").find("option:selected").val(),
					},
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/?al_ty=success&al_tx=Successfully updated the website');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			delete(sid) {
				$.ajax({
					url: api_url + '/Website/' + sid + '/',
					data: {
						'api_key': api_key,
					},
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/?al_ty=success&al_tx=Successfully deleted the website');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
		},
		/** @final */
		page: {
			/** @final */
			create() {
				var styles = [];	$("div[name=styles]").children().find("input[type=checkbox]:checked").each((index, element) => { styles.push($(element).val()); });
				var scripts = [];	$("div[name=scripts]").children().find("input[type=checkbox]:checked").each((index, element) => { scripts.push($(element).val()); });
				$.ajax({
					url: api_url + '/Page/',
					data: {
						'api_key': api_key,
						'style': styles.join(","),
						'script': scripts.join(","),
						'name': $("div[name=name] input").val(),
						'title': $("div[name=title] input").val(),
						'page_url': $("div[name=page_url] input").val(),
						'subpage_url': $("div[name=subpage_url] input").val(),
						'domain_id': $("div[name=domain]").find("option:selected").val(),
						'menu_item': (($("div[name=menu_item] input:checked").length === 0)?0:1),
						'menu_order': $("div[name=menu_order] input").val(),
						'menu_icon': $("div[name=menu_icon] input").val(),
						'permission': $("div[name=permission]").find("option:selected").val(),
					},
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/Page/'+body.info.id+'/?al_ty=success&al_tx=Successfully created the webpage');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			update(pid) {
				var styles = [];	$("div[name=styles]").children().find("input[type=checkbox]:checked").each((index, element) => { styles.push($(element).val()); });
				var scripts = [];	$("div[name=scripts]").children().find("input[type=checkbox]:checked").each((index, element) => { scripts.push($(element).val()); });
				$.ajax({
					url: api_url + '/Page/' + pid + '/',
					data: {
						'api_key': api_key,
						'style': styles.join(","),
						'script': scripts.join(","),
						'name': $("div[name=name] input").val(),
						'title': $("div[name=title] input").val(),
						'page_url': $("div[name=page_url] input").val(),
						'subpage_url': $("div[name=subpage_url] input").val(),
						'domain_id': $("div[name=domain]").find("option:selected").val(),
						'menu_item': (($("div[name=menu_item] input:checked").length === 0)?0:1),
						'menu_order': $("div[name=menu_order] input").val(),
						'menu_icon': $("div[name=menu_icon] input").val(),
						'permission': $("div[name=permission]").find("option:selected").val(),
					},
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/Pages/'+body.info.domain_id+'/?al_ty=success&al_tx=Successfully updated the webpage');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			delete(pid) {
				data = {
					'api_key': api_key,
				}
				$.ajax({
					url: api_url + '/Page/' + pid + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/?al_ty=success&al_tx=Successfully deleted the webpage');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
		},
		/** @final */
		layout: {
			/** @final */
			update(pid) {
				var elementIds = [];
				var elementString = "";
				$('.templateBase [element-id]').each(function() {
					var hasInput = false;
					$(this).children().first().children().each(function() {
						if($(this).prop('nodeName') == 'INPUT' && $(this).val() != '') {
							hasInput = true;
							inputVal = $(this).val();
						}
					})
					if(hasInput) {
						if($(this).parent().hasClass('templateBase')) {
							elementIds.push('$1|#12;'+$(this).attr('element-id')+':'+inputVal)
						} else {
							elementIds.push($(this).attr('element-id')+':'+inputVal)
						}
					} else {
						if($(this).parent().hasClass('templateBase') && !$(this).attr('element-id').startsWith('$')) {
							elementIds.push('$1|#12;'+$(this).attr('element-id'))
						} else {
							elementIds.push($(this).attr('element-id'))
						}
					}
				})
				for(let i = 0; i < elementIds.length; i++) {
					if(	elementString.endsWith(';') ||
						elementIds[i].startsWith('#') ||
						elementIds[i].startsWith('$') ||
						elementString == "") {
						elementString += elementIds[i];
					} else {
						elementString += ','+ elementIds[i];
					}
				}
				data = {
					'api_key': api_key,
					'display_type': (($("input[name=display_type]:checked").length === 0)?0:1),
					'sections': elementString,
					'page': $("div[name=name] input").val(),
				}
				$.ajax({
					url: api_url + '/Page/Layout/' + pid + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						alert.simple("Successfully updated the page layout", "success");
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			initializeOxygen() {
				$('.templateBase').innerHTML = "";
				var sectionString = $('section .sections').attr('data-original-sections');
				if(sectionString != "") {
					var contained, colCount, currCol, elemID, elementString='';
					var sections, columns, elements, cols = [];
					sections = sectionString.split('$')
					sections.shift();
					sections.forEach(function(section) {
						columns = section.split('#');
						colCount = columns[0].replace('|', '');
						currCol = 0;
						columns.shift();
						// build the structure and columns
						if(colCount > 1) {
							let floatingVal=0,
								left=0;
							contained = true;
							parent = $("div[element-id='$"+colCount+"|']").clone().appendTo('.templateBase').removeClass('accordion-collapse collapse show').removeAttr('data-bs-parent id').children().each(function() {
								$(this).removeClass('accordion-body');
							});
							website.layout.initializeSliders();
							children = $(parent).find('.templateGrid');
							sliders = $(parent).find('.ui-slider-handle');
							for (let i = 0; i < children.length; i++) {
								width = parseInt(columns[i].split(';')[0]);
								floatingVal += width;
								$(children[i]).removeClass(function() {
									var toReturn = "",
										classes = this.className.split(' ');
									for(var i = 0; i < classes.length; i++ ) {
										if( /col-([0-9])+/.test( classes[i] ) ) { /* Filters */
											toReturn += classes[i] +' ';
										}
									}
									return toReturn; /* Returns all classes to be removed */
								}).attr('element-id', '#'+width+';').addClass("col-"+width);
								left = (100 / 12) * floatingVal;
								$(sliders[i]).css('left', left+'%')
							}
						} else {
							contained = false;
						}
						// Place the lements within the columns
						columns.forEach(function(column) {
							elements = column.split(';').pop().split(',');
							elements.forEach(function(element) {
								[elemID, elementString] = element.split(':');
								if(contained) {
									cols = $("div[element-id='$"+colCount+"|']").last().find('.dragulaContainer');
									el = $("div[element-id='"+elemID+"']").clone().appendTo(cols[currCol]).removeClass('accordion-collapse collapse show').removeAttr('data-bs-parent id').children().each(function() {
										$(this).removeClass('accordion-body');
										$(this).find('input').first().val(elementString);
									});
								} else {
									$("div[element-id='"+elemID+"']").clone().appendTo('.templateBase').removeClass('accordion-collapse collapse show').removeAttr('data-bs-parent id').children().each(function() {
										$(this).removeClass('accordion-body');
										$(this).find('input').first().val(elementString);
									});
								}
							})
							currCol++;
						})
					})
				} else {
					$('.templateBase').html("<p>Drag an element from the left hand side to start building the website!</p>");
				}
			},
			/** @final */
			rangeMovement(event, ui) {
				// Vars
					var parentGrid = $(event.target).parent().parent()[0],
						containers = $(parentGrid).find(".templateGrid");
					let lColCurr=null,
						lColNew=null,
						rColCurr=null,
						rColNew=null,
						handle=parseInt(ui.handleIndex),
						value=parseInt(ui.value);
				// Left column
					// remove class col-x
						$(containers[handle]).removeClass(function() {
							var toReturn = '',
								classes = this.className.split(' ');
							for(var i = 0; i < classes.length; i++ ) {
								if( /col-[0-9]+/.test( classes[i] ) ) { /* Filters */
									toReturn += classes[i] +' ';
									lColCurr = parseInt(classes[i].substring(4));
								}
							}
							return toReturn; /* Returns all classes to be removed */
						});
					// add class col-x and element-id attribute
						if(handle > 0) {
							lColNew = parseInt(value - ui.values[handle-1]);
						} else {
							lColNew = parseInt(lColCurr - (lColCurr - value));
						}
						$(containers[handle]).attr('element-id', '#'+lColNew+';')
						$(containers[handle]).addClass("col-"+lColNew);
				// Righ column.
					// remove class col-x
						$(containers[handle+1]).removeClass(function() {
							var toReturn = '',
								classes = this.className.split(' ');
							for(var i = 0; i < classes.length; i++ ) {
								if( /col-([0-9])+/.test( classes[i] ) ) { /* Filters */
									toReturn += classes[i] +' ';
									rColCurr = parseInt(classes[i].substring(4));
								}
							}
							return toReturn; /* Returns all classes to be removed */
						});
					// add class col-x and element-id attribute
						if(handle > 0) {
							rColNew = parseInt(rColCurr + (lColCurr - (value - ui.values[handle-1])));
						} else {
							rColNew = parseInt(rColCurr + (lColCurr - value));
						}
						$(containers[handle+1]).attr('element-id', '#'+rColNew+';')
						$(containers[handle+1]).addClass("col-"+rColNew);
				//
			},
			/** @final */
			initializeSliders() {
				$('.templateBase .range-2').each(function() {
					if(!$(this).hasClass('initialized')) {
						$(this).limitslider({
							slide: function(event, ui) {
								website.layout.rangeMovement(event, ui);
							},
							values:	[ 6 ],
							min:		0,
							max:		12,
							left:		1,
							right:		11,
							step:		1,
							gap:		1,
						});
						$(this).addClass('initialized');
					}
				});
				$('.templateBase .range-3').each(function() {
					if(!$(this).hasClass('initialized')) {
						$(this).limitslider({
							slide: function(event, ui) {
								website.layout.rangeMovement(event, ui);
							},
							values:	[ 4, 8 ],
							min:		0,
							max:		12,
							left:		1,
							right:		11,
							step:		1,
							gap:		1,
						});
						$(this).addClass('initialized');
					}
				});
				$('.templateBase .range-4').each(function() {
					if(!$(this).hasClass('initialized')) {
						$(this).limitslider({
							slide: function(event, ui) {
								website.layout.rangeMovement(event, ui);
							},
							values: [ 3, 6, 9 ],
							min:		0,
							max:		12,
							left:		1,
							right:		11,
							step:		1,
							gap:		1,
						});
						$(this).addClass('initialized');
					}
				});
				$('.templateBase .range-5').each(function() {
					if(!$(this).hasClass('initialized')) {
						$(this).limitslider({
							slide: function(event, ui) {
								website.layout.rangeMovement(event, ui);
							},
							values: [ 2, 4, 8, 10 ],
							min:		0,
							max:		12,
							left:		1,
							right:		11,
							step:		1,
							gap:		1,
						});
						$(this).addClass('initialized');
					}
				});
				$('.templateBase .range-6').each(function() {
					if(!$(this).hasClass('initialized')) {
						$(this).limitslider({
							slide: function(event, ui) {
								website.layout.rangeMovement(event, ui);
							},
							values: [ 2, 4, 6, 8, 10 ],
							min:		0,
							max:		12,
							left:		1,
							right:		11,
							step:		1,
							gap:		1,
						});
						$(this).addClass('initialized');
					}
				});
			}
		},
		/** @final */
		style: {
			/** @final */
			create() {
				data = {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'location': $("div[name=location] input").val(),
					'importance': $("div[name=importance] input").val(),
					'preload': (($("div[name=status] input[name=preload]:checked").length === 0)?0:1),
					'active': (($("div[name=status] input[name=active]:checked").length === 0)?0:1),
				}
				$.ajax({
					url: api_url + '/Website/Style/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/styles/?al_ty=success&al_tx=Successfully created the stylesheet');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			update(id) {
				data = {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'location': $("div[name=location] input").val(),
					'importance': $("div[name=importance] input").val(),
					'preload': (($("div[name=status] input[name=preload]:checked").length === 0)?0:1),
					'active': (($("div[name=status] input[name=active]:checked").length === 0)?0:1),
				}
				$.ajax({
					url: api_url + '/Website/Style/' + id + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/styles/?al_ty=success&al_tx=Successfully updated the stylesheet');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			delete(id) {
				data = {
					'api_key': api_key,
				}
				$.ajax({
					url: api_url + '/Website/Style/' + id + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/styles/?al_ty=success&al_tx=Successfully deleted the stylesheet');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			}
		},
		/** @final */
		script: {
			/** @final */
			create() {
				data = {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'location': $("div[name=location] input").val(),
					'importance': $("div[name=importance] input").val(),
					'active': (($("div[name=status] input[name=active]:checked").length === 0)?0:1),
				}
				$.ajax({
					url: api_url + '/Website/Script/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/scripts/?al_ty=success&al_tx=Successfully created the script');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			update(id) {
				data = {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'location': $("div[name=location] input").val(),
					'importance': $("div[name=importance] input").val(),
					'active': (($("div[name=status] input[name=active]:checked").length === 0)?0:1),
				}
				$.ajax({
					url: api_url + '/Website/Script/' + id + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/scripts/?al_ty=success&al_tx=Successfully updated the script');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
				
			},
			/** @final */
			delete(id) {
				data = {
					'api_key': api_key,
				};
				$.ajax({
					url: api_url + '/Website/Script/' + id + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/scripts/?al_ty=success&al_tx=Successfully deleted the script');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			}
		},
		/** @final */
		theme: {
			/** @final */
			create() {
				data = {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'description': $("div[name=description] input").val(),
					'location': $("div[name=location] input").val(),
					'active': (($("div[name=status] input[name=active]:checked").length === 0) ? 0 : 1),
				};
				$.ajax({
					url: api_url + '/Website/Theme/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/themes/?al_ty=success&al_tx=Successfully created the theme');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			update(id) {
				data = {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'description': $("div[name=description] input").val(),
					'location': $("div[name=location] input").val(),
					'active': (($("div[name=status] input[name=active]:checked").length === 0) ? 0 : 1),
				};
				$.ajax({
					url: api_url + '/Website/Theme/' + id + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/themes/?al_ty=success&al_tx=Successfully updated the theme');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			/** @final */
			delete(id) {
				data = {
					'api_key': api_key,
				};
				$.ajax({
					url: api_url + '/Website/Theme/' + id + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						if(body.status == "success") {
							$(location).attr('href', '/Websites/themes/?al_ty=success&al_tx=Successfully deleted the theme');
						} else {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			}
		},
	};
	/** @final */
	promotion = {
		/** @todo: Redirect after success */
		create() {
			var categories = [];	$("div[name=categories]").children().find("input[type=checkbox]:checked").each((index, element) => { categories.push($(element).val()); });
			var collections = [];	$("div[name=collections]").children().find("input[type=checkbox]:checked").each((index, element) => { collections.push($(element).val()); });
			$.ajax({
				url: api_url + '/Promotion/',
				data: {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'description': $("div[name=description] textarea").val(),
					'percentage': $("div[name=percentage] input").val(),
					'start': $("div[name=start]").find("input").val(),
					'end': $("div[name=end]").find("input").val(),
					'voucher': $("div[name=voucher]").find("input").val(),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0)?0:1),
					'type': (($("div[name=misc] input[name=voucher]:checked").length === 0)?0:1),
					'categories': categories.join(","),
					'collections': collections.join(","),
				},
				type: 'PUT',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Promotions/?al_ty=success&al_tx=Successfully created the promotion');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		update(id) {
			var categories = [];	$("div[name=categories]").children().find("input[type=checkbox]:checked").each((index, element) => { categories.push($(element).val()); });
			var collections = [];	$("div[name=collections]").children().find("input[type=checkbox]:checked").each((index, element) => { collections.push($(element).val()); });
			$.ajax({
				url: api_url + '/Promotion/',
				data: {
					'api_key': api_key,
					'id': id,
					'name': $("div[name=name] input").val(),
					'description': $("div[name=description] textarea").val(),
					'percentage': $("div[name=percentage] input").val(),
					'start': $("div[name=start]").find("input").val(),
					'end': $("div[name=end]").find("input").val(),
					'voucher': $("div[name=voucher]").find("input").val(),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0)?0:1),
					'type': (($("div[name=misc] input[name=voucher]:checked").length === 0)?0:1),
					'categories': categories.join(","),
					'collections': collections.join(","),
				},
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == 'success') {
						$(location).attr('href', '/Promotions/?al_ty=success&al_tx=Successfully updated the promotion');
					} else {
						alert.simple('An error has occurred', 'warning')
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @todo: make */
		delete() {

		}
	}
	/** @final */
	partner = {
		/** @final */
		create() {
			$.ajax({
				url: api_url + '/Partner/',
				data: {
					'api_key': api_key,
					'name': $("div[name=name] input").val(),
					'slug': $("div[name=slug]").find("input").val(),
					'link': $("div[name=link]").find("input").val(),
					'phone': $("div[name=phone]").find("input").val(),
					'email': $("div[name=email]").find("input").val(),
					'desc_s': misc.mcebogus(encodeURIComponent($("div[name=description_short] iframe").contents().find('.mce-content-body').html())),
					'desc_l': misc.mcebogus(encodeURIComponent($("div[name=description_long] iframe").contents().find('.mce-content-body').html())),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0)?0:1),
					'public': (($("div[name=misc] input[name=public]:checked").length === 0)?0:1),
				},
				type: 'PUT',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Partners/?al_ty=success&al_tx=Successfully created the partner');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		},
		/** @final */
		update(id) {
			$.ajax({
				url: api_url + '/Partner/',
				data: {
					'api_key': api_key,
					'id': id,
					'name': $("div[name=name] input").val(),
					'slug': $("div[name=slug]").find("input").val(),
					'link': $("div[name=link]").find("input").val(),
					'phone': $("div[name=phone]").find("input").val(),
					'email': $("div[name=email]").find("input").val(),
					'desc_l': misc.mcebogus(encodeURIComponent($("div[name=description_long] iframe").contents().find('.mce-content-body').html())),
					'desc_s': misc.mcebogus(encodeURIComponent($("div[name=description_short] iframe").contents().find('.mce-content-body').html())),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0)?0:1),
					'public': (($("div[name=misc] input[name=public]:checked").length === 0)?0:1),
				},
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Partners/?al_ty=success&al_tx=Successfully updated the partner');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
				}
			});
		},
		/** @final */
		delete(id) {
			$.ajax({
				url: api_url + '/Partner/',
				data: {
					'api_key': api_key,
					'id': id,
				},
				type: 'DELETE',
				xhrFields: {
					withCredentials: true,
				},
				success(body) {
					if(body.status == "success") {
						$(location).attr('href', '/Partners/?al_ty=success&al_tx=Successfully deleted the partner');
					} else {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				},
				error(body) {
					alert.simple("An error has occurred. Please try again later", "danger");
				}
			});
		}
	}
$(document).ready(function() {
	// -----========== Re-auth Zoho ==========----- // @wip //
		$('.zoho-status.error').click(()=>{
			// Request auth	code
			var win = window.open('https://accounts.zoho.eu/oauth/v2/auth?scope=ZohoMail.messages.ALL,ZohoMail.attachments.ALL,ZohoMail.tags.ALL,ZohoMail.folders.ALL&client_id='+$('.zoho-status').attr('cid')+'&response_type=code&access_type=offline&redirect_uri=http://admin.candlestick-indev.co.uk/OauthCallback.php', 'Zoho OAuth', 'scrollbars=no,resizable=yes,status=no,location=no,toolbar=no,menubar=no,width=0,height=0,left=0,top=0');
			var timer = setInterval(function() {
				if(win.closed) {  
					clearInterval(timer);
					//window.location.reload(false);
				}  
			}, 1000); 
			// Request Access & Refresh Code

			// Save codes to DB
		})
	// -----========== Dark mode toggle ==========----- // @final //
		mode.initialize();
		mode.switch.click(() => { mode.toggle(); });
	// -----========== Search ==========----- // @final //
		search.initialize();
		$(".search-area input").focusout(() => {if(search.suggestions.filter(":hover").length === 0) search.suggestions.hide();});
		$(".search-area input").focusin(() => {search.suggestions.show();});
		$.get($('.search-wrapper').attr('rel'), (data) => {search.jsonData = data})
	// -----========== MENU BTN ==========----- // @final //
		$('.app-icon').click(function() {$('.app-sidebar').toggleClass('sidebar-show');})
	// -----========== BACK BTN ==========----- // @final //
		if(document.referrer.indexOf(location.protocol + "//" + location.host) !== 0 && misc.getQueryParams('force_back') === null) {$('.app-back-btn').addClass('disabled')}
		$(".app-back-btn").click(function() {if(!$(".app-back-btn").hasClass('disabled'))history.back();});
	// -----========== Alerts on load ==========----- // @final //
		if(misc.getQueryParams('al_ty') != null && misc.getQueryParams('al_tx') != null) alert.simple(decodeURIComponent(misc.getQueryParams('al_tx')), decodeURIComponent(misc.getQueryParams('al_ty')));
	// -----========== Preloader ==========----- // @final //
		$(window).bind('beforeunload', () => {
			newURI = document.activeElement.href;
			console.log(newURI);
			$('.app-preloader').fadeIn();
			if (newURI.startsWith("mailto:") ||
				newURI.startsWith("tel:")) {
				$('.app-preloader').fadeOut();
			}
		});
		$('.app-preloader').fadeOut();
	// -----========== Tool tips ==========----- // @final //
		$('[data-toggle="tooltip"]').tooltip();
	// -----========== OXYGEN builder ==========----- // @final //
		$('input[name=display_type]').change(function() {
			if($('input[name=display_type]:checked').length === 0) {
				$('label[for=display_type]').html('Sections?');
				$('div[type=sections]').hide();
				$('div[type=page]').show();
			} else {
				$('label[for=display_type]').html('Page?');
				$('div[type=sections]').show();
				$('div[type=page]').hide();
			}
		});
	// -----========== Auto-calculate product ==========----- // @final //
		$('input[name=auto_calculate]').change(function() {
			if($('input[name=auto_calculate]:checked').length === 0) {
				$('div[name=net]').find('input').prop('disabled', false);
				$('div[name=gross]').find('input').prop('disabled', false);
				$('div[name=profit]').find('input').prop('disabled', false);
				$('div[name=margin]').find('input').prop('disabled', true);
			} else {
				$('div[name=net]').find('input').prop('disabled', true);
				$('div[name=gross]').find('input').prop('disabled', true);
				$('div[name=profit]').find('input').prop('disabled', true);
				$('div[name=margin]').find('input').prop('disabled', false);
			}
		});
		$('input[name=discounted]').change(function() {
			if($('input[name=discounted]:checked').length === 0) {
				$('div[name=discount_type]').find('select').prop('disabled', true);
				$('div[name=discount_amount]').find('input').prop('disabled', true);
				$('div[name=discount_type]').find('select').val(-1);
				$('div[name=discount_amount]').find('input').val('0.00');
			} else {
				$('div[name=discount_type]').find('select').prop('disabled', false);
				$('div[name=discount_amount]').find('input').prop('disabled', false);
			}
		});
		if($('input[name=auto_calculate]:checked').length != 0) {
			$('div.ProductInfo').find('input, select').change(function() { product.calculate(); });
			$('div.ProductInfo').find('input, select').on('input', function() { product.calculate(); });
		}
		if($("div[name=currency]").length != 0) {$.get('/currencies.json', (data) =>{ misc.currencies = data; })}
		$('div[name=currency]').find('input').change(function() {
			symbol = misc.currSymbol($('div[name=currency] input').val());
			$('span.input-group-text#currSymbol').html(symbol);
		})
	// -----========== Auto-calculate comodities ==========----- // @wip //
		$('div.row.containers div[name=quantity] input, div[name=price_b] input').on('input', function() {product.comodities.container.calculate();});
	// -----========== Assistance nav ==========----- //
		if($(".assistanceNav").length != 0) {
			$.get('/assistance.json', (data) =>{
				assistance.jsonData = data;
				assistance.loadLV1();
			})
		}
	// -----========== EOF ==========----- //
});