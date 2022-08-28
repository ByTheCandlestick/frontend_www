<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `products` WHERE `SKU`=%s", QS))) > 0) {
		$prod = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit product</h1>
				<p><? print($prod['SKU'])?> - <? print($prod['Title'])?></p>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:product.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:product.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row ProductInfo">
			<div class="col-12 col-md-6 col-lg-7">
				<div class="row">
					<div class="col-12 col-lg-6" name="title">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['Title'])?>">
							<label for="floatingInput">Title</label>
						</div>
					</div>
					<div class="col-12 col-lg-6" name="images">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['Images'])?>">
							<label for="floatingInput">IMAGES</label>
						</div>
					</div>
					<div class="col-12 col-lg-6" name="category">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_categories` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Category_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Category</label>
						</div>
					</div>
					<div class="col-12 col-lg-6" name="range">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_collections` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Collection_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Range</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="status">
						<div class="form-floating mb-3">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="discontinued" id="flexCheck" <?($prod['Discontinued']==1)?print("checked"):print("")?>>
								<label class="form-check-label" for="flexCheck"> Discontinued? </label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="available" id="flexCheck" <?($prod['Active']==1)?print("checked"):print("")?>>
								<label class="form-check-label" for="flexCheck"> Active? </label>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="currency">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['Currency'])?>">
							<label for="floatingInput">Currency</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="profit">
						<div class="form-floating mb-3 input-group">
							<span class="input-group-text" id="GBP"><??>£</span>
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['GrossProfit'])?>" <?($prod['CalculatePricing']==1)?print("disabled"):print("")?>>
							<label for="floatingInput" class="ps-5">Profit</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="retail">
						<div class="form-floating mb-3 input-group">
							<span class="input-group-text" id="GBP"><??>£</span>
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['RetailPrice'])?>">
							<label for="floatingInput" class="ps-5">Retail</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="pricing">
						<div class="form-floating mb-3">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="discounted" id="flexCheck" <?($prod['Discount']==1)?print("checked"):print("")?>>
								<label class="form-check-label" for="flexCheck"> Discounted? </label>
							</div>
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="auto_calculate" id="flexCheck" <?($prod['CalculatePricing']==1)?print("checked"):print("")?>>
								<label class="form-check-label" for="flexCheck"> Auto-calculate Pricing? </label>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="net">
						<div class="form-floating mb-3 input-group">
							<span class="input-group-text" id="GBP"><??>£</span>
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['NetPrice'])?>" <?($prod['CalculatePricing']==1)?print("disabled"):print("")?>>
							<label for="floatingInput" class="ps-5">Net</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="gross">
						<div class="form-floating mb-3 input-group">
							<span class="input-group-text" id="GBP"><??>£</span>
							<input type="text" class="form-control" id="floatingInput" placeholder="" aria-describedby="GBP" value="<?print($prod['GrossPrice'])?>" <?($prod['CalculatePricing']==1)?print("disabled"):print("")?>>
							<label for="floatingInput" class="ps-5">Gross</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="markup">
						<div class="form-floating mb-3 input-group">
							<span class="input-group-text" id="GBP"><??>£</span>
							<input type="text" class="form-control" id="floatingInput" placeholder="" aria-describedby="percentage" value="<?print($prod['ProfitMargin'])?>" <?($prod['CalculatePricing']==0)?print("disabled"):print("")?>>
							<label for="floatingInput" class="ps-5">Markup</label>
							<span class="input-group-text" id="percentage">%</span>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="discount_type">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect" <?($prod['Discount']==0)?print("disabled"):print("")?>>
								<option value="-1" selected>Please select</option>
								<option>Percentage</option>
								<option>Value</option>
							</select>
							<label for="floatingInput">Discount type</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="discount_amount">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['DiscountAmount'])?>" <?($prod['Discount']==0)?print("disabled"):print("")?>>
							<label for="floatingInput">Discount</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="container">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_containers` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Container_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" size="'.$row['Size (cl)'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Container</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="wick">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_wicks` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Wick_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Wick</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="wick_stand">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_wickstands` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['WickStand_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Wick Stand</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="material">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_materials` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Material_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Material</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="fragrance">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_fragrances` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Fragrance_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Fragrance</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="colour">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_colours` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Colour_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Colour</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="packaging">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_packagings` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['Packaging_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Packaging</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="shipping">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `products_shippings` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['id'] == $prod['Shipping_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['id'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Shipping</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="made_by">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `partners` WHERE `Active`=1");
									while ($row = mysqli_fetch_array($query)) {
										($row['ID'] == $prod['made_by_ID'])? $selected=' selected' : $selected='';
										print_r('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'"'.$selected.'>'.$row['name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Made by</label>
						</div>
					</div>
					<div class="col-12 col-lg-4" name="slug">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['Slug'])?>">
							<label for="floatingInput">Slug</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-5">
				<div class="row">
					<div class="col-12" name="description_short">
						<input type="text" class="form-control description_short" id="floatingInput" placeholder="Short description" value="<?= $prod['DescriptionShort'] ?>">
					</div>
					<div class="col-12" name="description_long">
						<input type="text" class="form-control description_long" id="floatingInput" placeholder="Long description" value="<?= $prod['DescriptionLong'] ?>">
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		tinymce.init({
			selector: 'div[name=description_long] input, div[name=description_short] input',
			toolbar: 'undo redo |'+
					 'formatpainter casechange blocks |'+
					 'bold italic backcolor | '+
					 'alignleft aligncenter alignright alignjustify | ' +
					 'bullist numlist checklist outdent indent |'+
					 'removeformat |'+
					 'code table help'
		});
	</script>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Product not found.</h1>
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