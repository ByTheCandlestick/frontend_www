<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Users` WHERE `ID`=%s", QS))) > 0) {
		$user = mysqli_fetch_assoc($query);
		$permissions = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_permissions` WHERE `UID`=%s", QS)));
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<h1>User permissions</h1>
			</div>
			<div class="col-12 col-md-6 col-lg-4 text-md-end">
				<a href="javascript:user.savePerm(<?print(QS)?>);" class="btn btn-outline-primary">
					<i class="fa fa-save"></i>
				</a>
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
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="'.$col.'" id="flexCheckDefault"'.$checked.'>
								<label class="form-check-label" for="flexCheckDefault">
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