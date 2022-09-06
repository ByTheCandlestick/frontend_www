<?
    if(strtolower(QS) == "new") {
?>
	<section>
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit shipping</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:product.shipping.create();" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row ">
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<!-- Type -->
			<div class="col-12 col-md-6 col-lg-3" name="supplier">
				<div class="form-floating mb-3">
					<select class="form-select" id="floatingSelect">
						<option value="-1" selected>Please select</option>
						<?
							$query = DB_Query("SELECT * FROM `Suppliers` WHERE `Active`=1");
							while ($row = mysqli_fetch_array($query)) {
								print_r('<option value="'.$row['Reference'].'">'.$row['Name'].'</option>');
							}
						?>
					</select>
					<label for="floatingInput">Supplier</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="supplierref">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Price (ea)'])?>">
					<label for="floatingInput">Price (ea)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="price_b">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Timescale'])?>">
					<label for="floatingInput">Timescale</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max weight'])?>">
					<label for="floatingInput">Max weight</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max length'])?>">
					<label for="floatingInput">Max length</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max width'])?>">
					<label for="floatingInput">Max width</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max height'])?>">
					<label for="floatingInput">QuanMax heighttity</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="active" id="flexCheck">
						<label class="form-check-label" for="flexCheck"> Active? </label>
					</div>
				</div>
			</div>
		</div>
	</section>
<?  } elseif(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Product shippings` WHERE `ID`=%s", QS))) > 0) {
        $shipping = mysqli_fetch_assoc($query);
?>
	<section>
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit shipping</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:product.shipping.delete(<?=(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:product.shipping.update(<?=(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row ">
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Name'])?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<!-- Type -->
			<div class="col-12 col-md-6 col-lg-3" name="supplier">
				<div class="form-floating mb-3">
					<select class="form-select" id="floatingSelect">
						<option value="-1" selected>Please select</option>
						<?
							$query = DB_Query("SELECT * FROM `Suppliers` WHERE `Active`=1");
							while ($row = mysqli_fetch_array($query)) {
								($row['Reference'] == $shipping['Supplier'])? $selected=' selected' : $selected='';
								print_r('<option value="'.$row['Reference'].'"'.$selected.'>'.$row['Name'].'</option>');
							}
						?>
					</select>
					<label for="floatingInput">Supplier</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="supplierref">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Price (ea)'])?>">
					<label for="floatingInput">Price (ea)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="price_b">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Timescale'])?>">
					<label for="floatingInput">Timescale</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max weight'])?>">
					<label for="floatingInput">Max weight</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max length'])?>">
					<label for="floatingInput">Max length</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max width'])?>">
					<label for="floatingInput">Max width</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?=($shipping['Max height'])?>">
					<label for="floatingInput">QuanMax heighttity</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="active" id="flexCheck" <?($shipping['Active']==1)?print("checked"):print("")?>>
						<label class="form-check-label" for="flexCheck"> Active? </label>
					</div>
				</div>
			</div>
		</div>
	</section>
<?
	} else {
?>
	<section>
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Shipping not found.</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			</div>
		</div>
		<hr>
		<div class="row">
			<button class="btn btn-outline-primary col-12 col-md-3 col-lg-1" onclick="history.go(-1)">Go back</buton>
		</div>
	</section>
<?
    }
?>