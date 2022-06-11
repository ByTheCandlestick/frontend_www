<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Users` WHERE `ID`=%s", QS))) > 0) {
		$user = mysqli_fetch_assoc($query);
		$permissions = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s", QS)));
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>User permissions</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:user.savePerm(<?print(QS)?>);" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
				<div class="col-12 col-lg-6">
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<?
				$query = DB_Query("DESCRIBE `Users_permissions`");
				while($col = mysqli_fetch_array($query)[0]) {
					if($col != "UID") {
						($permissions[$col] == 1)? $checked = " checked" : $checked = "";
						print('
							<div class="form-check col-12 col-md-4 col-lg-2">
								<input class="form-check-input" type="checkbox" value="'.$col.'" id="permission_'.$col.'"'.$checked.'>
								<label class="form-check-label" for="permission_'.$col.'">
									'.$col.'
								</label>
							</div>
						');
					}
				}
			?>
		</div>
	</section>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>User not found.</h1>
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