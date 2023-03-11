<?
	$result = DB_Query("SELECT * FROM `Shop texts` where `Active`=1");
	while($texts = mysqli_fetch_array($result)) {
		$text[$texts['Name']] = $texts['Text'];
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
			<button class="nav-link" id="Materials-tab" data-bs-toggle="tab" data-bs-target="#Materials" type="button" role="tab" aria-controls="Materials" aria-selected="false">Materials</button>
		</li>
	</ul>
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade p-3 show active" id="description" role="tabpanel" aria-labelledby="description-tab">
			<?=($product['DescriptionLong']);?>
		</div>
		<div class="tab-pane fade p-3" id="candle_care" role="tabpanel" aria-labelledby="candle_care-tab">
			<?=($text['CandleCare']);?>
		</div>
		<div class="tab-pane fade p-3" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
			<?=($text['ShippingInfo']);?>
		</div>
		<div class="tab-pane fade p-3" id="Materials" role="tabpanel" aria-labelledby="Materials-tab">
			
		</div>
	</div>
</div>