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
				<label for="floatingInput">Name</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="description">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Description</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="percentage">
			<div class="form-floating mb-3">
				<input type="number" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Percentage</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="start">
			<div class="form-floating mb-3">
				<input type="date" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Start</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="end">
			<div class="form-floating mb-3">
				<input type="date" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">End</label>
			</div>
		</div>
		<div class="col-12 col-md-3 col-lg-2" name="misc">
			<div class="form-floating mb-3">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="active">
					<label class="form-check-label" for="flexCheckDisabled"> active? </label>
				</div>
			</div>
		</div>
	</div>
</section>