<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_POST['GUI'] == '1') {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<style>
				body {
					display:flex;
					align-items:center;
					justify-content:center;
					flex-direction:column;
					flex-wrap:wrap;
					width:100vw;
					height:100vh;
					overflow:hidden
				}
				.scene {
					display:flex
				}
				.wizard {
					position:relative;
					width:190px;
					height:240px
				}
				.body {
					position:absolute;
					bottom:0;
					left:68px;
					height:100px;
					width:60px;
					background:#3f64ce
				}
				.body:after {
					content:"";
					position:absolute;
					bottom:0;
					left:20px;
					height:100px;
					width:60px;
					background:#3f64ce;
					transform:skewX(14deg)
				}
				.right-arm {
					position:absolute;
					bottom:74px;
					left:110px;
					height:44px;
					width:90px;
					background:#3f64ce;
					border-radius:22px;
					transform-origin:16px 22px;
					transform:rotate(70deg);
					animation:right_arm 10s ease-in-out infinite
				}
				.right-arm .right-hand {
					position:absolute;
					right:8px;
					bottom:8px;
					width:30px;
					height:30px;
					border-radius:50%;
					background:#f1c5b4;
					transform-origin:center center;
					transform:rotate(-40deg);
					animation:right_hand 10s ease-in-out infinite
				}
				.right-arm .right-hand:after {
					content:"";
					position:absolute;
					right:0;
					top:-8px;
					width:15px;
					height:30px;
					border-radius:10px;
					background:#f1c5b4;
					transform:translateY(16px);
					animation:right_finger 10s ease-in-out infinite
				}
				.left-arm {
					position:absolute;
					bottom:74px;
					left:26px;
					height:44px;
					width:70px;
					background:#3f64ce;
					border-bottom-left-radius:8px;
					transform-origin:60px 26px;
					transform:rotate(-70deg);
					animation:left_arm 10s ease-in-out infinite
				}
				.left-arm .left-hand {
					position:absolute;
					left:-18px;
					top:0;
					width:18px;
					height:30px;
					border-top-left-radius:35px;
					border-bottom-left-radius:35px;
					background:#f1c5b4
				}
				.left-arm .left-hand:after {
					content:"";
					position:absolute;
					right:0;
					top:0;
					width:30px;
					height:15px;
					border-radius:20px;
					background:#f1c5b4;
					transform-origin:right bottom;
					transform:scaleX(0);
					animation:left_finger 10s ease-in-out infinite
				}
				.head {
					position:absolute;
					top:0;
					left:14px;
					width:160px;
					height:210px;
					transform-origin:center center;
					transform:rotate(-3deg);
					animation:head 10s ease-in-out infinite
				}
				.head .beard {
					position:absolute;
					bottom:0;
					left:38px;
					height:106px;
					width:80px;
					border-bottom-right-radius:55%;
					background:#fff
				}
				.head .beard:after {
					content:"";
					position:absolute;
					top:16px;
					left:-10px;
					width:40px;
					height:20px;
					border-radius:20px;
					background:#fff
				}
				.head .face {
					position:absolute;
					bottom:76px;
					left:38px;
					height:30px;
					width:60px;
					background:#f1c5b4
				}
				.head .face:before {
					content:"";
					position:absolute;
					top:0;
					left:40px;
					width:20px;
					height:40px;
					border-bottom-right-radius:20px;
					border-bottom-left-radius:20px;
					background:#f1c5b4
				}
				.head .face:after {
					content:"";
					position:absolute;
					top:16px;
					left:-10px;
					width:50px;
					height:20px;
					border-radius:20px;
					border-bottom-right-radius:0;
					background:#fff
				}
				.head .face .adds {
					position:absolute;
					top:0;
					left:-10px;
					width:40px;
					height:20px;
					border-radius:20px;
					background:#f1c5b4
				}
				.head .face .adds:after {
					content:"";
					position:absolute;
					top:5px;
					left:80px;
					width:15px;
					height:20px;
					border-bottom-right-radius:20px;
					border-top-right-radius:20px;
					background:#f1c5b4
				}
				.head .hat {
					position:absolute;
					bottom:106px;
					left:0;
					width:160px;
					height:20px;
					border-radius:20px;
					background:#3f64ce
				}
				.head .hat:before {
					content:"";
					position:absolute;
					top:-70px;
					left:50%;
					transform:translatex(-50%);
					width:0;
					height:0;
					border-style:solid;
					border-width:0 34px 70px 50px;
					border-color:transparent transparent #3f64ce
				}
				.head .hat:after {
					content:"";
					position:absolute;
					top:0;
					left:0;
					width:160px;
					height:20px;
					background:#3f64ce;
					border-radius:20px
				}
				.head .hat .hat-of-the-hat {
					position:absolute;
					bottom:78px;
					left:79px;
					width:0;
					height:0;
					border-style:solid;
					border-width:0 25px 25px 19px;
					border-color:transparent transparent #3f64ce
				}
				.head .hat .hat-of-the-hat:after {
					content:"";
					position:absolute;
					top:6px;
					left:-4px;
					width:35px;
					height:10px;
					border-radius:10px;
					border-bottom-left-radius:0;
					background:#3f64ce;
					transform:rotate(40deg)
				}
				.head .hat .four-point-star {
					position:absolute;
					width:12px;
					height:12px
				}
				.head .hat .four-point-star:after,.head .hat .four-point-star:before {
					content:"";
					position:absolute;
					background:#fff;
					display:block;
					left:0;
					width:141.4213%;
					top:0;
					bottom:0;
					border-radius:10%;
					transform:rotate(66.66deg) skewX(45deg)
				}
				.head .hat .four-point-star:after {
					transform:rotate(156.66deg) skew(45deg)
				}
				.head .hat .four-point-star.--first {
					bottom:28px;
					left:46px
				}
				.head .hat .four-point-star.--second {
					bottom:40px;
					left:80px
				}
				.head .hat .four-point-star.--third {
					bottom:15px;
					left:108px
				}
				@keyframes right_arm {
					0% { transform:rotate(70deg) }
					10% { transform:rotate(8deg) }
					15% { transform:rotate(20deg) }
					20% { transform:rotate(10deg) }
					25% { transform:rotate(26deg) }
					30% { transform:rotate(10deg) }
					35% { transform:rotate(28deg) }
					40% { transform:rotate(9deg) }
					45% { transform:rotate(28deg) }
					50% {transform:rotate(8deg) }
					58% { transform:rotate(74deg) }
					62% { transform:rotate(70deg) }
				}
				@keyframes left_arm {
					0% { transform:rotate(-70deg) }
					10% { transform:rotate(6deg) }
					15% { transform:rotate(-18deg) }
					20% { transform:rotate(5deg) }
					25% { transform:rotate(-18deg) }
					30% { transform:rotate(5deg) }
					35% { transform:rotate(-17deg) }
					40% { transform:rotate(5deg) }
					45% { transform:rotate(-18deg) }
					50% { transform:rotate(6deg) }
					58% { transform:rotate(-74deg) }
					62% { transform:rotate(-70deg) }
				}
				@keyframes right_hand {
					0% { transform:rotate(-40deg) }
					10% { transform:rotate(-20deg) }
					15% { transform:rotate(-5deg) }
					20% { transform:rotate(-60deg) }
					25% { transform:rotate(0deg) }
					30% { transform:rotate(-60deg) }
					35% { transform:rotate(0deg) }
					40% { transform:rotate(-40deg) }
					45% { transform:rotate(-60deg) }
					50% { transform:rotate(10deg) }
					60% { transform:rotate(-40deg) }
				}
				@keyframes right_finger {
					0% { transform:translateY(16px) }
					10% { transform:none }
					50% { transform:none }
					60% { transform:translateY(16px) }
				}
				@keyframes left_finger {
					0% { transform:scaleX(0) }
					10% { transform:scaleX(1) rotate(6deg) }
					15% { transform:scaleX(1) rotate(0deg) }
					20% { transform:scaleX(1) rotate(8deg) }
					25% { transform:scaleX(1) rotate(0deg) }
					30% { transform:scaleX(1) rotate(7deg) }
					35% { transform:scaleX(1) rotate(0deg) }
					40% { transform:scaleX(1) rotate(5deg) }
					45% { transform:scaleX(1) rotate(0deg) }
					50% { transform:scaleX(1) rotate(6deg) }
					58% { transform:scaleX(0) }
				}
				@keyframes head {
					0% { transform:rotate(-3deg) }
					10% { transform:translatex(10px) rotate(7deg) }
					50% { transform:translatex(0px) rotate(0deg) }
					56% { transform:rotate(-3deg) }
				}
				.objects {
					position:relative;
					width:200px;
					height:240px
				}
				.square {
					position:absolute;
					bottom:-60px;
					left:-5px;
					width:120px;
					height:120px;
					border-radius:50%;
					transform:rotate(-360deg);
					animation:path_square 10s ease-in-out infinite
				}
				.square:after {
					content:"";
					position:absolute;
					top:10px;
					left:0;
					width:50px;
					height:50px;
					background:#9ab3f5
				}
				.circle {
					position:absolute;
					bottom:10px;
					left:0;
					width:100px;
					height:100px;
					border-radius:50%;
					transform:rotate(-360deg);
					animation:path_circle 10s ease-in-out infinite
				}
				.circle:after {
					content:"";
					position:absolute;
					bottom:-10px;
					left:25px;
					width:50px;
					height:50px;
					border-radius:50%;
					background:#c56183
				}
				.triangle {
					position:absolute;
					bottom:-62px;
					left:-10px;
					width:110px;
					height:110px;
					border-radius:50%;
					transform:rotate(-360deg);
					animation:path_triangle 10s ease-in-out infinite
				}
				.triangle:after {
					content:"";
					position:absolute;
					top:0;
					right:-10px;
					width:0;
					height:0;
					border-style:solid;
					border-width:0 28px 48px;
					border-color:transparent transparent #89beb3
				}
				@keyframes path_circle {
					0% { transform:translateY(0) }
					10% { transform:translateY(-100px) rotate(-5deg) }
					55% { transform:translateY(-100px) rotate(-360deg) }
					58% { transform:translateY(-100px) rotate(-360deg) }
					63% { transform:rotate(-360deg) }
				}
				@keyframes path_square {
					0% { transform:translateY(0) }
					10% { transform:translateY(-155px) translatex(-15px) rotate(10deg) }
					55% { transform:translateY(-155px) translatex(-15px) rotate(-350deg) }
					57% { transform:translateY(-155px) translatex(-15px) rotate(-350deg) }
					63% { transform:rotate(-360deg) }
				}
				@keyframes path_triangle {
					000% { transform:translateY(0) }
					010% { transform:translateY(-172px) translatex(10px) rotate(-10deg) }
					055% { transform:translateY(-172px) translatex(10px) rotate(-365deg) }
					058% { transform:translateY(-172px) translatex(10px) rotate(-365deg) }
					063% { transform:rotate(-360deg) }
				}
				.progress,
				.log {
					position:relative;
					margin-top:20px;
					width:400px;
					height:20px;
					background:#eee
				}
				.progress:after {
					content:"";
					position:absolute;
					top:0;
					left:0;
					width:0;
					height:100%;
					background:#637373;
				}
				.log {
					height: 150px;
					overflow: hidden;
					padding: unset;
					color: mediumvioletred;
					white-space: pre-wrap;
				}
				.log pre {
					white-space: pre-wrap;
					overflow-y: scroll;
					margin: 0;
					top: 0;
					position: absolute;
					height: 100%;
				}
			</style>
		</head>
		<body>
			<div class="scene">
				<div class="objects">
					<div class="square"></div>
					<div class="circle"></div>
					<div class="triangle"></div>
				</div>
				<div class="wizard">
					<div class="body"></div>
					<div class="right-arm"><div class="right-hand"></div></div>
					<div class="left-arm"><div class="left-hand"></div></div>
					<div class="head">
						<div class="beard"></div>
						<div class="face"><div class="adds"></div></div>
						<div class="hat">
							<div class="hat-of-the-hat"></div>
							<div class="four-point-star --first"></div>
							<div class="four-point-star --second"></div>
							<div class="four-point-star --third"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="progress"></div>
			<div class="log" style="white-space: pre-wrap;">
				<pre>Building Pendryn for you!<br/>This may take some time, Please let this work and do not turn off or restart or close this device.</pre>
			</div>
			<script>
				console.log('here');
				window.document.onload = function(e){ 
					console.log('loaded');
					var xhr = new XMLHttpRequest();
					var url = "installer.php";
					var data = [
						[
							'<?=$_POST['company-name']?>',
							'<?=$_POST['company-address']?>',
							'<?=$_POST['company-phone']?>',
							'<?=$_POST['company-email']?>',
						], [
							'<?=$_POST['user-username']?>',
							'<?=$_POST['user-firstname']?>',
							'<?=$_POST['user-lastname']?>',
							'<?=$_POST['user-email']?>',
							'<?=$_POST['user-phone']?>',
							'<?=$_POST['user-password']?>',
							'<?=$_POST['user-password2']?>'
						], [
							'<?=$_POST['domain-www']?>',
							'<?=$_POST['domain-admin']?>',
							'<?=$_POST['domain-xpos']?>',
							'<?=$_POST['domain-blog']?>',
							'<?=$_POST['domain-api']?>',
						], [
							'<?=$_POST['db1-address']?>',
							'<?=$_POST['db1-username']?>',
							'<?=$_POST['db1-password']?>',
							'<?=$_POST['db2-address']?>',
							'<?=$_POST['db2-username']?>',
							'<?=$_POST['db2-password']?>',
						], [
							'<?=$_POST['security-salt']?>',
							'<?=$_POST['security-pepper']?>',
							'<?=$_POST['security-encryption']?>',
						]
					]
					
					data.forEach(element => console.log(element));

					/*
					xhr.open("POST", url, true);
					xhr.setRequestHeader("Content-Type", "application/json");
					xhr.onreadystatechange = function () {
						if (xhr.readyState === 4 && xhr.status === 200) {
							const response = JSON.parse(xhr.responseText);
							console.log(response);
						}
					};
					xhr.send(data);
					*/
				}
			</script>
		</body>
	</html>
<?
	} else {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<style>
				@import url(https://fonts.googleapis.com/css?family=Montserrat);

				* {
					margin: 0;
					padding: 0
				}

				html {
					height: 100%;
					background: linear-gradient(rgba(196, 102, 0, .6), rgba(155, 89, 182, .6));
					background-attachment: fixed
				}

				body {
					font-family: montserrat, arial, verdana
				}

				#msform {
					width: 100vw;
					margin: 50px auto;
					text-align: center;
					position: relative
				}

				#msform fieldset {
					background: #fff;
					border: 0 none;
					border-radius: 3px;
					box-shadow: 0 0 15px 1px rgba(0, 0, 0, .4);
					padding: 20px 30px;
					box-sizing: border-box;
					width: 80%;
					margin: 0 10%;
					position: relative
				}

				#msform fieldset span {
					display: flex;
					position: relative
				}

				#msform fieldset:not(:first-of-type) {
					display: none
				}

				#msform fieldset span p {
					cursor: help;
					position: relative;
					margin: 14px 0px 0px 5px;
				}

				#msform input,
				#msform select,
				#msform textarea {
					padding: 15px;
					border: 1px solid #ccc;
					border-radius: 3px;
					margin-bottom: 10px;
					width: 100%;
					box-sizing: border-box;
					font-family: montserrat;
					color: #2c3e50;
					font-size: 13px
				}

				#msform .action-button {
					width: 100px;
					background: #27ae60;
					font-weight: 700;
					color: #fff;
					border: 0 none;
					border-radius: 1px;
					cursor: pointer;
					padding: 10px;
					margin: 10px 5px;
					text-decoration: none;
					font-size: 14px
				}

				#msform .action-button:hover,
				#msform .action-button:focus {
					box-shadow: 0 0 0 2px #fff, 0 0 0 3px #27ae60
				}

				.fs-title {
					font-size: 15px;
					text-transform: uppercase;
					color: #2c3e50;
					margin-bottom: 10px
				}

				.fs-subtitle {
					font-weight: 400;
					font-size: 13px;
					color: #666;
					margin-bottom: 20px
				}

				#progressbar {
					margin-bottom: 30px;
					overflow: hidden;
					counter-reset: step;
					display: flex;
				}

				#progressbar li {
					list-style-type: none;
					color: #fff;
					text-transform: uppercase;
					font-size: 9px;
					width: 33.33%;
					float: left;
					position: relative
				}

				#progressbar li:before {
					content: counter(step);
					counter-increment: step;
					width: 20px;
					line-height: 20px;
					display: block;
					font-size: 10px;
					color: #333;
					background: #fff;
					border-radius: 3px;
					margin: 0 auto 5px auto
				}

				#progressbar li:after {
					content: '';
					width: 100%;
					height: 2px;
					background: #fff;
					position: absolute;
					left: -50%;
					top: 9px;
					z-index: -1
				}

				#progressbar li:first-child:after {
					content: none
				}

				#progressbar li.active:before,
				#progressbar li.active:after {
					background: #27ae60;
					color: #fff
				}
				@media(min-width: 576px) and (max-width: 767px) {
					#msform {
						width: 75vw;
					}
				}
				@media(min-width: 768px) and (max-width: 991px) {
					#msform {
						width: 60vw;
					}
				}
				@media(min-width: 992px) and (max-width: 1199px) {
					#msform {
						width: 50vw;
					}
				}
				@media(min-width: 1200px) and (max-width: 1399px) {
					#msform {
						width: 45vw;
					}
				}
				@media(min-width: 1400px) {
					#msform {
						width: 40vw;
					}
				}
			</style>
		</head>
		<body>
			<form id="msform" method="post" action="/installer.php" >
				<!-- progressbar -->
				<ul id="progressbar">
					<li class="active">Company Setup</li>
					<li>Default Users</li>
					<li>Domains</li>
					<li>Databases</li>
					<li>Security</li>
				</ul>
				<!-- fieldsets -->
				<fieldset> <!-- Company info -->
					<h2 class="fs-title">Create your company</h2>
					<h3 class="fs-subtitle">Here you can set up all of the default company information.</h3>
			
					<span><input validation="0" valid="false" type="text" name="company-name" placeholder="Company Name *" required/><p title="This will be the name of your company displayed">?</p></span>
					<span><input validation="1" valid="false" type="text" name="company-address" placeholder="Company Address *" required/><p title="The address for the company to be displayed at the bottom of the website">?</p></span>
					<span><input validation="2" valid="false" type="tel" name="company-phone" placeholder="Company Phone" /><p title="The public phone number for your company (Optional)">?</p></span>
					<span><input validation="3" valid="false" type="email" name="company-email" placeholder="Company Email *" required/><p title="The public email address for your company">?</p></span>

					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset> <!-- User Info -->
					<h2 class="fs-title">Create your user</h2>
					<h3 class="fs-subtitle">This will be the default administrator user</h3>

					<span><input validation="4" valid="false" type="text" name="user-username" placeholder="Username *" required/><p title="The username you would like to use to log in to all created websites">?</p></span>
					<span><input validation="0" valid="false" type="text" name="user-firstname" placeholder="Firstname *" required/><p title="Your first name">?</p></span>
					<span><input validation="0" valid="false" type="text" name="user-lastname" placeholder="Lastname *" required/><p title="Your last name">?</p></span>
					<span><input validation="3" valid="false" type="email" name="user-email" placeholder="Email *" required/><p title="Your email address">?</p></span>
					<span><input validation="2" valid="false" type="tel" name="user-phone" placeholder="Phone *" required/><p title="Your contact number">?</p></span>
					<span><input validation="5" valid="false" type="password" name="user-password" placeholder="Password *" required/><p title="The password used to log in to all created websites">?</p></span>
					<span><input validation="5" valid="false" type="password" name="user-password2" placeholder="Repeat password *" required/><p title="Repeat above password">?</p></span>

					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset> <!-- Domain Info -->
					<h2 class="fs-title">Domains</h2>
					<h3 class="fs-subtitle">Please enter the domains you would like to use with the following websites</h3>

					<span><input validation="6" valid="false" type="text" name="domain-www" placeholder="Public store *" /><p title="The public web-store, usually www.example.com">?</p></span>
					<span><input validation="6" valid="false" type="text" name="domain-admin" placeholder="Admin *" /><p title="The admin website for managing all orders etc. Usually admin.example.com">?</p></span>
					<span><input validation="6" valid="false" type="text" name="domain-blog" placeholder="Blog *" /><p title="the public blog website, usually blog.example.com">?</p></span>
					<span><input validation="6" valid="false" type="text" name="domain-xpos" placeholder="xPos *" /><p title="the in-person xPos terminsl, usually xpos.example.com">?</p></span>
					<span><input validation="6" valid="false" type="text" name="domain-api" placeholder="api *" /><p title="The api domain for all others to communicate to. usually api.example.com">?</p></span>

					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset> <!-- Database Info -->
					<h2 class="fs-title">Databases</h2>
					<h3 class="fs-subtitle">Please enter the information you would like to use with the following databases.</h3>

					<p>Central Database</p>
					<span><input validation="0" valid="false" type="text" name="db1-address" placeholder="Address *" /><p title="Usually an ip address or a domain">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db1-username" placeholder="Username *" /><p title="The username associated with the database">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db1-password" placeholder="Password *" /><p title="The password associated with the database for login">?</p></span>
					<p>Analytics Database</p>
					<span><input validation="0" valid="false" type="text" name="db2-address" placeholder="Address *" /><p title="Usually an ip address or a domain">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db2-username" placeholder="Username *" /><p title="The username associated with the database">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db2-password" placeholder="Password *" /><p title="The password associated with the database for login">?</p></span>

					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset> <!-- Security Info -->
					<h2 class="fs-title">Security Details</h2>
					<h3 class="fs-subtitle">
						Here you should enter security information to keep the website as secure as possible.
						DO NOT SHARE THIS INFORMATION.
					</h3>

					<span><input validation="0" valid="false" type="text" name="security-salt" placeholder="Salt *" /><p title="The 'salt' is a small bit of text added to the start of the password before it is encrypted">?</p></span>
					<span><input validation="0" valid="false" type="text" name="security-pepper" placeholder="Pepper *" /><p title="The 'pepper' is a small bit of text added to the end of the password before it is encrypted">?</p></span>
					<span>
						<select name="security-encryption">
							<option value="0" selected>-- Password Encryption *</option>
							<option value="md2">md2</option>
							<option value="md4">md4</option>
							<option value="md5">md5</option>
							<option value="sha1">sha1</option>
							<option value="sha256">sha256</option>
							<option value="sha384">sha384</option>
							<option value="sha512">sha512</option>
							<option value="ripemd128">ripemd128</option>
							<option value="ripemd160">ripemd160</option>
							<option value="ripemd256">ripemd256</option>
							<option value="ripemd320">ripemd320</option>
							<option value="whirlpool">whirlpool</option>
							<option value="snefru">snefru</option>
							<option value="gost">gost</option>
							<option value="adler32">adler32</option>
							<option value="crc32">crc32</option>
							<option value="crc32b">crc32b</option>
						</select>
						<p title="The type of encryption you would like to use">?</p>
					</span>

					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="submit" name="GUI" class="submit action-button" value="Submit" />
				</fieldset>
			</form>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
			<script>
				var current_fs,next_fs,previous_fs,left,opacity,scale,animating;$(".next").click((function(){if(animating)return!1;animating=!0,current_fs=$(this).parent(),next_fs=$(this).parent().next(),$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"),next_fs.show(),current_fs.animate({opacity:0},{step:function(e,t){scale=1-.2*(1-e),left=50*e+"%",opacity=1-e,current_fs.css({transform:"scale("+scale+")",position:"absolute"}),next_fs.css({left:left,opacity:opacity})},duration:800,complete:function(){current_fs.hide(),animating=!1},easing:"easeInOutBack"})})),$(".previous").click((function(){if(animating)return!1;animating=!0,current_fs=$(this).parent(),previous_fs=$(this).parent().prev(),$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"),previous_fs.show(),current_fs.animate({opacity:0},{step:function(e,t){scale=.8+.2*(1-e),left=50*(1-e)+"%",opacity=1-e,current_fs.css({left:left}),previous_fs.css({transform:"scale("+scale+")",opacity:opacity})},duration:800,complete:function(){current_fs.hide(),animating=!1},easing:"easeInOutBack"})}));
				$('input').bind('input propertychange', function() {
					$('#msform input').each(function () {
						x=$(this).attr('validation');
						var mailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
						var phoneRegex = /\(?([0-9]{5})\)?([ .-]?)([0-9]{3})\2([0-9]{3})/;
						var usernameRegex = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
						var addressRegex = /\b\d{1,6} +.{2,25}\b(avenue|ave|court|ct|street|st|drive|dr|lane|ln|road|rd|blvd|plaza|parkway|pkwy)/;
						var passwordRegex = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%&? "]).*$/;
						var urlRegex = /((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[+~%\/.\w-]*)?\??(?:[-+=&;%@.\w])#?(?:[\w]))?)/;
						if(x==1) { // Address
							if(addressRegex.test($(this).val())) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your address')
								$(this).attr('valid', false)
							}
						} else if(x==2) { // Phone
							if(phoneRegex.test($(this).val())) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your phone')
								$(this).attr('valid', false)
							}
						} else if(x==3) { // Email
							if(mailRegex.test($(this).val())) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your email')
								$(this).attr('valid', false)
							}
						} else if(x==4) { // Username
							if(usernameRegex.test($(this).val())) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your username')
								$(this).attr('valid', false)
							}
						} else if(x==5) { // passowrd
							if(passwordRegex.test($(this).val())) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your password')
								$(this).attr('valid', false)
							}
						} else  if(x==6) { // URL
								$(this).attr('valid', true)
							if(urlRegex.test($(this).val())) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your URL')
								$(this).attr('valid', false)
							}
						} else{
							if($(this).val().length > 3) {
								$(this).attr('valid', true)
							} else {
								console.log('There was an issue with your input')
								$(this).attr('valid', false)
							}
						}
					});
				});
			</script>
		</body>
	</html>
<?
	}
?>