<?
	$query = DB_Query(sprintf("SELECT `Charge_ID` FROM `Transactions` WHERE `Transaction ID`='%s'", urldecode(QS)));
	if(mysqli_num_rows($query) > 0) {
		print(mysqli_fetch_row($query))
		$stripe = new \Stripe\StripeClient(STRIPE_API);
		$stripe->charges->retrieve(
			'ch_3MYoVX2eZvKYlo2C0jJygcgm',
			[]
		);		  
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Transaction</h1>
				<p><?=$transaction['Transaction ID']?></p>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
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
				<h1>Transaction not found.</h1>
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