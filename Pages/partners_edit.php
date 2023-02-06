<?
	$query = DB_Query(sprintf("SELECT * FROM `Partner accounts` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$partner = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit partner</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:partner.delete(<?=(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:partner.update(<?=(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row PartnerInfo">
			<div class="col-12 col-md-6 col-lg-2" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Name']?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4" name="name">
				<div class="form-floating mb-3">
					<textarea type="text" class="form-control" id="floatingInput" placeholder=""><?= $partner['About short']?></textarea>
					<label for="floatingInput">Short description</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4" name="name">
				<div class="form-floating mb-3">
					<textarea type="text" class="form-control" id="floatingInput" placeholder=""><?= $partner['About long']?></textarea>
					<label for="floatingInput">About us</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Shop lonk']?>">
					<label for="floatingInput">Shop link</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Email']?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Phone']?>">
					<label for="floatingInput">Phone</label>
				</div>
			</div>
		</div>
	</section>
<?
	}
?>