$(document).ready(function() {
	/*
	 * ---====--- VARIABLES ---====---
	 */
		const api_url = window.location.protocol+'//api.'+window.location.hostname.slice(4) + '/v1';
		const api_key = 'iwdk5xYYMyUbyKuHMB8UuA5R2pbqgYLvjzzKQFCeJzKbAkg2qAJGWunzJPZFxvaCvue5xHJEwrhG3b9Ye5mn3UYBT7ZE46crHkgenvY4LaUSgb3Jcj8T67tUuyVtD6nRTQxvurPZ6E96WiQKep7G8kUjJhxHchEZk6KrWqZ2Tf2B9ZgtErZ4UMNNSJWE9DV8gM3YMkzmraACBxd9nPBteJKPx3SFdBMHQGBAL5bzSmJtCfezQJ7Ed3hk4CBnhda3';
		const api_key_data = 'api_key=' + api_key;
		const dt = new Date();
		const fdt = new Date(dt.setDate(dt.getDate() + 365));

	/**
	 * Topbar Ticker
	 */
		$('#topbar').slick({
			dots: false,
			arrows: false,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 3000,
		});

	/**
	 * Slick Carousel
	 */
		if($('.partners-slider-slim').length) {
			$('.partners-slider-slim').slick({
				infinite: true,
				lazyLoad: 'ondemand',
				arrows: false,
				dots: false,
				autoplay: true,
				autoplaySpeed: 2000,
				slidesToShow: 6,
				slidesToScroll: 2,
				responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 2,
						infinite: true,
					}
				}, {
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}, {
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]
			});
		}
		if($('.products-slider-slim').length) {
			$('.products-slider-slim').slick({
				infinite: true,
				lazyLoad: 'ondemand',
				arrows: false,
				dots: false,
				autoplay: true,
				autoplaySpeed: 2000,
				slidesToShow: 6,
				slidesToScroll: 2,
				responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 2,
						infinite: true,
					}
				}, {
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				}, {
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}]
			});
		}
		if($('.product-carousel').length) {
			$('.product-carousel').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: false,
				arrows: false,
				fade: true,
				asNavFor: '.product-carousel-small'
			});
		}
		if($('.product-carousel-small').length) {
			$('.product-carousel-small').slick({
				infinite: false,
				speed: 300,
				slidesToShow: 5,
				slidesToScroll: 2,
				focusOnSelect: true,
				vertical: true,
				verticalSwiping: true,
				dots: false,
				arrows: false,
				asNavFor: '.product-carousel',
				responsive: [{
					breakpoint: 768,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 2,
						vertical: false,
						verticalSwiping: false,
					}
				}]
			});
		}

	/**
	 * Mobile nav toggle
	 */
		$('.mobile-nav-toggle').on('click', function() {
			$('#navbar').toggleClass('navbar-mobile')
			$('.mobile-nav-toggle').toggleClass('fa-bars text-white')
			$('.mobile-nav-toggle').toggleClass('fa-times text-white')
		})

	/**
	 * Mobile nav dropdowns activate
	 */
		$('.navbar .dropdown > a').on('click', function(e) {
			if ($('#navbar').hasClass('navbar-mobile')) {
				e.preventDefault()
				$('.navbar .dropdown > a').next().toggleClass('dropdown-active')
			}
		})

	/**
	 * Scroll with ofset on page load with hash links in the url
	 */
		$(window).on('load', function() {
			if(window.location.hash) {
				if($(window.location.hash)) {
					$([document.documentElement, document.body]).animate({
						scrollTop: $(window.location.hash).offset().top - 70
					}, 2000);
				}
			}
		});

	/**
	 * Header fixed top on scroll
	 */
		if (selectHeader = $('#header')) {
			let headerOffset = selectHeader.offset().top
			let nextElement = selectHeader.next()
			const headerFixed = () => {
				if ((headerOffset - window.scrollY) <= 0) {
					selectHeader.addClass('fixed-top')
					nextElement.addClass('scrolled-offset')
				} else {
					selectHeader.removeClass('fixed-top')
					nextElement.removeClass('scrolled-offset')
				}
			}
			window.addEventListener('load', headerFixed)
			$(document).scroll(headerFixed)
		}

	/**
	 * Scrool with ofset on links with a class name .scrollto
	 */
		$('.scrollto').on('click', function(e) {
			if ($(this.hash)) {
				e.preventDefault()
				let navbar = $('#navbar')
				if (navbar.hasClass('navbar-mobile')) {
					navbar.removeClass('navbar-mobile')
					let navbarToggle = $('.mobile-nav-toggle')
					navbarToggle.toggleClass('fa-bars')
					navbarToggle.toggleClass('fa-times')
				}
				scrollto(this.hash)
			}
		})

	/**
	 * Back to top button
	 */
		let backtotop = $('.back-to-top')
		if (backtotop) {
			const toggleBacktotop = () => {
				if (window.scrollY > 100) {
					backtotop.addClass('active')
				} else {
					backtotop.removeClass('active')
				}
			}
			window.addEventListener('load', toggleBacktotop)
			$(document).scroll(toggleBacktotop);
		}

	/**
	 * Edit account details button
	 */
		$('.account_details-edit_btn').click(function() {
			$(".account_details").hide();
			$(".account_details-edit").show();
			$(".account_details-edit_btn").hide();
			$(".account_details-save_btn").show();
		})
		$('.account_details-save_btn').click(function() {
			$(".account_details").show();
			$(".account_details-edit").hide();
			$(".account_details-edit_btn").show();
			$(".account_details-save_btn").hide();
			account.update();
		})

	/**
	 * Logout button
	 */
		$('.btn_logout').click(function() {
			account.logout(cookie.read('session_code'));
		})

	/**
	 * GDPR cookie message controller
	 */
		$('#gdpr-cookie-message').on('click', function() {
			cookie.accept();
			$('#gdpr-cookie-message').hide();
		})

	/*
	 * Validate form elements
	 */
		validate = {
			form: function() {
				var fieldCount = 0;
				var count = 0;
				$(".main-form__body--input").each(function() {
					fieldCount += 1;
					var function_name = $(this).attr("name");
					if (eval("validate." + function_name + "()")) {
						count += 1;
					}
				});
				if (count == fieldCount) return true;
				return false;
			},
			username: function() {
				var username = $(".main-form__body--input[name=username]").val();
				if (username.length < 6 || !username.match(/^[a-zA-Z0-9]+$/)) return false;
				return true;
			},
			firstname: function() {
				console.log("firstname");
			},
			surname: function() {
				console.log("surname");
			},
			email: function() {
				console.log("email");
			},
			phone: function() {
				console.log("phone");
			},
			password: function() {
				var password = $(".main-form__body--input[name=password]").val();
				var passwordStrength = 0;
				if (password.length > 8) passwordStrength += 1;
				if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) passwordStrength += 1;
				if (password.match(/([0-9])/)) passwordStrength += 1;
				if (password.match(/([!,%,&,@,#,$,^,*,?,-,~])/)) passwordStrength += 1;
				if (password.match(/([!,%,&,@,#,$,^,*,?,-,~].*[!,%,&,@,#,$,^,*,?,-,~])/)) passwordStrength += 1;

				if (passwordStrength > 3) return true;
				return false;
			},
			password1: function() {
				var password = $(".main-form__body--input[name=password]").val();
				var passwordStrength = 0;
				if (password.length > 8) passwordStrength += 1;
				if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) passwordStrength += 1;
				if (password.match(/([!,%,&,@,#,$,^,*,?,-,~])/)) passwordStrength += 1;
				if (password.match(/([!,%,&,@,#,$,^,*,?,-,~].*[!,%,&,@,#,$,^,*,?,-,~])/)) passwordStrength += 1;

				if (passwordStrength > 2) return true;
				return false;
			},
			password2: function() {
				var password1 = $(".main-form__body--input[name=password1]").val();
				var password2 = $(".main-form__body--input[name=password2]").val();
				return (password1==password2);
			},
			address: function() {
				console.log("address");
			}
		}
	// Account
		account = {
			register: function() {
				validate.form();
				var fname = $('.main-form__body--input[name=firstname]').val();
				var sname = $('.main-form__body--input[name=surname]').val();
				var uname = $('.main-form__body--input[name=username]').val();
				var email = $('.main-form__body--input[name=email]').val();
				var pass1 = $('.main-form__body--input[name=password]').val();
				var pass2 = $('.main-form__body--input[name=password2]').val();
				data = {
					'api_key': api_key,
					'fname': fname,
					'sname': sname,
					'uname': uname,
					'email': email,
					'pass1': pass1,
					'pass2': pass2,
				};

				$.ajax({
					url: api_url + '/Users/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success: function(body) {
						alerts.icon('check', 'Please confirm your email address then you can log in', 'success');
					},
					error: function(body) {
						alerts.icon('times', 'An error has occured, Please try again later', 'warning');
					}
				});
			},
			login: function() {
				if (validate.form()) {
					$.ajax({
						url: api_url + '/Users/Session/',
						data: {
							'api_key': api_key,
							'username': $(".main-form__body--input[name=username]").val(),
							'password': $(".main-form__body--input[name=password]").val(),
						},
						type: 'PUT',
						xhrFields: {
							withCredentials: true,
						},
						success: function(body) {
							res = JSON.stringify(body);
							if (body.status == "success") {
								cookie.createFromArray(
									body.cookies,
									body.options.expires,
									body.options.path,
									body.options.domain,
									body.options.secure,
									body.options.httponly
								);
								if($('rw').length) {
									if($('rwp').length) {
										window.location = window.location.protocol+'//' + $('rw').attr('data') + $('rw').attr('data')
									} else {
										window.location = window.location.protocol+'//' + $('rw').attr('data');
									}
								}
								//location.reload();
							} else {
								console.log(body.status);
							}
						},
						error: function() {
							alert("Error: Unable to connect");
						}
					});
				} else {
					alerts.simple("Login failled. Please check your information");
				}
			},
			forgot_password: function() {
				password = $(".main-form__body--input[name=password]").val();
				data = {
					'api_key': api_key,
					'username': username,
					'password': password
				};

				$.ajax({
					url: api_url + '/Users/Session/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success: function() {
						location.reload()
					},
					error: function(result) {
						alert("Error: " + result);
					}
				});
			},
			update: function() {
				pwd_old = $('.account_details-password_old').val();
				if (pwd_old != '') {
					data = api_key_data + '&pass=' + pwd_old;
					firstname = $('.account_details-firstname').val();
					firstnameORIG = $('.account_details-firstname').attr('orig');
					if (firstname != firstnameORIG && firstname != '') data += '&fname=' + firstname;
					surname = $('.account_details-surname').val();
					surnameORIG = $('.account_details-surname').attr('orig');
					if (surname != surnameORIG && surname != '') data += '&sname=' + surname;
					email = $('.account_details-email').val();
					emailORIG = $('.account_details-email').attr('orig');
					if (email != emailORIG && email != '') data += '&email=' + email;
					username = $('.account_details-username').val();
					usernameORIG = $('.account_details-username').attr('orig');
					if (username != usernameORIG && username != '') data += '&user=' + username;
					pwd_new = $('.account_details-password_new').val();
					if (pwd_new != '') data += '&pass1=' + pwd_new;
					pwd_conf = $('.account_details-password_conf').val();
					if (pwd_conf != '') data += '&pass2=' + pwd_conf;
					user_id = $('userdata').attr('user_id')

					if (data == api_key_data + '&pass=' + pwd_old) {
						alerts.icon('info', 'No info has been changed')
					} else {
						$.ajax({
							url:  + '/Users/' + user_id + '/',
							data: data,
							type: 'POST',
							xhrFields: {
								withCredentials: true
							},
							success: function(body) {
								if (body.status == "success") {
									alerts.icon('info', 'Success! Your info has been updated', 'success');
								} else {
									alerts.icon('info', body.error, 'warning');
								}
							},
							error: function(body) {
								alerts.icon('times', body.error, 'danger');
							}
						});
					}
				}
			},
			logout: function(session_code) {
				data = api_key_data + '&session_code=' + session_code
				$.ajax({
					url: api_url + '/Users/Session/',
					data: data,
					type: 'DELETE',
					xhrFields: {
						withCredentials: true
					},
					success: function(body) {
						if (body.status == 'success') {
							location.reload();
						} else {
							alerts.icon('info', body.error, 'warning');
						}
					},
					error: function() {
						alert("Error: Unable to connect");
					}
				});
			}
		}
	// Cart
		cart = {
			add: function(uid, sku) {
				options_Arr = [];
				if($("options").children('div').children('input').length) {
					quantity_Raw = $("options").children('div').children('input');
					qty = quantity_Raw.val();
				} else {
					qty = 1;
				}
				options_Raw = $("options").children('div').children('select');
				options_count = count = 1;
				options_Raw.each(function() {
					count++;
					if (this.value == 0) {
						$(this).addClass('is-invalid');
					} else {
						options_count++;
						options_Arr.push(this.value);
					}
				})
				opt = JSON.stringify(options_Arr);
				if (options_count == count) {
					$.ajax({
						url: api_url + '/Cart/',
						data: {
							'api_key': api_key,
							'uid': uid,
							'sku': sku,
							'qty': qty,
							'opt': opt
						},
						type: 'PUT',
						xhrFields: {
							withCredentials: true,
						},
						success: function(body) {
							if (body == 'success') {
								alerts.icon('info-circle', 'Item has been added to cart')
							}
						},
						error: function(result) {
							alert("Error: " + result);
						}
					});
				}
			},
			remove: function(uid, sku) {
				$.ajax({
					url: api_url,
					data: '$=cart_del&uid=' + user_id + '&pid=' + item,
					type: 'POST',
					xhrFields: {
						withCredentials: true,
					},
					success: function(body) {
						if (body == 'success') {
							alerts.icon('info-circle', 'Item has been removed from cart')
						}
					},
					error: function(result) {
						alert("Error: " + result);
					}
				});
			}
		}
	// Modals
		modal = {
			create: function(type, open) {
				if (type == 'login-cart') {
					if ($('modals>.modal-' + type).length == 0) {
						var structure = [
							'<div class="modal modal-login-cart" style="background:#00000066;" onClick="modal.close(\'login-cart\')">',
							'<div class="modal-dialog">',
							'<div class="modal-content">',
							'<div class="modal-header">',
							'<h5 class="modal-title">Account required</h5>',
							'<button type="button" class="btn-close" onClick="modal.close(\'login-cart\')"></button>',
							'</div>',
							'<div class="modal-body">',
							'<p> You have to login to add things to your cart </p>',
							'</div>',
							'<div class="modal-footer">',
							'<button type="button" class="btn btn-secondary" onClick="modal.close(\'login-cart\')">Close</button>',
							'<a href="/login" class="btn btn-primary">Login</a>',
							'</div>',
							'</div>',
							'</div>',
							'</div>'
						];
						$(structure.join('')).appendTo($('modals'));
					}
				}
				if (open) {
					modal.open(type)
				}
			},
			open: function(type) {
				$('.modal-' + type).fadeIn(100)
			},
			close: function(type) {
				$('.modal-' + type).fadeOut(100)
			}
		}
	// Alerts
		alerts = {
			count: Number,
			icon: function(icon, text, colour = 'primary') {
				alerts.count++;
				var structure = [
					'<div class="alert alert-' + colour + ' d-flex align-items-center" role="alert" data-alert-id="' + alerts.count + '">',
					'<div><i class="fad fa-2x fa-' + icon + ' me-2"></i></div>',
					'<div>',
					'' + text + '',
					'</div>',
					'</div>'
				];
				$(structure.join('')).appendTo($('alerts'));
				setTimeout(() => {
					alerts.hide(alerts.count);
				}, 2500);
			},
			additional: function(heading, text, footer, colour = 'primary') {
				alerts.count++;
				var structure = [
					'<div class="alert alert-' + colour + '" role="alert" data-alert-id="' + alerts.count + '">',
					'<h4 class="alert-heading">' + heading + '</h4>',
					'<p>' + text + '</p>',
					'<hr>',
					'<p class="mb-0">' + footer + '</p>',
					'</div>'
				];
				$(structure.join('')).appendTo($('alerts'));
				setTimeout(() => {
					alerts.hide(alerts.count);
				}, 2500);
			},
			simple: function(text) {
				alerts.count++;
				var structure = [
					'<div class="alert alert-primary" role="alert" data-alert-id="' + alerts.count + '">',
					text,
					'</div>'
				];
				$(structure.join('')).appendTo($('alerts'));
				setTimeout(() => {
					alerts.hide(alerts.count);
				}, 2500);
			},
			hide: function(id) {
				$('[data-alert-id=' + id + ']').fadeOut(1000, function() {
					$(this).remove()
					alerts.count--;
				});
			}
		}
	// Cookies
		cookie = {
			acceptanceCheck: function() {
				if (cookie.read('tc_gdpr_acceptance') == 'accepted') {
					$('#gdpr-cookie-message').hide();
				} else {
					$('#gdpr-cookie-message').show();
				}
			},
			accept: function() {
				cookie.create('tc_gdpr_acceptance', 'accepted', fdt, '/', '.' + $(location).attr('host').replace(/http:\/\/.+?\./, '').replace(/www./, ''))
			},
			create: function(Name, Value, Expires, Path, Domain) {
				try {
					CookieString =
						Name + "=" + Value + "; "+
						"expires="+ Expires + "; "+
						"path=" + Path + "; "+
						"domain=" + Domain + "; "
					document.cookie = CookieString;
				} catch(error) {
					console.log(error);
				}
			},
			createFromArray: function(array, Expires, Path, Domain) {
				Object.keys(array).forEach(function(key) {
					var val = array[key];
					cookie.create(key, val, Expires, Path, Domain)
				});
			},
			read: function(Name) {
				let result = document.cookie.match("(^|[^;]+)\\s*" + Name + "\\s*=\\s*([^;]+)");
				if (result) {
					return result.pop();
				}
				return false;
			},
			readFromArray: function(Names) {
				// TBD
			},
			update: function(Name, Value) {
				document.cookie = Name + "=" + Value + ";";
			},
			updateFromArray: function(array) {
				Object.keys(array).forEach(function(key) {
					var val = array[key];
					cookie.update(key, val)
				});
			},
			delete: function(Name) {
				document.cookie = Name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC;"
			},
			deleteFromArray: function() {
				// TBD
			}
		}
	// Address
		address = {
			searchTimer: null,
			lookup() {
				$.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address=" + $("input[name=postcode]").val() + "&components=country:gb&key=AIzaSyA14e6x_MFMOMI22v2HsBd6xWRqVSXcWd8").done((json) => {
					if (json["status"] === "OK") {
						$(".addressSummary").text(json["results"][0]["formatted_address"]);// Append the google formatted complete address
						
						json["results"][0]["address_components"].forEach(checkDataAvailable); // For each address field check if the values we need are available and if they are add the text they contain into the relevant field in the UI
					
						function checkDataAvailable(data){
							switch(data["types"][0]) {
								case "postal_code":
									break;
								case "route":
									$("input.form-control[name=address1]").val(json["results"][0]["address_components"][1]["long_name"]);
									break;
								case "postal_town":
									$("input.form-control[name=town]").val(json["results"][0]["address_components"][2]["long_name"]);
									break;
								case "locality":
									$("input.form-control[name=address2]").val(json["results"][0]["address_components"][3]["long_name"]);
									break;
								case "administrative_area_level_2":
									$("input.form-control[name=county]").val(json["results"][0]["address_components"][4]["long_name"]);
									break;
								case "":
									$("input.form-control[name=country]").val(json["results"][0]["address_components"][5]["long_name"]);
									break;
								default: 
									// Check if town and district are duplicated and remove district if the case.
									if($("input.form-control[name=town]").val() === $("input.form-control[name=address2]").val()){
										$("input.form-control[name=address2]").val("");
									}
									return;
							}
						}
						// Display the JSON structure of this data on the page purely for use here on codepen
						var json = JSON.stringify(json, null, 2);
						$(".jsonOutput").empty();
						$(".jsonOutput").append(json);
					} else {
						console.log("There was an error with the Google API and no data was returned");
						// Add gracefull degradation for following error codes in the APP
						// https://developers.google.com/maps/documentation/geocoding/intro#StatusCodes
						// ZERO_RESULTS
						// OVER_QUERY_LIMIT
						// REQUEST_DENIED
						// INVALID_REQUEST
						// UNKNOWN_ERROR
						switch(json["status"]) {
							case "ZERO_RESULTS":
								console.log("No results found");
								break;
							case "OVER_QUERY_LIMIT":
								console.log("Over alloted query limit");
								break;
							case "REQUEST_DENIED":
								console.log("Access blocked");
								break;
							case "INVALID_REQUEST":
								console.log("Query address missing");
								break;
							case "UNKNOWN_ERROR":
								console.log("Google server error");
								break;
							default: 
								return;
							}
					
					}
				}).fail(() => {
					console.log("There was a network error and no data was returned");
					// TODO gracefull degradation when there is a network error
					$(".addressSummary").text("Network error.")
				});
			},
			enterManual() {

			},
		}
	/**
	 * STRIPE PAYEMENTS
	 */
		if($('#paymentFrm').length) {
			$(".form-control").on('keydown', function() {
				// Cancel any previously-set timer
				if (address.searchTimer) {
					clearTimeout(address.searchTimer);
				}
				address.searchTimer = setTimeout(function() {
					$(	"input.form-control[name=address1],"+
						"input.form-control[name=address2],"+
						"input.form-control[name=town],"+
						"input.form-control[name=county],"+
						"input.form-control[name=country]").val("")
					address.lookup();
				}, 400);
			});

			var stripe = Stripe($('input[name=STRIPE_PUBLISHABLE_KEY]').val());
			var resultContainer = document.getElementById('paymentResponse');
			var elements = stripe.elements({
				locale: 'en',
				loader: 'always'
			});
			var style = {
				base: {
					fontFamily: 'monospace',
					fontSize: '17px',
					color: '#F3F5F6',
					backgroundColor: 'transparent',
					'::placeholder': {
						color: '#CCD7E0',
					}
				},
				invalid: {
					color: '#E74C3C',
				}
			};

			var card = elements.create('cardNumber', { 'style': style });
			card.mount('#card_number');
			card.addEventListener('change', function(event) {
				if (event.error) {
					resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
				} else {
					resultContainer.innerHTML = '';
				}
			});

			var exp = elements.create('cardExpiry', { 'style': style });
			exp.mount('#card_expiry');
			exp.addEventListener('change', function(event) {
				if (event.error) {
					resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
				} else {
					resultContainer.innerHTML = '';
				}
			});

			var cvc = elements.create('cardCvc', { 'style': style });
			cvc.mount('#card_cvc');
			cvc.addEventListener('change', function(event) {
				if (event.error) {
					resultContainer.innerHTML = '<p>' + event.error.message + '</p>';
				} else {
					resultContainer.innerHTML = '';
				}
			});
			// On form submit
			var form = document.getElementById('paymentFrm');
			form.addEventListener('submit', function(e) {
				e.preventDefault();
				createToken();
			});
			// Create single-use token to charge the user
			function createToken() {
				stripe.createToken(card).then(function(result) {
					if (result.error) {
						// Inform the user if there was an error
						resultContainer.innerHTML = '<p>' + result.error.message + '</p>';
					} else {
						// Send the token to your server
						stripeTokenHandler(result.token);
					}
				});
			}
			// Callback to handle the response from stripe
			function stripeTokenHandler(token) {
				var hiddenInputStripeToken = document.createElement('input');
				hiddenInputStripeToken.setAttribute('type', 'hidden');
				hiddenInputStripeToken.setAttribute('name', 'stripeToken');
				hiddenInputStripeToken.setAttribute('value', token.id);
				form.appendChild(hiddenInputStripeToken);
				items = '';
				$('cart-item').each(function() {
					items = items + $(this).attr('raw') + ";";
				});
				var hiddenInputItems = document.createElement('input');
				hiddenInputItems.setAttribute('type', 'hidden');
				hiddenInputItems.setAttribute('name', 'items');
				hiddenInputItems.setAttribute('value', items);
				form.appendChild(hiddenInputItems);

				// Submit the form
				paymentSubmit();
			}
			// handle the payments through the API
			function paymentSubmit() {
				var paymentFrm = $("#paymentFrm").find('input');
				data = api_key_data + "&";
				paymentFrm.each(function() {
					if($(this).attr('name') != null) {
						data = data + $(this).attr('name') + '=' + this.value + '&'
					}
				});
				$.ajax({
					url: api_url + '/Stripe/',
					data: data,
					type: 'PUT',
					xhrFields: {
						withCredentials: true,
					},
					success: function(body) {
						if (body.startsWith('success')) {
							var txn_id = body.split(":")[1];
							location.href = '/my/orders/' + txn_id;
						} else {}
					},
					error: function(result) {
						console.error("Error: " + result);
					}
				});

			}
		}

	/**
	 * Preloader
	 */
		$(window).bind('beforeunload', function() {
			$('.preloader-container').fadeIn();
		});
		$('.preloader-container').fadeOut();

	/**
	 *  EOF
	 */
});