<?
	$query = DB_Query(sprintf("SELECT * FROM `suppliers` WHERE `Reference`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$supp = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>View supplier</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="/Suppliers/Edit/<?print(QS)?>/" class="btn btn-outline-primary m-1">
							<i class="fa fa-pencil"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="SupplierInfo">
			<div class="col-12 col-md-6 col-lg-3" name="reference">
				<div class="form-floating mb-3">
					<input type="text" class="form-control outline-none" id="floatingInput" placeholder="" value="<?print($supp['Reference'])?>" disabled>
					<label for="floatingInput">Reference</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control outline-none" id="floatingInput" placeholder="" value="<?print($supp['Name'])?>" disabled>
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="email">
				<div class="form-floating mb-3">
					<input type="email" class="form-control outline-none" id="floatingInput" placeholder="" value="<?print($supp['Email'])?>" disabled>
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="phone">
				<div class="form-floating mb-3">
					<input type="tel" class="form-control outline-none" id="floatingInput" placeholder="" value="<?print($supp['Phone'])?>" disabled>
					<label for="floatingInput">Phone</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="hours">
				<div class="form-floating mb-3">
					<input type="text" class="form-control outline-none" id="floatingInput" placeholder="" value="<?print($supp['Opening Hours'])?>" disabled>
					<label for="floatingInput">Opening hours</label>
				</div>
			</div>
		</div>
	</section>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Supplier not found.</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<button class="btn btn-outline-primary col-12 col-md-3 col-lg-1" onclick="history.go(-1)">Go back</buton>
		</div>
	</section>
<?
	}
?>