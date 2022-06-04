<?
	$prod = mysqli_fetch_assoc(DB_Query(sprintf("SELECT  * FROM `products` WHERE `SKU`=%s", QS)));
?>
<div class="row" name="ProductInfo">
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['SKU'])?>">
			<label for="floatingInput">SKU</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-4">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['Title'])?>">
			<label for="floatingInput">Title</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Range</label>
		</div>
	</div>
	<div class="col-12 col-md-6 col-lg-4">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['images'])?>">
			<label for="floatingInput">IMAGES</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Category</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Subcategory</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
				<label class="form-check-label" for="flexCheckDisabled"> Discontinued? </label>
			</div>
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled checked >
				<label class="form-check-label" for="flexCheckDisabled"> Active? </label>
			</div>
		</div>
	</div>
	<div class="col-3 col-md-2 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['Currency'])?>">
			<label for="floatingInput">Currency</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['NetPrice'])?>">
			<label for="floatingInput">Net</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['GrossPrice'])?>">
			<label for="floatingInput">Gross</label>
		</div>
	</div>
	<div class="col-9 col-md-10 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['RetailPrice'])?>">
			<label for="floatingInput">Retail</label>
		</div>
	</div>
	<div class="col-9 col-md-10 col-lg-1">
		<div class="form-floating mb-3 input-group">
			<input type="text" class="form-control" id="floatingInput" placeholder="" aria-describedby="percentage" value="<? print($prod['ProfitMargin'])?>">
			<label for="floatingInput">Markup</label>
			<span class="input-group-text" id="percentage">%</span>
		</div>
	</div>
	<!-- Discounted? -->
	<!-- Discount Type -->
	<!-- Discount ammount -->
	<!-- Container -->
	<!-- Wick -->
	<!-- Wickstand -->
	<!-- Material -->
	<!-- Fragrance -->
	<!-- Colour -->
	<!-- Packaging -->
	<!-- Shipping -->
	<!-- Qty on hand -->
	<!-- Qty available -->
	<!-- Qty Sold -->
	<!-- Qty to be shipped -->
	<!-- Qty shipped -->
	<!-- Description short -->
	<!-- Description Long -->
	<!-- Slug -->
	<!--  -->
	<!-- Made By -->
</div>