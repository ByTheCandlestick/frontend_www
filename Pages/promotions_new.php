<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Edit promo</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
		<div class="row">
			<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
				<a href="javascript:promo.save();" class="btn btn-outline-primary m-1">
					<i class="fa fa-save"></i>
				</a>
			</div>
		</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-2" name="Name">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Promoname</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="firstname">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">First name</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="lastname">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Last name</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="email">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Email</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="phone">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Phone no.</label>
			</div>
		</div>
		<div class="col-12 col-md-3 col-lg-2" name="misc">
			<div class="form-floating mb-3">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="reset_pass">
					<label class="form-check-label" for="flexCheckDisabled"> Reset password? </label>
				</div>
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="disable_analytics">
					<label class="form-check-label" for="flexCheckDisabled"> Disable analytics? </label>
				</div>
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled"  name="email_active">
					<label class="form-check-label" for="flexCheckDisabled"> Email activated? </label>
				</div>
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="promo_active">
					<label class="form-check-label" for="flexCheckDisabled"> Promo active? </label>
				</div>
			</div>
		</div>
	</div>
</section>