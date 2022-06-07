$( document ).ready(async function() {
	// -----========== VARIABLES ==========----- //
	const api_url = window.location.protocol+'//api.'+window.location.hostname.slice(6) + '/v1';
	const api_key = 'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
	const api_key_data = 'api_key=' + api_key;
	// -----========== Nestled functions ==========----- //
	cookie = {
		create: function(name, value, expDays, path = '/') {
			let date = new Date();
			date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
			document.cookie = name + "=" + value + "; " + "expires=" + date.toUTCString() + "; path="+path;
		},
		read: function(name) {
			var name = name + "=";
			var decoded = decodeURIComponent(document.cookie);
			var arr = decoded .split('; ');
			var res;
			arr.forEach(val => {
				if (val.indexOf(name) === 0) res = val.substring(name.length);
			})
			return res;
		},
		update: function(name, value) {
			cookie.create(name, value, 30);
		},
		delete: function(name) {
			document.cookie = name+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/";
		},
		exists: function(name) {
			if(cookie.read(name) === null) {
				return false
			}
			return true;
		},
	}
	alert = {
		simple: function(icon, text, colour) {
			$(".alerts").html($(".alerts").html() + '<div class="toast toast-'+colour+' show"> <div id="img"><i class="fa fa-'+icon+'"></i></div><div id="desc">'+text+'</div></div>');
			setTimeout(function(){
				$($(".alerts").children()[0]).removeClass("show");
				$($(".alerts").children()[0]).remove();
			}, 500000);
		},

	}
	search = {
		suggestions: $(".search-suggestions"),
		jsonData: null,
		process: function(ev) {
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
		dispaySuggestions: function(Arr) {
			for(var i=0; i<Arr.length; i++) {
				search.suggestions.html(search.suggestions.html() + "<li><a href='" + Arr[i].url + "'>" + Arr[i].name + " - " + Arr[i].desc + "</a></li>");
			}
		},
	}
	mode = {
		modeSwitch: $('.mode-switch'),
		root: $('html'),
		toggle: function() {
			if(cookie.read('cs_adm') == 'dark') {
				cookie.update('cs_adm', 'light')
				mode.root.removeClass('dark');
				mode.root.addClass('light');
			} else {
				cookie.update('cs_adm', 'dark')
				mode.root.removeClass('light');
				mode.root.addClass('dark');
			}
			mode.modeSwitch.toggleClass('active');
		},
		set: function(val) {
			mode.root.addClass(val);
			if(val == "dark") {
				mode.modeSwitch.addClass('active');
			} else {
				mode.modeSwitch.removeClass('active');
			}
		},
	}
	website = {
		save: function(sid) {
			var styles = [];
			var scripts = [];
			$("div[name=styles]").children().find("input[type=checkbox]:checked").each(function(index, elem) { styles.push($(elem).val()); });
			$("div[name=scripts]").children().find("input[type=checkbox]:checked").each(function(index, element) { scripts.push($(element).val()); });
			data = {
				'api_key': api_key,
				'style': styles.join(","),
				'script': scripts.join(","),
				'name': $("div[name=name]").find("input").val(),
				'title': $("div[name=title]").find("input").val(),
				'page_url': $("div[name=page_url]").find("input").val(),
				'subpage_url': $("div[name=subpage_url]").find("input").val(),
			}
			$.ajax({
				url: api_url + '/Website/' + sid + '/',
				data: data,
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success: function(body) {
					alert.simple("circle-check", "Successfully saved the website", "success");
				},
				error: function(body) {
					alert.simple("circle-x", "An error has occurred. Please try again later", "error");
				}
			});
		},
	};
	user = {
		save: function(uid) {
			r_pass = (($("div[name=misc]").find("input[name=reset_pass]:checked").length === 0)?0:1);
			d_analytics = (($("div[name=misc]").find("input[name=disable_analytics]:checked").length === 0)?0:1);
			e_active = (($("div[name=misc]").find("input[name=email_active]:checked").length === 0)?0:1);
			u_active = (($("div[name=misc]").find("input[name=user_active]:checked").length === 0)?0:1);
			data = {
				'api_key': api_key,
				'uname': $("div[name=username]").find("input").val(),
				'fname': $("div[name=firstname]").find("input").val(),
				'lname': $("div[name=lastname]").find("input").val(),
				'email': $("div[name=email]").find("input").val(),
				'phone': $("div[name=phone]").find("input").val(),
				'r_pass': r_pass,
				'd_analytics': d_analytics,
				'e_active': e_active,
				'u_active': u_active,
			}
			$.ajax({
				url: api_url + '/Users/' + uid + '/',
				data: data,
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success: function(body) {
					alert.simple("circle-check", "Successfully saved the user", "success");
				},
				error: function(body) {
					alert.simple("circle-x", "An error has occurred. Please try again later", "error");
				}
			});
		},
	}
	product = {
		save: function(pid) {
			discontinued = (($("div[name=status]").find("input[name=discontinued]:checked").length === 0)?0:1);
			available = (($("div[name=status]").find("input[name=available]:checked").length === 0)?0:1);
			discounted = (($("div[name=pricing]").find("input[name=discounted]:checked").length === 0)?0:1);
			auto_calculate = (($("div[name=pricing]").find("input[name=auto_calculate]:checked").length === 0)?0:1);
			data = {
				'api_key': api_key,
				'title': $("div[name=title]").find("input").val(),
				'range': $("div[name=range]").find("option:selected").val(),
				'images': $("div[name=images]").find("input").val(),
				'category': $("div[name=category]").find("option:selected").val(),
				'discontinued': discontinued,
				'available': available,
				'currency': $("div[name=currency]").find("input").val(),
				'profit': $("div[name=profit]").find("input").val(),
				'retail': $("div[name=retail]").find("input").val(),
				'net': $("div[name=net]").find("input").val(),
				'gross': $("div[name=gross]").find("input").val(),
				'markup': $("div[name=markup]").find("input").val(),
				'discounted': discounted,
				'auto_calculate': auto_calculate,
				'discount_type': $("div[name=discount_type]").find("option:selected").val(),
				'discount_amount': $("div[name=discount_amount]").find("input").val(),
				'container': $("div[name=container]").find("option:selected").val(),
				'wick': $("div[name=wick]").find("option:selected").val(),
				'wick_stand': $("div[name=wick_stand]").find("option:selected").val(),
				'material': $("div[name=material]").find("option:selected").val(),
				'fragrance': $("div[name=fragrance]").find("option:selected").val(),
				'colour': $("div[name=colour]").find("option:selected").val(),
				'packaging': $("div[name=packaging]").find("option:selected").val(),
				'shipping': $("div[name=shipping]").find("option:selected").val(),
				'made_by': $("div[name=made_by]").find("option:selected").val(),
				'description_long': $("div[name=description_long]").find("input").val(),
				'description_short': $("div[name=description_short]").find("input").val(),
				'slug': $("div[name=slug]").find("input").val(),
			}
			$.ajax({
				url: api_url + '/Product/' + pid + '/',
				data: data,
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success: function(body) {
					alert.simple("circle-check", "Successfully saved the product", "success");
				},
				error: function(body) {
					alert.simple("circle-x", "An error has occurred. Please try again later", "error");
				}
			});
		},
	}
	// -----========== Dark mode toggle ==========----- //
		if(cookie.exists('cs_adm')) { mode.set(cookie.read('cs_adm')); }
		mode.modeSwitch.click(function () { mode.toggle() });
	// -----========== Search ==========----- //
		$(".search-area input").focusout( function(){
			if(search.suggestions.filter(":hover").length === 0) {
				search.suggestions.hide();
			}
		});
		$(".search-area input").focusin( function(){
			search.suggestions.show();
		});
		$.get('/Assets/search.json', function(data){
			search.jsonData = data
		})
	// -----========== BACK BTN ==========----- //
		if(document.referrer.indexOf(location.protocol + "//" + location.host) !== 0) {
			$('.app-back-btn').addClass('disabled')
		}
		$(".app-back-btn").click( function(){
			if(!$(this).hasClass('disabled')) {
				history.back();
			}
		});
	// -----========== PRELOADER ==========----- //
		$('.app-preloader').fadeOut()
});