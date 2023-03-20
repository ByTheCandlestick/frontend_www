<!DOCTYPE html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<style>

@import url(https://fonts.googleapis.com/css?family=Montserrat);

* {
    margin: 0;
    padding: 0
}

html {
    height: 100%;
    background: linear-gradient(rgba(196, 102, 0, .6), rgba(155, 89, 182, .6))
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
    position: absolute;
    right: 10px;
    top: 14px;
}

#msform input,
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
	
			<span><input type="text" name="company-name" placeholder="Company Name *" required/><p title="This will be the name of your company displayed">?</p></span>
			<span><input type="text" name="company-address" placeholder="Company Address *" required/><p title="The address for the company to be displayed at the bottom of the website">?</p></span>
			<span><input type="tel" name="company-phone" placeholder="Company Phone" /><p title="The public phone number for your company (Optional)">?</p></span>
			<span><input type="email" name="company-email" placeholder="Company Email *" required/><p title="The public email address for your company">?</p></span>

			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset> <!-- User Info -->
			<h2 class="fs-title">Create your user</h2>
			<h3 class="fs-subtitle">This will be the default administrator user</h3>

			<span><input type="text" name="user-username" placeholder="Username *" required/><p title="The username you would like to use to log in to all created websites">?</p></span>
			<span><input type="text" name="user-firstname" placeholder="Firstname *" required/><p title="Your first name">?</p></span>
			<span><input type="text" name="user-lastname" placeholder="Lastname *" required/><p title="Your last name">?</p></span>
			<span><input type="email" name="user-email" placeholder="Email *" required/><p title="Your email address">?</p></span>
			<span><input type="tel" name="user-phone" placeholder="Phone *" required/><p title="Your contact number">?</p></span>
			<span><input type="password" name="user-password" placeholder="Password *" required/><p title="The password used to log in to all created websites">?</p></span>
			<span><input type="password" name="user-password2" placeholder="Repeat password *" required/><p title="Repeat above password">?</p></span>

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset> <!-- Domain Info -->
			<h2 class="fs-title">Domains</h2>
			<h3 class="fs-subtitle">Please enter the domains you would like to use with the following websites</h3>

			<span><input type="text" name="domain-www" placeholder="Public store *" /><p title="The public web-store, usually www.example.com">?</p></span>
			<span><input type="text" name="domain-admin" placeholder="Admin *" /><p title="The admin website for managing all orders etc. Usually admin.example.com">?</p></span>
			<span><input type="text" name="domain-blog" placeholder="Blog *" /><p title="the public blog website, usually blog.example.com">?</p></span>
			<span><input type="text" name="domain-blog" placeholder="xPos *" /><p title="the in-person xPos terminsl, usually xpos.example.com">?</p></span>
			<span><input type="text" name="domain-blog" placeholder="api *" /><p title="The api domain for all others to communicate to. usually api.example.com">?</p></span>

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset> <!-- Database Info -->
			<h2 class="fs-title">Databases</h2>
			<h3 class="fs-subtitle">Please enter the information you would like to use with the following databases.</h3>

			<p>Central Database</p>
			<span><input type="text" name="db1-address" placeholder="Address *" /><p title="Usually an ip address or a domain">?</p></span>
			<span><input type="text" name="db1-username" placeholder="Username *" /><p title="The username associated with the database">?</p></span>
			<span><input type="text" name="db1-password" placeholder="Password *" /><p title="The password associated with the database for login">?</p></span>
			<p>Analytics Database</p>
			<span><input type="text" name="db2-address" placeholder="Address *" /><p title="Usually an ip address or a domain">?</p></span>
			<span><input type="text" name="db2-username" placeholder="Username *" /><p title="The username associated with the database">?</p></span>
			<span><input type="text" name="db2-password" placeholder="Password *" /><p title="The password associated with the database for login">?</p></span>

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset> <!-- Security Info -->
			<h2 class="fs-title">Security Details</h2>
			<h3 class="fs-subtitle">
				Here you should enter security information to keep the website as secure as possible.
				DO NOT SHARE THIS INFORMATION.
			</h3>

			<span><input type="text" name="security-salt" placeholder="Salt" /><p title="The 'salt' is a small bit of text added to the start of the password before it is encrypted">?</p></span>
			<span><input type="text" name="security-pepper" placeholder="Pepper" /><p title="The 'pepper' is a small bit of text added to the end of the password before it is encrypted">?</p></span>
			<span>
				<select name="cars" id="cars">
					<option value="0" selected>-- Password Encryption --</option>
					<option value=""></option>
					<option value=""></option>
					<option value=""></option>
				</select>
				<p title="The type of encryption you would like to use">?</p>
			</span>

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="submit" name="next" class="submit action-button" value="Submit" />
		</fieldset>
	</form>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script>
		var current_fs,next_fs,previous_fs,left,opacity,scale,animating;$(".next").click((function(){if(animating)return!1;animating=!0,current_fs=$(this).parent(),next_fs=$(this).parent().next(),$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"),next_fs.show(),current_fs.animate({opacity:0},{step:function(e,t){scale=1-.2*(1-e),left=50*e+"%",opacity=1-e,current_fs.css({transform:"scale("+scale+")",position:"absolute"}),next_fs.css({left:left,opacity:opacity})},duration:800,complete:function(){current_fs.hide(),animating=!1},easing:"easeInOutBack"})})),$(".previous").click((function(){if(animating)return!1;animating=!0,current_fs=$(this).parent(),previous_fs=$(this).parent().prev(),$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"),previous_fs.show(),current_fs.animate({opacity:0},{step:function(e,t){scale=.8+.2*(1-e),left=50*(1-e)+"%",opacity=1-e,current_fs.css({left:left}),previous_fs.css({transform:"scale("+scale+")",opacity:opacity})},duration:800,complete:function(){current_fs.hide(),animating=!1},easing:"easeInOutBack"})}));
	</script>
</body>