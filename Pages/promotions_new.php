<?
	$query = DB_Query(sprintf("SELECT * FROM `Promotions` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$promo = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit promo</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="javascript:promo.update(<?=(QS)?>);" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
					<a href="javascript:promo.delete(<?=(QS)?>);" class="btn btn-outline-danger m-1">
						<i class="fa fa-trash-alt"></i>
					</a>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row" sku="<?=($promo['ID'])?>">
			<div class="col-12 col-md-6 col-lg-2" name="promoname">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($promo['Promoname'])?>">
					<label for="floatingInput">Promoname</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="firstname">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($promo['First_name'])?>">
					<label for="floatingInput">First name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="lastname">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($promo['Last_name'])?>">
					<label for="floatingInput">Last name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="email">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($promo['Email'])?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="phone">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($promo['Phone'])?>">
					<label for="floatingInput">Phone no.</label>
				</div>
			</div>
			<div class="col-12 col-md-3 col-lg-2" name="misc">
				<div class="form-floating mb-3">
					<? ($promo['Change_password']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" <?=($checked)?> name="reset_pass">
						<label class="form-check-label" for="flexCheckDisabled"> Reset password? </label>
					</div>
					<? ($promo['Disable_analytics']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" <?=($checked)?> name="disable_analytics">
						<label class="form-check-label" for="flexCheckDisabled"> Disable analytics? </label>
					</div>
					<? ($promo['Email_active']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" <?=($checked)?> name="email_active">
						<label class="form-check-label" for="flexCheckDisabled"> Email activated? </label>
					</div>
					<? ($promo['Active']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" <?=($checked)?> name="promo_active">
						<label class="form-check-label" for="flexCheckDisabled"> Promo active? </label>
					</div>
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
				<h1>Promo not found.</h1>
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