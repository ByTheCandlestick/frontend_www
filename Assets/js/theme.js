$( document ).ready(function() {
	// -----========== VARIABLES ==========----- //
	const api_url = window.location.protocol+'//api.'+window.location.hostname.slice(6) + '/v1';
	const api_key = 'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
	const api_key_data = 'api_key=' + api_key;
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
	// -----========== Nestled functions ==========----- //
	website = {
		save: function() {
			var Style = Script = Name = Title = Page_url = Subpage_url = "";
			var styles = scripts = [];
			$("div[name=styles]").find("input[type=checkbox]:checked").each(function(index, element) { styles.push($(element).val()); });
			$("div[name=scripts]").find("input[type=checkbox]:checked").each(function(index, element) { scripts.push($(element).val()); });
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
				url: api_url + '/Website/',
				data: data,
				type: 'POST',
				xhrFields: {
					withCredentials: true,
				},
				success: function(body) {
					console.log(body)
				},
				error: function(body) {
					console.log(body)
				}
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
});