<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['GUI'])) {
		$status = array();
		if($_POST['type'] == 'install') {
			try {
				$repo_url = "https://github.com/ByTheCandlestick/frontend_www/archive/refs/heads/Live.zip";
				$zip_file = "repo.zip";
				// Download the zip file
				file_put_contents($zip_file, file_get_contents($repo_url));
				$zip = new ZipArchive;
				if ($zip->open($zip_file) === true) {
					$extract_path = "extracted";
					$zip->extractTo($extract_path);
					// TODO
					$zip->close();
				} else {
					throw new Error("Failed to open the zip file.");
				}
				unlink($zip_file);
				$status["status"] = "Success";
			} catch(Error $er) {
				$status["status"] = "Error";
				$status["message"] = $er->getMessage();
			}
			print_r(json_encode($status));
		} else if($_POST['type'] == 'db1') {
			try {
				// Check if database exists.
					$_POST['Address'] = 'access908228976.webspace-data.io';
					$_POST['Username'] = 'access908228976.webspace-data.io';
					$_POST['Password'] = 'CandleStick2603';

					if(!$conn = mysqli_connect($_POST['Address'], $_POST['Username'], $_POST['Password'])) {
						throw new Error('Unable to connect to the central DB, Please try again later');
					}

					$result = $conn->query(sprintf("SHOW DATABASES LIKE '%s'", $_POST['Name']));
					if(!$result || $result->num_rows <= 0) throw new Error("Database does not exist!");

					$conn->close();
				// Setup database
					// TODO
				$status["status"] = "Success";
			} catch(Error $er) {
				$status["status"] = "Error";
				$status["message"] = $er->getMessage();
			}
			print_r(json_encode($status));
		} else if($_POST['type'] == 'db2') {
			try {
				// Check if database exists.
					$_POST['Address'] = 'access908228976.webspace-data.io';
					$_POST['Username'] = 'access908228976.webspace-data.io';
					$_POST['Password'] = 'CandleStick2603';

					if(!$conn = mysqli_connect($_POST['Address'], $_POST['Username'], $_POST['Password'])) {
						throw new Error('Unable to connect to the central DB, Please try again later');
					}

					$result = $conn->query(sprintf("SHOW DATABASES LIKE '%s'", $_POST['Name']));
					if(!$result || $result->num_rows <= 0) throw new Error("Database does not exist!");

					$conn->close();
				// Setup database
					// TODO
				$status["status"] = "Success";
			} catch(Error $er) {
				$status["status"] = "Error";
				$status["message"] = $er->getMessage();
			}
			print_r(json_encode($status));
		} else if($_POST['type'] == 'company') {
			//Upload company information
		} else if($_POST['type'] == 'user') {
			//Upload user information
		} else if($_POST['type'] == 'domain') {
			//Upload domain information
		} else if($_POST['type'] == 'security') {
			//Upload security information
		}
	} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['GUI'] == 'Submit') {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.css" integrity="sha512-JP49dvydjvdq6qd31grbdqIeExUyLFFIIneoetY/cJ+eQeJ6ok5HhaM4kQfIeQV4maAMGQ5kf4In3T7VKwMufg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			<style>
				html {
					height: 100%;
					background: linear-gradient(rgba(196, 102, 0, .6), rgba(155, 89, 182, .6));
					background-attachment: fixed
				}

				body {
					display:flex;
					align-items:center;
					justify-content:center;
					flex-direction:column;
					flex-wrap:wrap;
					width:100vw;
					height:100vh;
					overflow:hidden;
					font-family: montserrat, arial, verdana;
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
					bottom:24px;
					left:51px
				}
				.head .hat .four-point-star.--second {
					bottom:47px;
					left:80px
				}
				.head .hat .four-point-star.--third {
					bottom:15px;
					left:97px
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
					0% { transform:translateY(0) }
					10% { transform:translateY(-172px) translatex(10px) rotate(-10deg) }
					55% { transform:translateY(-172px) translatex(10px) rotate(-365deg) }
					58% { transform:translateY(-172px) translatex(10px) rotate(-365deg) }
					63% { transform:rotate(-360deg) }
				}
				.progress,
				.log {
					position:relative;
					margin-top:20px;
					width:400px;
					height:20px;
					background:#eeeeee80;
					border-radius: 10px;
				}
				.progressInner {
					content: "";
					position: absolute;
					top: 0;
					left: 0;
					width: 0;
					height: 100%;
					background: #E91E63;
					border-radius: 10px;
					transition: width 1s;
				}
				.log {
					height: 150px;
					overflow: hidden;
					padding: unset;
					color: mediumvioletred;
				}
				.log pre::-webkit-scrollbar {
					display: none;
				}
				.log pre {
					-ms-overflow-style: none;
					scrollbar-width: none;
					white-space: pre-wrap;
					overflow: auto;
					margin: 0 0 0 15px;
					height: 100%;
				}
				.log pre p {
					margin: unset;
				}
				.modal a {
					text-decoration: none;
					color: orange;
					border: 2px orange solid;
					padding: 5px;
					border-radius: 5px;
					font-weight: bold;
					display: inherit;
				}
				.confetti-wrapper {
					position: relative;
					min-height: 100vh;
					min-width: 100vw;
					z-index: 2;
				}

				[class|=confetti] {
					position: absolute;
				}

				.red {
					background-color: #d13447;
				}

				.yellow {
					background-color: #ffbf00;
				}

				.blue {
					background-color: #263672;
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
			<div class="progress"><div class="progressInner"></div></div>
			<div class="log">
				<pre>
					<p>Building Pendryn for you!<br/>This may take several minutes. Please do not turn off, restart or close this device.</p>
				</pre>
			</div>
			<div id="modal-success" class="modal">
				<h1>installation success!</h1>
				<p>I am absolutely thrilled to congratulate you on successfully installing your new website, This accomplishment is a testament to your dedication, hard work, and technical prowess. As you embark on this exciting journey with Pendryn, you are opening up a world of opportunities and experiences for your users. Your creativity and ingenuity have come to life in the form of this fantastic platform, and I have no doubt that it will grow and evolve into something truly remarkable. Cheers to your incredible achievement, and may Pendryn exceed all your expectations and become a beacon of success in the digital realm!</p>
				<a href="<?php print($_POST['domain-www'])?>">Click here to go to your new website!.</a>
			</div>
			<div class="confetti-wrapper"></div>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js" integrity="sha512-ztxZscxb55lKL+xmWGZEbBHekIzy+1qYKHGZTWZYH1GUwxy0hiA18lW6ORIMj4DHRgvmP/qGcvqwEyFFV7OYVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script>
				var onePercent = $('.progress').width() / 100;
				elements = [
					{	type: 'install',
					},{	type: 'db1',
						Address: '<?=$_POST['db1-address']?>',
						Name: '<?=$_POST['db1-name']?>',
						Username: '<?=$_POST['db1-username']?>',
						Password: '<?=$_POST['db1-password']?>',
					}, {type: 'db2',
						Address: '<?=$_POST['db2-address']?>',
						Name: '<?=$_POST['db2-name']?>',
						Username: '<?=$_POST['db2-username']?>',
						Password: '<?=$_POST['db2-password']?>',
					}, {type: 'company',
						Name: '<?=$_POST['company-name']?>',
						Address: '<?=$_POST['company-address']?>',
						Phone: '<?=$_POST['company-phone']?>',
						Email: '<?=$_POST['company-email']?>',
					}, {type: 'user',
						Username: '<?=$_POST['user-username']?>',
						Firstname: '<?=$_POST['user-firstname']?>',
						Lastname: '<?=$_POST['user-lastname']?>',
						Email: '<?=$_POST['user-email']?>',
						Phone: '<?=$_POST['user-phone']?>',
						Password: '<?=$_POST['user-password']?>',
						Password2: '<?=$_POST['user-password2']?>',
					}, {type: 'domain',
						Www: '<?=$_POST['domain-www']?>',
						Admin: '<?=$_POST['domain-admin']?>',
						Xpos: '<?=$_POST['domain-xpos']?>',
						Blog: '<?=$_POST['domain-blog']?>',
						Api: '<?=$_POST['domain-api']?>',
					}, {type: 'security',
						Salt: '<?=$_POST['security-salt']?>',
						Sepper: '<?=$_POST['security-pepper']?>',
						Encryption: '<?=$_POST['security-encryption']?>',
					}
				]
				totalVars = 0;
				elements.forEach(element => {
					totalVars += Object.keys(element).length;
				});
				postData(elements, totalVars);
				async function postData(elements) {
					try {
						var count, successes = 0
						for (const data of elements) {
							keys = Object.keys(data).length;
							data['weight'] = (keys / totalVars) * 100;
							await request(data).then((res) => {
								res = JSON.parse(res);
								if(res.status.toLowerCase() == "success") {
									$(".progressInner").width($('.progressInner').width()+(data.weight * onePercent));
									$(".log pre").html($(".log pre").html()+"<p>Successfully setup section: "+data.type+".</p>");
								} else {
									throw new Error(res.message);
								}
							});
						}
						$("#modal-success").modal({
							escapeClose: false,
							clickClose: false,
							showClose: false
						});
						for(var i = 0; i < 150; i++){create(i);}
					} catch(error) {
						$(".log pre").html($(".log pre").html()+"<p>"+error+"</p>");
					}
				}
				function request(data) {
					return $.ajax({
						method: "POST",
						url: "/installer.php",
						data: data
					});
				}
				function create(i) {
					var width = Math.random() * 8;
					var height = width * 0.4;
					var colourIdx = Math.ceil(Math.random() * 3);
					var colour = "red";
					switch(colourIdx) {
						case 1:
						colour = "yellow";
						break;
						case 2:
						colour = "blue";
						break;
						default:
						colour = "red";
					}
					$('<div class="confetti-'+i+' '+colour+'"></div>').css({
						"width" : width+"px",
						"height" : height+"px",
						"top" : -Math.random()*20+"%",
						"left" : Math.random()*100+"%",
						"opacity" : Math.random()+0.5,
						"transform" : "rotate("+Math.random()*360+"deg)"
					}).appendTo('.confetti-wrapper');  
					
					drop(i);
				}
				function drop(x) {
					$('.confetti-'+x).animate({
						top: "100%",
						left: "+="+Math.random()*15+"%"
					}, Math.random()*2000 + 4000, function() {
						reset(x);
					});
				}
				function reset(x) {
					$('.confetti-'+x).animate({
						"top" : -Math.random()*20+"%",
						"left" : "-="+Math.random()*15+"%"
					}, 0, function() {
						drop(x);             
					});
				}
			</script>
		</body>
	</html>
<?php
	} else {
?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
					position: relative;
					padding-bottom: 20px;
				}

				#msform fieldset {
					background: #fff;
					border: 0 none;
					border-radius: 3px;
					box-shadow: 0 0 15px 1px rgba(0, 0, 0, .4);
					padding: 20px 30px;
					width: 100%;
					box-sizing: border-box;
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
					display: none;
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
				#msform {
					width: 100vw;
				}
				@media (min-width: 320px) {
					#msform {
						width: 90vw;
					}
				}
				@media (min-width: 480px) {
					#msform {
						width: 75vw;
					}
				}
				@media (min-width: 768px) {
					#msform fieldset span p {
						display: block;
					}
					#msform {
						width: 60vw;
					}
				}
				@media (min-width: 992px) {
					#msform {
						width: 50vw;
					}
				}
				@media (min-width: 1024px) {
					#msform {
						width: 47vw;
					}
				}
				@media (min-width: 1200px) {
					#msform {
						width: 45vw;
					}
				}
				@media (min-width: 1400px) {
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
					<li class="active">Welcome</li>
					<li>Licence</li>
					<li>Company Setup</li>
					<li>Default Users</li>
					<li>Domains</li>
					<li>Databases</li>
					<li>Security</li>
				</ul>
				<!-- fieldsets -->
				<fieldset> <!-- Welcome -->
					<h2 class="fs-title">Welcome to Pendryn!</h2>
					<h3 class="fs-subtitle">Shop like a pro - online and on the go!</h3>
					<p>
						Hello there, and welcome to our installation wizard for Pendryn!
						We're thrilled that you've decided to give our product a try and we can't wait to show you how it can simplify your workflow.
						Our team has put a lot of love and care into creating a user-friendly platform that's both easy to use and packed with powerful features.
						We're here to guide you through the installation process and make sure that you have everything you need to get started.
						Let's get going and discover how our software can help you achieve your goals with ease!</p>
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset> <!-- Licence -->
					<h2 class="fs-title">Licence!</h2>
					<h3 class="fs-subtitle">Before you get started, we kindly ask that you review and accept our license and terms. This helps ensure a positive experience for everyone and protects your rights as a user. Thank you for your cooperation!</h3>
					<p>
						<h4>Fair Use Terms and Conditions</h4>
						Please read these terms and conditions ("Terms") carefully before using our website ("Product"). By using our Product, you agree to be bound by these Terms.
						</br></br>
						<h4>Licence</h4>
						This product is protected under the GNU Affero General Public License (GNU AGPL).
						</br></br>
						<h4>Ownership and Purchase</h4>
						You must purchase our Product prior to use. You are granted a non-exclusive, non-transferable license to use the Product for your personal or business use only. All rights, title, and interest in and to the Product, including all intellectual property rights, are and will remain the exclusive property of the owner.
						</br></br>
						<h4>Piracy</h4>
						Piracy is illegal and strictly prohibited. You agree not to reproduce, distribute, modify, sell, or exploit any part of the Product without the prior written consent of the owner. Any unauthorized use may lead to legal action.
						</br></br>
						<h4>Defamation and Changes</h4>
						You agree not to use the Product in any manner that could damage, disable, overburden, or impair it. You also agree not to use the Product to defame, harass, or threaten any person or entity. Any attempt to modify, reverse-engineer, or create derivative works of the Product is strictly prohibited.
						</br></br>
						<h4>Termination and Refund</h4>
						We reserve the right to terminate your license to use the Product at any time, with or without cause, and without notice. In the event of termination, you must immediately cease all use of the Product and destroy all copies of the Product in your possession. No refund will be provided in case of termination or violation of these Terms.
						</br></br>
						<h4>Statutory rights</h4>
						These Terms do not affect your statutory rights.
					</p>
					
					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Accept" />
				</fieldset>
				<fieldset> <!-- Company info -->
					<h2 class="fs-title">Create your company</h2>
					<h3 class="fs-subtitle">Here you can set up all of the default company information.</h3>
			
					<span><input validation="0" valid="false" type="text" name="company-name" placeholder="Company Name *" required/><p title="This will be the name of your company displayed">?</p></span>
					<span><input validation="1" valid="false" type="text" name="company-address" placeholder="Company Address *" required/><p title="The address for the company to be displayed at the bottom of the website">?</p></span>
					<span><input validation="2" valid="false" type="tel" name="company-phone" placeholder="Company Phone" /><p title="The public phone number for your company (Optional)">?</p></span>
					<span><input validation="3" valid="false" type="email" name="company-email" placeholder="Company Email *" required/><p title="The public email address for your company">?</p></span>

					<input type="button" name="previous" class="previous action-button" value="Previous" />
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
					<span><input validation="0" valid="false" type="text" name="db1-name" placeholder="Name *" /><p title="The name for the database to connect to">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db1-username" placeholder="Username *" /><p title="The username associated with the database">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db1-password" placeholder="Password *" /><p title="The password associated with the database for login">?</p></span>
					<p>Analytics Database</p>
					<span><input validation="0" valid="false" type="text" name="db2-address" placeholder="Address *" /><p title="Usually an ip address or a domain">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db1-name" placeholder="Name *" /><p title="The name for the database to connect to">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db2-username" placeholder="Username *" /><p title="The username associated with the database">?</p></span>
					<span><input validation="0" valid="false" type="text" name="db2-password" placeholder="Password *" /><p title="The password associated with the database for login">?</p></span>

					<input type="button" name="previous" class="previous action-button" value="Previous" />
					<input type="button" name="next" class="next action-button" value="Next" />
				</fieldset>
				<fieldset> <!-- Security `Info -->
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
<?php
	}
?>