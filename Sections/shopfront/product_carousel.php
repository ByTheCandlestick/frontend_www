<?
	$images = explode(',', $product['Images'])
?>
<style>
	.slick-slider div {
		padding: 5px;
	}
</style>
<div class="row px-4 py-2">
	<div class="col-md-10 product-carousel">
		<?
			foreach($images as $prod_image) {
				print('
					<picture>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpeg/" type="image/jpeg"/>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpg/" type="image/jpg"/>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/png/" type="image/png"/>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpx/" type="image/jpx"/>
						<img src="'.__API__.'/Images/fetch/'. $prod_image .'/webp/" type="image/webp" width="100%" height="auto">
					</picture>
				');
			}
		?>
	</div>
	<div class="col-md-2 product-carousel-small">
		<?
			foreach($images as $prod_image) {
				print('
					<picture>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpeg/" type="image/jpeg"/>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpg/" type="image/jpg"/>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/png/" type="image/png"/>
						<source srcset="'.__API__.'/Images/fetch/'. $prod_image .'/jpx/" type="image/jpx"/>
						<img src="'.__API__.'/Images/fetch/'. $prod_image .'/webp/" type="image/webp" width="100%" height="auto">
					</picture>
				');
			}
		?>
	</div>
</div>