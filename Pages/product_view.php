<?
	$prod = mysqli_fetch_assoc(DB_Query(sprintf("SELECT  * FROM `products` WHERE `SKU`=%s", QS)));
?>
<div class="row" name="ProductInfo">
	<div class="col-12 col-md-6 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['SKU'])?>">
			<label for="floatingInput">SKU</label>
		</div>
	</div>
	<div class="col-12 col-md-6 col-lg-4">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['Title'])?>">
			<label for="floatingInput">Title</label>
		</div>
	</div>
	<div class="col-12 col-md-6 col-lg-2">
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
	<div class="col-12 col-md-6 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Category</label>
		</div>
	</div>
	<div class="col-12 col-md-6 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Subcategory</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
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
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="GBP">
			<label for="floatingInput">Currency</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="-3.4">
			<label for="floatingInput">Profit</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="5.99">
			<label for="floatingInput">Retail</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="18.78">
			<label for="floatingInput">Net</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="9.39">
			<label for="floatingInput">Gross</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3 input-group">
			<input type="text" class="form-control" id="floatingInput" placeholder="" aria-describedby="percentage" value="100">
			<label for="floatingInput">Markup</label>
			<span class="input-group-text" id="percentage">%</span>
		</div>
	</div>
	<div class="col-12 col-md-2 col-lg-2">
		<div class="form-floating mb-3">
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
				<label class="form-check-label" for="flexCheckDisabled"> Discounted? </label>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
				<option>Percentage</option>
				<option>Value</option>
			</select>
			<label for="floatingInput">Discount type</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['DiscountAmount'])?>">
			<label for="floatingInput">Discount</label>
		</div>
	</div>


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