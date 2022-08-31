<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Invoice ID`='%s'", QS))) > 0) {
		$invoice = mysqli_fetch_assoc($query);
//		$delivery = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `products_shippings` WHERE `id`=%s", $invoice['Shipping to'])));
		print_r($invoice['Shipping to']);
		$q = DB_Query("DESCRIBE `products_shippings`");
		while($x=mysqli_fetch_array($q)) {
			print_r($x[0] . ' / ');
		}
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Order shipping</h1>
				<p>Invoice: <?print(QS)?></p>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						
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
				<h1>Invoice not found.</h1>
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