<?
	$result = DB_Query("SELECT * FROM `shop_texts` where `active`=1");
	while($texts = mysqli_fetch_array($result)) {
		$text[$texts['name']] = $texts['text'];
	}
?>
<div class="accordion px-4 py-2" id="product-accordian">
	<div class="accordion-item">
		<h2 class="accordion-header" id="accordion-item-1">
			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-1" aria-expanded="true" aria-controls="accordion-collapse-1">
				Description
			</button>
		</h2>
		<div id="accordion-collapse-1" class="accordion-collapse collapse show" aria-labelledby="accordion-item-1" data-bs-parent="#product-accordian">
			<div class="accordion-body">
				<?print($product['DescriptionLong']);?>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header" id="accordion-item-2">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-2" aria-expanded="false" aria-controls="collapseTwo">
				Candle care
			</button>
		</h2>
		<div id="accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="accordion-item-2" data-bs-parent="#product-accordian">
			<div class="accordion-body">
				<?print($text['CandleCare']);?>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header" id="accordion-item-3">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3" aria-expanded="true" aria-controls="accordion-collapse-3">
				Shipping
			</button>
		</h2>
		<div id="accordion-collapse-3" class="accordion-collapse collapse" aria-labelledby="accordion-item-3" data-bs-parent="#product-accordian">
			<div class="accordion-body">
				<?print($text['ShippingInfo']);?>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header" id="accordion-item-3">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-4" aria-expanded="true" aria-controls="accordion-collapse-3">
				Ingredients
			</button>
		</h2>
		<div id="accordion-collapse-3" class="accordion-collapse collapse" aria-labelledby="accordion-item-4" data-bs-parent="#product-accordian">
			<div class="accordion-body">

			</div>
		</div>
	</div>
</div>