<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>New supplier</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="javascript:supplier.create();" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row SupplierInfo">
		<div class="col-12 col-md-6 col-lg-2" name="reference">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="">
				<label for="floatingInput">Reference</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="name">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="">
				<label for="floatingInput">Name</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="email">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="">
				<label for="floatingInput">Email</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="phone">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="">
				<label for="floatingInput">Phone</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-2" name="status">
			<div class="form-floating mb-3">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" name="active" id="flexCheck" checked>
					<label class="form-check-label" for="flexCheck"> Active? </label>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="hours">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="">
				<label for="floatingInput">Opening hours</label>
			</div>
		</div>
	</div>
</section>