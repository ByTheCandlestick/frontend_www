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

#msform fieldset:not(:first-of-type) {
    display: none
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
        width: 70vw;
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
	<form id="msform">
		<!-- progressbar -->
		<ul id="progressbar">
			<li class="active">Company Setup</li>
			<li>Default Users</li>
			<li>Security</li>
			<li>Databases</li>
		</ul>
		<!-- fieldsets -->
		<fieldset>
			<h2 class="fs-title">Create your company</h2>
			<h3 class="fs-subtitle">Here you can set up all of the default company information.</h3>

			<input type="text" name="companyName" placeholder="LexCorp" />
			<input type="text" name="companyAddress" placeholder="LexCorp Tower, Metropolis" />
			<input type="tel" name="companyPhone" placeholder="08320031986" />
			<input type="email" name="companyEmail" placeholder="Lex@lexcorp.com" />
			<textarea name="companydomains" placeholder="seperate domains with ';'"></textarea>

			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Create your user</h2>
			<h3 class="fs-subtitle">This will be the default administrator user</h3>

			<input type="text" name="companyName" placeholder="Username" />
			<input type="text" name="companyName" placeholder="Firstname" />
			<input type="text" name="companyName" placeholder="Lastname" />
			<input type="email" name="companyName" placeholder="Email" />
			<input type="tel" name="companyName" placeholder="Phone" />
			<input type="password" name="companyName" placeholder="Password" />
			<input type="password" name="companyName" placeholder="Repeat password" />

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Security Details</h2>
			<h3 class="fs-subtitle">Here you should enter security information to keep the website as secure as possible. DO NOT SHARE THIS INFORMATION.</h3>

			<input type="text" name="salt" placeholder="Salt" />
			<input type="text" name="pepper" placeholder="Pepper" />
			<input type="text" name="encryption" placeholder="Password Encryption" />

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Personal Details</h2>
			<h3 class="fs-subtitle">We will never sell it</h3>

			<input type="text" name="fname" placeholder="First Name" />
			<input type="text" name="lname" placeholder="Last Name" />
			<input type="text" name="phone" placeholder="Phone" />
			<textarea name="address" placeholder="Address"></textarea>

			<input type="button" name="previous" class="previous action-button" value="Previous" />
			<input type="button" name="next" class="next action-button" value="Next" />
			<a href="https://twitter.com/GoktepeAtakan" class="submit action-button" target="_top">Submit</a>
		</fieldset>
	</form>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script>
		var current_fs,next_fs,previous_fs,left,opacity,scale,animating;$(".next").click((function(){if(animating)return!1;animating=!0,current_fs=$(this).parent(),next_fs=$(this).parent().next(),$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active"),next_fs.show(),current_fs.animate({opacity:0},{step:function(e,t){scale=1-.2*(1-e),left=50*e+"%",opacity=1-e,current_fs.css({transform:"scale("+scale+")",position:"absolute"}),next_fs.css({left:left,opacity:opacity})},duration:800,complete:function(){current_fs.hide(),animating=!1},easing:"easeInOutBack"})})),$(".previous").click((function(){if(animating)return!1;animating=!0,current_fs=$(this).parent(),previous_fs=$(this).parent().prev(),$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"),previous_fs.show(),current_fs.animate({opacity:0},{step:function(e,t){scale=.8+.2*(1-e),left=50*(1-e)+"%",opacity=1-e,current_fs.css({left:left}),previous_fs.css({transform:"scale("+scale+")",opacity:opacity})},duration:800,complete:function(){current_fs.hide(),animating=!1},easing:"easeInOutBack"})}));
	</script>
</body>