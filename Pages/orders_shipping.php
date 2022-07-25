<?
	$cart_total = 0;
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Invoice ID`='%s'", QS))) > 0) {
		$invoice = mysqli_fetch_assoc($query);
		$address = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Users_address` WHERE `id`=%s `Type`='Order'", $invoice['Billing address'])));
		$delivery = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `products_shippings` WHERE `id`=%s", $invoice['Shipping to'])));
		$refunds = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Charge ID`='%s' AND `Type`='Refund' ORDER BY `Created` ASC", $invoice['ID']));
		$refundsValue = 0;
		while($refund = mysqli_fetch_assoc($refunds)) {
			$refundsValue += $refund['Subtotal'];
		}
		$income = ($invoice['Deposit'] - $invoice['Processing Fees']) - $invoice['tax'];
		$incomeAfterRefunds = (($invoice['Deposit'] - $invoice['Processing Fees']) - $invoice['tax']) - $refundsValue;
		$depositAfterRefunds = $invoice['Deposit'] - $refundsValue;
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