<?
    if(strtolower(QS) == "new") {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit container</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:product.comodities.container.create();" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row containers">
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
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Supplier Reference</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="size">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">size (cl)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="price_b">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Price (bulk)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Quantity</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="price_e">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="" disabled>
					<label for="floatingInput">Price (ea)</label>
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
<?  } elseif(mysqli_num_rows($query) > 0) {
    	$query = DB_Query(sprintf("SELECT * FROM `Product containers` WHERE `ID`=%s", QS));
        $cont = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit container</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:product.comodities.container.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:product.comodities.container.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row containers">
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Name'])?>">
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
								($row['Reference'] == $cont['Supplier'])? $selected=' selected' : $selected='';
								print_r('<option value="'.$row['Reference'].'"'.$selected.'>'.$row['Name'].'</option>');
							}
						?>
					</select>
					<label for="floatingInput">Supplier</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="supplierref">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['ItemRef'])?>">
					<label for="floatingInput">Supplier Reference</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="size">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Size (cl)'])?>">
					<label for="floatingInput">size (cl)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="price_b">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Price (bulk)'])?>">
					<label for="floatingInput">Price (bulk)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="quantity">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Quantity'])?>">
					<label for="floatingInput">Quantity</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="price_e">
				<div class="form-floating mb-3">
					<input type="number" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Price (ea)'])?>" disabled>
					<label for="floatingInput">Price (ea)</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="active" id="flexCheck" <?($cont['Active']==1)?print("checked"):print("")?>>
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
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Container not found.</h1>
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