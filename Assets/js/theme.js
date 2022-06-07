$( document ).ready(function() {
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
		}
	}
	website = {
		save: function(id) {
			var styles = [];
			var scripts = [];
			$("div[name=styles]").children().find("input[type=checkbox]:checked").each(function(index, elem) { styles.push($(elem).val()); });
			$("div[name=scripts]").children().find("input[type=checkbox]:checked").each(function(index, element) { scripts.push($(element).val()); });
			data = {
				'api_key': api_key,
				'page_id': id,
				'style': styles.join(","),
				'script': scripts.join(","),
				'name': $("div[name=name]").find("input").val(),
				'title': $("div[name=title]").find("input").val(),
				'page_url': $("div[name=page_url]").find("input").val(),
				'subpage_url': $("div[name=subpage_url]").find("input").val(),
			}
			$.ajax({
				url: api_url + '/Website/',
				data: data,
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success: function(body) { },
				error: function(body) { }
			});
		}
	};
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
		}
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
			modeSwitch.toggleClass('active');
		},
		set: function(mode) {
			//mode.root.addClass(mode);
			if(mode == "dark") {
				modeSwitch.addClass('active');
			} else {
				modeSwitch.removeClass('active');
			}
		}
	}
	// -----========== Dark mode toggle ==========----- //
		if(cookie.exists('cs_adm')) { mode.set(cookie.read('cs_adm')); }
		modeSwitch.click(function () { mode.toggle() });
	// -----========== PRELOADER ==========----- //
	$('.app-preloader').fadeOut()
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
});