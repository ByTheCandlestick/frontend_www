<?
	$result = DB_Query("SELECT * FROM `shop_texts` where `active`=1");
	while($texts = mysqli_fetch_array($result)) {
		$text[$texts['name']] = $texts['text'];
	}
?>
<div class="tabs px-4 py-2" id="product-tabs">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item" role="presentation">
			<button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="candle_care-tab" data-bs-toggle="tab" data-bs-target="#candle_care" type="button" role="tab" aria-controls="candle_care" aria-selected="false">Candle Care</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping</button>
		</li>
		<li class="nav-item" role="presentation">
			<button class="nav-link" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab" aria-controls="ingredients" aria-selected="false">Ingredients</button>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade p-3 show active" id="description" role="tabpanel" aria-labelledby="description-tab">
			<?print($product['DescriptionLong']);?>
		</div>
		<div class="tab-pane fade p-3" id="candle_care" role="tabpanel" aria-labelledby="candle_care-tab">
			<?print($text['CandleCare']);?>
		</div>
		<div class="tab-pane fade p-3" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
			<?print($text['ShippingInfo']);?>
		</div>
		<div class="tab-pane fade p-3" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
			
		</div>
	</div>
</div>