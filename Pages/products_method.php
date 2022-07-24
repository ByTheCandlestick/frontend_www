<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `products` WHERE `SKU`=%s", QS))) > 0) {
		$prod = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Product Method</h1>
				<p><? print($prod['SKU'])?> - <? print($prod['Title'])?></p>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:alert(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-pencil"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">

		</div>
	</section>
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