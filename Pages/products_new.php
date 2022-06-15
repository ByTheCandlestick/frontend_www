<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>New product</h1>
			<p></p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:product.create();" class="btn btn-outline-primary m-1">
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
						<input type="text" class="form-control" id="floatingInput">
						<label for="floatingInput">Title</label>
					</div>
				</div>
				<div class="col-12 col-lg-6" name="images">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput">
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
									print('<option value="'.$row['ID'].'">'.$row['Name'].'</option>');
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
									print('<option value="'.$row['ID'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Range</label>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="status">
					<div class="form-floating mb-3">
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" name="discontinued" id="flexCheck">
							<label class="form-check-label" for="flexCheck"> Discontinued? </label>
						</div>
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" name="available" id="flexCheck" checked>
							<label class="form-check-label" for="flexCheck"> Active? </label>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="currency">
					<div class="form-floating mb-3 input-group">
						<span class="input-group-text" id="GBP">£</span>
						<input type="text" class="form-control" id="floatingInput" value="GBP">
						<label for="floatingInput" class="ps-5">Currency</label>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="profit">
					<div class="form-floating mb-3 input-group">
						<span class="input-group-text" id="GBP">£</span>
						<input type="text" class="form-control" id="floatingInput" value="0.00" disabled>
						<label for="floatingInput" class="ps-5">Profit</label>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="retail">
					<div class="form-floating mb-3 input-group">
						<span class="input-group-text" id="GBP">£</span>
						<input type="text" class="form-control" id="floatingInput" value="0.00">
						<label for="floatingInput" class="ps-5">Retail</label>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="pricing">
					<div class="form-floating mb-3">
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" name="discounted" id="flexCheck">
							<label class="form-check-label" for="flexCheck"> Discounted? </label>
						</div>
						<div class="form-check form-switch">
							<input class="form-check-input" type="checkbox" name="auto_calculate" id="flexCheck" checked>
							<label class="form-check-label" for="flexCheck"> Auto-calculate Pricing? </label>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="net">
					<div class="form-floating mb-3 input-group">
						<span class="input-group-text" id="GBP">£</span>
						<input type="text" class="form-control" id="floatingInput" value="0.00" disabled>
						<label for="floatingInput" class="ps-5">Net</label>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="gross">
					<div class="form-floating mb-3 input-group">
						<span class="input-group-text" id="GBP">£</span>
						<input type="text" class="form-control" id="floatingInput" value="0.00" aria-describedby="GBP" disabled>
						<label for="floatingInput" class="ps-5">Gross</label>
					</div>
				</div>
				<div class="col-12 col-lg-3" name="markup">
					<div class="form-floating mb-3 input-group">
						<span class="input-group-text" id="GBP">£</span>
						<input type="text" class="form-control" id="floatingInput" value="100" aria-describedby="percentage">
						<label for="floatingInput" class="ps-5">Markup</label>
						<span class="input-group-text" id="percentage">%</span>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="discount_type">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect" disabled>
							<option value="-1" selected>Please select</option>
							<option>Percentage</option>
							<option>Value</option>
						</select>
						<label for="floatingInput">Discount type</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="discount_amount">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="0.00" disabled>
						<label for="floatingInput">Discount</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="container">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0"selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_containers` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'" size="'.$row['Size (cl)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Container</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="wick">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_wicks` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Wick</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="wick_stand">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_wickstands` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Wick Stand</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="material">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_materials` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (cl)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Material</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="fragrance">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_fragrances` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (cl)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Fragrance</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="colour">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_colours` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (cl)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Colour</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="packaging">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_packagings` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['ID'].'" price="'.$row['Price (ea)'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Packaging</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="shipping">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" price="0" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `products_shippings` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print('<option value="'.$row['id'].'" price="'.$row['Price (ea)'].'">'.$row['Name'].'</option>');
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
									print('<option value="'.$row['ID'].'">'.$row['name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Made by</label>
					</div>
				</div>
				<div class="col-12 col-lg-4" name="slug">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput">
						<label for="floatingInput">Slug</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-5">
			<div class="row">
				<div class="col-12" name="description_short">
					<h5>Short description</h5>
					<input type="text" class="form-control" id="floatingInput" placeholder="">
				</div>
				<div class="col-12" name="description_long">
					<h5>Long description</h5>
					<input type="text" class="form-control" id="floatingInput" placeholder="">
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	desc_l = {
		char_lim: 512,
		smde: new SimpleMDE({
			element: $("div[name=description_long] input")[0],
			status: [ {
				className: "chars",
				defaultValue: function(el) {
					el.innerHTML = "0 / " + this.char_lim;
				},
				onUpdate: function(el) {
					el.innerHTML = this.smde.value().length + " / " + this.char_lim;
					
				}
			}]
		})
	};
	desc_s ={
		char_lim: 256,
		smde: new SimpleMDE({
			element: $("div[name=description_short] input")[0],
			status: [ {
				className: "chars",
				defaultValue: function(el) {
					el.innerHTML = "0 / " + desc_s.char_lim;
				},
				onUpdate: function(el) {
					el.innerHTML = this.smde.value().length + " / " + this.char_lim;
				}
			}]
		})
	};
</script>