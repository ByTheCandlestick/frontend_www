<?
	$prod = mysqli_fetch_assoc(DB_Query(sprintf("SELECT  * FROM `products` WHERE `SKU`=%s", QS)));
?>
<div class="row" name="ProductInfo">
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-4">
			<h1>Product Info</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-8 text-end">
			<a href="#" class="btn btn-primary btn-lg disabled" tabindex="-1" role="button" aria-disabled="true">
				<i class="fa fa-pencil"></i>
			</a>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
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
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['Currency'])?>">
			<label for="floatingInput">Currency</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['GrossProfit'])?>">
			<label for="floatingInput">Profit</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['RetailPrice'])?>">
			<label for="floatingInput">Retail</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['NetPrice'])?>">
			<label for="floatingInput">Net</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['GrossPrice'])?>">
			<label for="floatingInput">Gross</label>
		</div>
	</div>
	<div class="col-6 col-md-3 col-lg-1">
		<div class="form-floating mb-3 input-group">
			<input type="text" class="form-control" id="floatingInput" placeholder="" aria-describedby="percentage" value="<?print($prod['ProfitMargin'])?>">
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
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
				<label class="form-check-label" for="flexCheckDisabled"> Auto-calculate Pricing? </label>
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
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Container</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Wick</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Wick Stand</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Material</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Fragrance</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Colour</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Packaging</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Shipping</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<select class="form-select" id="floatingSelect">
				<option selected>Please select</option>
			</select>
			<label for="floatingInput">Made by</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['QtyOnHand'])?>">
			<label for="floatingInput">QTY On Hand</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['QtyAvailable'])?>">
			<label for="floatingInput">QTY Available</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['QtyToBeShipped'])?>">
			<label for="floatingInput">QTY To Be Shipped</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['QtyShipped'])?>">
			<label for="floatingInput">QTY Shipped</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-4">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['DescriptionLong'])?>">
			<label for="floatingInput">Description Long</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-3">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['DescriptionShort'])?>">
			<label for="floatingInput">Description Short</label>
		</div>
	</div>
	<div class="col-12 col-md-3 col-lg-2">
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($prod['Slug'])?>">
			<label for="floatingInput">Slug</label>
		</div>
	</div>
</div>