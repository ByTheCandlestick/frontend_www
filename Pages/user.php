<?
	$query = DB_Query(sprintf("SELECT * FROM `Users` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$user = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<h1>User info</h1>
			</div>
			<div class="col-12 col-md-6 col-lg-4 text-md-end">
				<a href="/User/Permissions/<?print(QS)?>" class="btn btn-outline-primary">
					<i class="fa fa-key"></i>
				</a>
				<a href="javascript:user.save(<?print(QS)?>);" class="btn btn-outline-primary">
					<i class="fa fa-save"></i>
				</a>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row" sku="<?print($user['ID'])?>">
			<div class="col-12 col-md-6 col-lg-2">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($user['Username'])?>">
					<label for="floatingInput">Username</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($user['First_name'])?>">
					<label for="floatingInput">First name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($user['Last_name'])?>">
					<label for="floatingInput">Last name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($user['Email'])?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($user['Phone'])?>">
					<label for="floatingInput">Phone no.</label>
				</div>
			</div>
			<div class="col-12 col-md-3 col-lg-2">
				<div class="form-floating mb-3">
					<? ($user['Change_password']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" <?print($checked)?>>
						<label class="form-check-label" for="flexCheckDisabled"> Reset password? </label>
					</div>
					<? ($user['Disable_analytics']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" <?print($checked)?>>
						<label class="form-check-label" for="flexCheckDisabled"> Disable analytics? </label>
					</div>
					<? ($user['Email_active']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" <?print($checked)?>>
						<label class="form-check-label" for="flexCheckDisabled"> Email activated? </label>
					</div>
					<? ($user['active']==1)?$checked="checked":$checked=""; ?>
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" <?print($checked)?>>
						<label class="form-check-label" for="flexCheckDisabled"> User active? </label>
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
			<div class="col-12 col-md-6 col-lg-8">
				<h1>User not found.</h1>
			</div>
			<div class="col-12 col-md-6 col-lg-4 text-md-end">
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