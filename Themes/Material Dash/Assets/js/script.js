$(document).ready(() => {
	// -----========== VARIABLES ==========----- //
		const api_url = window.location.protocol+'//api.'+window.location.hostname.slice(6) + '/v1';
		const api_key = 'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
	// -----========== Nestled functions ==========----- //
		/** @wip */
		misc = {
			currencies: null,
			getQueryParams(params) {
				let regexp = new RegExp( '[?&]' + params + '=([^&#]*)', 'i' );
				let qString = regexp.exec(window.location.href);
				return qString ? qString[1] : null;
			},
			round(value, step) {
				step || (step = 1.0);
				var inv = 1.0 / step;
				return Math.ceil(value * inv) / inv;
			},
			closestNum(goal, numbers) {
				//numbers.reduce((prev, curr) => {
				//	return (Math.abs(curr - goal) < Math.abs(prev - goal) ? curr : prev);
				//});
				numbers.sort((a, b) => {
					return Math.abs(goal - a)-Math.abs(goal - b)
				})[0];
			},
			currSymbol(str) {
				Object.entries(misc.currencies).forEach(([key, value]) => {
					if(value.code == str) {
						return ''+value.symbol;
						console.log('FOUND: ' + value.symbol);
					}
				});
			},
			redirect() {

			},
			limit_characters(el) {

			},
			copyToClipboard(str) {
				var $temp = $("<input>");
				$("body").append($temp);
				$temp.val(str).select();
				document.execCommand("copy");
				$temp.remove();
			},
			openInNewTab(str) {
				window.open(str, '_blank');
				window.focus();
			},
		}
		/** @final */
		cookie = {
			create(name, value, expDays, path = '/') {
				let date = new Date();
				date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
				document.cookie = name + "=" + value + "; " + "expires=" + date.toUTCString() + "; path="+path;
			},
			read(name) {
				var name = name + "=";
				var decoded = decodeURIComponent(document.cookie);
				var arr = decoded .split('; ');
				var res;
				arr.forEach(val => {
					if (val.indexOf(name) === 0) res = val.substring(name.length);
				})
				return res;
			},
			update(name, value) {
				cookie.create(name, value, 30);
			},
			delete(name) {
				document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
			},
			exists(name) {
				if(cookie.read(name) === null) {
					return false
				}
				return true;
			},
		}
		/** @final */
		alert = {
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
		/** @todo */
		modal = {
			count: 0,
			close(id) {

			},
			simple() {
				this.count++;
				$('.modals').append(''+
					'<div class="modal '+this.count+'" tabindex="-1" role="dialog">'+
						'<div class="modal-dialog" role="document">'+
							'<div class="modal-content">'+
								'<div class="modal-header">'+
									'<h5 class="modal-title">Modal title</h5>'+
									'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
										'<span aria-hidden="true">&times;</span>'+
									'</button>'+
								'</div>'+
								'<div class="modal-body">'+
									'<p>Modal body text goes here.</p>'+
								'</div>'+
								'<div class="modal-footer">'+
									'<button type="button" class="btn btn-primary">Save changes</button>'+
									'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'');
				$('.modal.'+this.count).on('shown.bs.modal', function () {
					$('#myInput').trigger('focus')
				})
			},
		}
		/** @final */
		search = {
			suggestions: $(".search-suggestions"),
			jsonData: null,
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
			dispaySuggestions(Arr) {
				for(var i=0; i<Arr.length; i++) {
					search.suggestions.html(search.suggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
				}
			},
		}
		/** @final */
		mode = {
			modeSwitch: $('.mode-switch'),
			root: $('html'),
			toggle() {
				if(cookie.read('cs_adm') == 'dark') {
					cookie.update('cs_adm', 'light')
					mode.root.removeClass('dark');
					mode.root.addClass('light');
					mode.modeSwitch.find('i').removeClass('fa');
					mode.modeSwitch.find('i').addClass('fal');
				} else {
					cookie.update('cs_adm', 'dark')
					mode.root.removeClass('light');
					mode.root.addClass('dark');
					mode.modeSwitch.find('i').addClass('fa');
					mode.modeSwitch.find('i').removeClass('fal');
				}
				mode.modeSwitch.toggleClass('active');
			},
			set(val) {
				mode.root.addClass(val);
				if(val == "dark") {
					mode.modeSwitch.addClass('active');
					mode.modeSwitch.find('i').addClass('fa');
					mode.modeSwitch.find('i').removeClass('fal');
				} else {
					mode.modeSwitch.removeClass('active');
					mode.modeSwitch.find('i').removeClass('fa');
					mode.modeSwitch.find('i').addClass('fal');
				}
			},
		}
		/** @wip */
		website = {
			/** @final */
			domain: {
				create() {
					data = {
						'api_key': api_key,
						'name': $("div[name=name] input").val(),
						'domain': $("div[name=domain] input").val(),
						'page_type': $("div[name=page_type]").find("option:selected").val(),
						'maintenance': (($("div[name=status] input[name=maintenance]:checked").length === 0)?0:1),
					}
					$.ajax({
						url: api_url + '/Website/',
						data: data,
						type: 'PUT',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							/**
							 * @todo Redirect once created
							 * $(location).attr('href', '/Websites/Edit/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
							 */
							alert.simple("Successfully created the domain", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
				update(sid) {
					data = {
						'api_key': api_key,
						'name': $("div[name=name] input").val(),
						'domain': $("div[name=domain] input").val(),
						'page_type': $("div[name=page_type]").find("option:selected").val(),
						'maintenance': (($("div[name=status] input[name=maintenance]:checked").length === 0)?0:1),
					}
					$.ajax({
						url: api_url + '/Website/' + sid + '/',
						data: data,
						type: 'POST',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							alert.simple("Successfully updated the domain", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
				delete(sid) {
					data = {
						'api_key': api_key,
					}
					$.ajax({
						url: api_url + '/Website/' + sid + '/',
						data: data,
						type: 'DELETE',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							$(location).attr('href', '/Websites/Themes/?al_ty=success&al_tx=Successfully created the supplier');
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
			},
			/** @final */
			page: {
				create() {
					var styles = [];
					var scripts = [];
					$("div[name=styles]").children().find("input[type=checkbox]:checked").each((index, element) => { styles.push($(element).val()); });
					$("div[name=scripts]").children().find("input[type=checkbox]:checked").each((index, element) => { scripts.push($(element).val()); });
					data = {
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
						'menu_url': $("div[name=menu_url] input").val(),
					}
					$.ajax({
						url: api_url + '/Page/',
						data: data,
						type: 'PUT',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							/**
							 * @todo Redirect once created
							 * $(location).attr('href', '/Websites/Page/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
							 */
							alert.simple("Successfully created the page", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
				update(pid) {
					var styles = [];
					var scripts = [];
					$("div[name=styles]").children().find("input[type=checkbox]:checked").each((index, element) => { styles.push($(element).val()); });
					$("div[name=scripts]").children().find("input[type=checkbox]:checked").each((index, element) => { scripts.push($(element).val()); });
					data = {
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
						'menu_url': $("div[name=menu_url] input").val(),
					}
					$.ajax({
						url: api_url + '/Page/' + pid + '/',
						data: data,
						type: 'POST',
						xhrFields: {
							withCredentials: true,
						},
						success(body) {
							alert.simple("Successfully updated the page", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							$(location).attr('href', '/Websites/Themes/?al_ty=success&al_tx=Successfully created the supplier');
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
			},
			/** @wip */
			layout: {
				update(pid) {
					data = {
						'api_key': api_key,
						'display_type': (($("input[name=display_type]:checked").length === 0)?0:1),
						'sections': $("div[type=sections]").attr('data-original-sections'),
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
							alert.simple("Successfully updated the layout", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				}
			},
			/** @final */
			style: {
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
							/**
							 * @todo Redirect once created
							 * $(location).attr('href', '/Websites/Style/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
							 */
							alert.simple("Successfully created the style", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							alert.simple("Successfully updated the style", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							$(location).attr('href', '/Websites/Themes/?al_ty=success&al_tx=Successfully created the supplier');
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				}
			},
			/** @final */
			script: {
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
							/**
							 * @todo Redirect once created
							 * $(location).attr('href', '/Websites/Script/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
							 */
							alert.simple("Successfully created the script", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							alert.simple("Successfully updated the script", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
					
				},
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
							$(location).attr('href', '/Websites/Themes/?al_ty=success&al_tx=Successfully created the supplier');
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				}
			},
			/** @final */
			theme: {
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
							/**
							 * @todo Redirect once created
							 * $(location).attr('href', '/Websites/Theme/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
							 */
							alert.simple("Successfully created the theme", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							alert.simple("Successfully updated the theme", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							$(location).attr('href', '/Websites/Themes/?al_ty=success&al_tx=Successfully created the supplier');
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				}
			},
		};
		/** @wip */
		user = {
			create() {
				data = {
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
				};
				$.ajax({
					url: api_url + '/Users/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						/**
						 * @todo Redirect once created
						 * $(location).attr('href', '/Users/Edit/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
						 */
						alert.simple("Successfully created the user", "success");
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			update(uid) {
				data = {
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
				};
				$.ajax({
					url: api_url + '/Users/' + uid + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						alert.simple("Successfully updated the user", "success");
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			delete(uid) {
				data = {
					'api_key': api_key,
				};
				$.ajax({
					url: api_url + '/Users/' + id + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						$(location).attr('href', '/Websites/Themes/?al_ty=success&al_tx=Successfully deleted the user');
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
		}
		/** @wip */
		product = {
			create() {

			},
			update(pid) {
				discontinued = (($("div[name=status] input[name=discontinued]:checked").length === 0) ? 0 : 1);
				available = (($("div[name=status] input[name=available]:checked").length === 0) ? 0 : 1);
				discounted = (($("div[name=pricing] input[name=discounted]:checked").length === 0) ? 0 : 1);
				auto_calculate = (($("div[name=pricing] input[name=auto_calculate]:checked").length === 0) ? 0 : 1);
				desc_l = smde_desc_l.value().replace('\n', '\\r\\n');
				desc_s = smde_desc_s.value().replace('\n', '\\r\\n');

				data = {
					'api_key': api_key,
					'title': $("div[name=title] input").val(),
					'collection': $("div[name=range]").find("option:selected").val(),
					'images': $("div[name=images] input").val(),
					'category': $("div[name=category]").find("option:selected").val(),
					'discontinued': discontinued,
					'active': available,
					'currency': $("div[name=currency] input").val(),
					'profit': $("div[name=profit] input").val(),
					'retail': $("div[name=retail] input").val(),
					'net': $("div[name=net] input").val(),
					'gross': $("div[name=gross] input").val(),
					'markup': $("div[name=markup] input").val(),
					'discounted': discounted,
					'auto_calculate': auto_calculate,
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
					'description_long': encodeURIComponent(desc_l),
					'description_short': encodeURIComponent(desc_s),
					'slug': $("div[name=slug] input").val(),
				};
				$.ajax({
					url: api_url + '/Product/' + pid + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						alert.simple("Successfully updated the product", "success");
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			delete(pid) {
				data = {
					'api_key': api_key,
				};
				$.ajax({
					url: api_url + '/Product/' + id + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						$(location).attr('href', '/Products/?al_ty=success&al_tx=Successfully created the supplier');
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
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
				margin			= Number($("div[name=markup] input").val());

				// Calculate the final prices
				netPrice = (container_price + wick_price + wickStand_price + (material_price * container_size) + (fragrance_price * container_size) + (colour_price * container_size) + packaging_price + shipping_price).toFixed(2);
				grossPrice = (netPrice * (margin / 100)).toFixed(2);
				netProfit = (grossPrice - netPrice).toFixed(2);

				// Round to nearest 5 0r 9
				console.log(retailPrice = misc.closestNum(grossPrice, [
					(misc.round(grossPrice, 1.00) - 0.00).toFixed(2),	// 00
					(misc.round(grossPrice, 0.10) - 0.01).toFixed(2),	// 09, 19, 29, 39, 49, 59, 69, 79, 89, 99
					(misc.round(grossPrice, 0.10) - 0.05).toFixed(2),	// 05, 15, 25, 35, 45, 55, 65, 75, 85, 95
				]));

				$('div[name=net]').find('input').val(netPrice);
				$('div[name=gross]').find('input').val(grossPrice);
				$('div[name=profit]').find('input').val(netProfit);
				$('div[name=retail]').find('input').val(retailPrice);
			},
			container: {
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
							// $(location).attr('href', '/Products/Container/' + id + '/?al_ty=success&al_tx=Successfully created the container');
							alert.simple("Successfully updated the container", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
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
							alert.simple("Successfully updated the container", "success");
						},
						error(body) {
							alert.simple("An error has occurred. Please try again later", "danger");
						}
					});
				},
				delete() {

				},
				calculate() {
					price_b	= Number($("div[name=price_b] input").val());
					quantity= Number($("div[name=quantity] input").val());
					$('div[name=price_e] input').val((price_b / quantity).toFixed(2));
				},
			},
		}
		/** @wip */
		supplier = {
			create() {
				data = {
					'api_key': api_key,
					'reference': $("div[name=reference] input").val(),
					'name': $("div[name=name] input").val(),
					'website': $("div[name=website] input").val(),
					'email': $("div[name=email] input").val(),
					'phone': $("div[name=phone] input").val(),
					'hours': $("div[name=hours] input").val(),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0) ? 0 : 1),
				};
				$.ajax({
					url: api_url + '/Supplier/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						/**
						 * @todo Redirect once created
						 * $(location).attr('href', '/Suppliers/Edit/' + id + '/?al_ty=success&al_tx=Successfully created the supplier');
						 */
						alert.simple("Successfully created the supplier", "success");
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			update(sid) {
				data = {
					'api_key': api_key,
					'reference': $("div[name=reference] input").val(),
					'name': $("div[name=name] input").val(),
					'email': $("div[name=email] input").val(),
					'phone': $("div[name=phone] input").val(),
					'hours': $("div[name=hours] input").val(),
					'active': (($("div[name=misc] input[name=active]:checked").length === 0) ? 0 : 1),
				};
				$.ajax({
					url: api_url + '/Supplier/' + sid + '/',
					data: data,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						alert.simple("Successfully update the supplier", "success");
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
			delete(sid) {
				data = {
					'api_key': api_key,
				};
				$.ajax({
					url: api_url + '/Supplier/' + sid + '/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true,
					},
					success(body) {
						$(location).attr('href', '/Suppliers/?al_ty=success&al_tx=Successfully created the supplier');
					},
					error(body) {
						alert.simple("An error has occurred. Please try again later", "danger");
					}
				});
			},
		}
		/** @wip */
		assistance = {
			jsonData: {},
			id1: null,
			id2: null,
			id3: null,
			markActive(name, elem) {
				$("div[name="+name+"]").find("li.active").removeClass('active');
				$(elem).addClass('active');
			},
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
		/** @wip */
		orders = {
			refund() {
				$('#refundModal').modal('show')
			},
		}
	// -----========== Dark mode toggle ==========----- // @final //
		if(cookie.exists('cs_adm')) { mode.set(cookie.read('cs_adm')); }
		mode.modeSwitch.click(() => { mode.toggle() });
	// -----========== Search ==========----- // @final //
		$(".search-area input").focusout(() => {
			if(search.suggestions.filter(":hover").length === 0) {
				search.suggestions.hide();
			}
		});
		$(".search-area input").focusin(() => {
			search.suggestions.show();
		});
		$.get($('.search-wrapper').attr('rel'), (data) =>{
			search.jsonData = data
		})
	// -----========== MENU BTN ==========----- // @final //
		$('.app-icon').click(() => {
			$('.app-sidebar').toggleClass('sidebar-show');
		})
	// -----========== BACK BTN ==========----- // @final //
		if(document.referrer.indexOf(location.protocol + "//" + location.host) !== 0 && misc.getQueryParams('force_back') === null) {
			$('.app-back-btn').addClass('disabled')
		}
		$(".app-back-btn").click(() => {
			if(!$(".app-back-btn").hasClass('disabled')) {
				history.back();
			}
		});
	// -----========== Alerts on load ==========----- // @final //
		if(misc.getQueryParams('al_ty') != null && misc.getQueryParams('al_tx') != null) {
			alert.simple(misc.getQueryParams('al_tx'), misc.getQueryParams('al_ty'));
		}
	// -----========== Preloader ==========----- // @final //
		$(window).bind('beforeunload', () => {
			$('.app-preloader').fadeIn();
		});
		$('.app-preloader').fadeOut();
	// -----========== Tool tips ==========----- // @final //
		$('[data-toggle="tooltip"]').tooltip();
	// -----========== OXYGEN builder ==========----- // @wip //
		$('input[name=display_type]').change(() => {
			if($('input[name=display_type]:checked').length === 0) {
				$('label[for=display_type]').html('Pages');
				$('div[type=sections]').hide();
				$('div[type=page]').show();
			} else {
				$('label[for=display_type]').html('Sections');
				$('div[type=sections]').show();
				$('div[type=page]').hide();
			}
		});
	// -----========== Auto-calculate product ==========----- // @wip //
		$('input[name=auto_calculate]').change(() => {
			if($('input[name=auto_calculate]:checked').length === 0) {
				$('div[name=net]').find('input').prop('disabled', false);
				$('div[name=gross]').find('input').prop('disabled', false);
				$('div[name=profit]').find('input').prop('disabled', false);
				$('div[name=markup]').find('input').prop('disabled', true);
			} else {
				$('div[name=net]').find('input').prop('disabled', true);
				$('div[name=gross]').find('input').prop('disabled', true);
				$('div[name=profit]').find('input').prop('disabled', true);
				$('div[name=markup]').find('input').prop('disabled', false);
			}
		});
		$('input[name=discounted]').change(() => {
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
		$('div.ProductInfo').find('input, select').change(() => {
			if($('input[name=auto_calculate]:checked').length != 0) {
				product.calculate();
			}
		});
		if($("div[name=currency]").length != 0) {
			$.get('/currencies.json', (data) =>{
				misc.currencies = data
			})
		}
		$('div[name=currency]').find('input').change(() => {
			symbol = misc.currSymbol($('div[name=currency] input').val());
			console.log(symbol);
			$('span.input-group-text#currSymbol').html(symbol);
		})
	// -----========== Auto-calculate Container ==========----- // @wip //
		$('div[name=quantity] input, div[name=price_b] input').change(() => {
			product.container.calculate();
		});
		$('div[name=supplier] select').change(() => {
			$('div[name=supplierref] input').val($('div[name=supplier] option:selected').val());
		});
	// -----========== Assistance nav ==========----- //
		if($(".assistanceNav").length != 0) {
			$.get('/assistance.json', (data) =>{
				assistance.jsonData = data;
				assistance.loadLV1();
			})
		}
	// -----========== EOF ==========----- //
});