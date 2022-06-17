<?
	$query = DB_Query(sprintf("SELECT * FROM `suppliers` WHERE `Reference`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$supp = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit supplier</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:supplier.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:supplier.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row SupplierInfo">
			<div class="col-12 col-md-6 col-lg-1" name="reference">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($supp['Reference'])?>">
					<label for="floatingInput">Reference</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($supp['Name'])?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="website">
				<div class="form-floating mb-3">
					<input type="tel" class="form-control" id="floatingInput" placeholder="" value="<?print($supp['Website'])?>">
					<label for="floatingInput">Website</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="email">
				<div class="form-floating mb-3">
					<input type="email" class="form-control" id="floatingInput" placeholder="" value="<?print($supp['Email'])?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="phone">
				<div class="form-floating mb-3">
					<input type="tel" class="form-control" id="floatingInput" placeholder="" value="<?print($supp['Phone'])?>">
					<label for="floatingInput">Phone</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-1" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="active" id="flexCheck" <?($supp['Active']==1)?print("checked"):print("")?>>
						<label class="form-check-label" for="flexCheck"> Active? </label>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="hours">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($supp['Opening Hours'])?>">
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