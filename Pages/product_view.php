<?
	$prod = DB_Query(sprintf("SELECT  * FROM `products` WHERE `SKU`=%s", QS));
	print_r($prod);
?>
<div class="row" name="ProductInfo">
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">SKU</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-4">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">Title</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect" aria-label="Floating label select example">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Range</label>
		</div>
	</div>
	<div class="col-12 col-md-6 col-lg-4">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">IMAGES</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect" aria-label="Floating label select example">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Category</label>
		</div>
	</div>
	<div class="col-12 col-md-4 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect" aria-label="Floating label select example">
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
	<div class="col-12 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">Net Price</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">Gross Price</label>
		</div>
	</div>
	<div class="col-3 col-md-2 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">Currency</label>
		</div>
	</div>
	<div class="col-9 col-md-10 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="">
			<label for="floatingInput">Retail Price</label>
		</div>
	</div>
	<div class="col-9 col-md-10 col-lg-1">
		<div class="form-floating mb-3 input-group">
			<input type="text" class="form-control" id="floatingInput" placeholder="" aria-describedby="percentage">
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