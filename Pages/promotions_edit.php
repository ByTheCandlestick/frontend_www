<?
	$query = DB_Query(sprintf("SELECT * FROM `Promotions` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$promotion = mysqli_fetch_assoc($query);
		$categories = explode(',', $promotion['Category IDs']);
		$collections = explode(',', $promotion['Collection IDs']);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit Promotion</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="javascript:promotion.update();" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<div class="col-12 col-md-6 col-lg-2" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $promotion['Name']?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="percentage">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?= $promotion['Percentage discount']?>">
					<label for="floatingInput">Percentage</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="start">
				<div class="form-floating mb-3">
					<input type="date" class="form-control" id="floatingInput" placeholder="" value="<?= $promotion['Scheduled start']?>">
					<label for="floatingInput">Start</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="end">
				<div class="form-floating mb-3">
					<input type="date" class="form-control" id="floatingInput" placeholder="" value="<?= $promotion['Scheduled end']?>">
					<label for="floatingInput">End</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="voucher">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $promotion['Voucher']?>">
					<label for="floatingInput">Voucher</label>
				</div>
			</div>
			<div class="col-12 col-md-3 col-lg-2" name="misc">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<? ($promotion['Active']==1)?$checked="checked":$checked=""; ?>
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="active" <?=($checked)?>>
						<label class="form-check-label" for="flexCheckDisabled"> Active? </label>
					</div>
					<div class="form-check form-switch">
						<? ($promotion['Type']==1)?$checked="checked":$checked=""; ?>
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="voucher" <?=($checked)?>>
						<label class="form-check-label" for="flexCheckDisabled"> Voucher? </label>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4" name="description">
				<div class="form-floating mb-3">
					<textarea class="form-control" id="floatingInput" style="height: 132px;" placeholder=""><?= $promotion['Description']?></textarea>
					<label for="floatingInput">Description</label>
				</div>
			</div>
			
			<div class="col-12 col-md-6 col-lg-2" name="categories">
				<h5>Categories</h5>
				<?
					$query = DB_Query("SELECT * FROM `Product categories` WHERE `Active`=1");
					while($row = mysqli_fetch_array($query)) {
						(in_array($row['ID'], $categories))?$checked=" checked":$checked="";
						print('
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="' . $row['ID'] . '" id="StyleCheckboxes-'.$row['ID'].'" '.$checked.'>
								<label class="form-check-label" for="StyleCheckboxes-'.$row['ID'].'">
									' . $row['Name'] . '
								</label>
							</div>
						');
					}
				?>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="collections">
				<h5>Collections</h5>
				<?
					$query = DB_Query("SELECT * FROM `Product collections` WHERE `Active`=1");
					while($row = mysqli_fetch_array($query)) {
						(in_array($row['ID'], $collections))?$checked=" checked":$checked="";
						print('
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="' . $row['ID'] . '" id="StyleCheckboxes-'.$row['ID'].'" '.$checked.'>
								<label class="form-check-label" for="StyleCheckboxes-'.$row['ID'].'">
									' . $row['Name'] . '
								</label>
							</div>
						');
					}
				?>
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