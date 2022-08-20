<section class="bg_cover">
	<div class="main-form first">
		<div class="main-form__title">
			<h1>Login</h1>
			<h2></h2>
		</div>  
		<div class="main-form__body">
			<input class="main-form__body--input" name="username" type="text" value="" placeholder="Username"/>&#x9;
			<input class="main-form__body--input" name="password" type="password" value="" placeholder="Password"/>&#x9; 
			&#x9;
			<button class="btn full_btn" name="submit-login" onClick="JavaScript:account.login();">Login</button>
			<a href="/Register">Not got an account?</a> or <a href="/Forgotten-Password">Forgot your password?</a>
		</div>
	</div>
	<script>
		$("div[name=username], div[name=password]").keypress((e) => {
			if (!e) e = window.event;
			var keyCode = e.code || e.key;
			if (keyCode == 'Enter'){
				// Enter pressed
				return false;
			}
		})
	</script>
</section>