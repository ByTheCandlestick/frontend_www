<?
	$query = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Transaction ID`='%s'", urldecode(QS)));
	if(mysqli_num_rows($query) > 0) {
		require_once(__ROOT__ . '/Vendor/StripeSecure/init.php');
		$stripe = new \Stripe\StripeClient(STRIPE_API[1]);
		if(explode('_', QS)[0] == 're') {
			$stripe->refunds->retrieve(
				QS,
				[]
			);
		} else {
			$stripe->charges->retrieve(
				QS,
				[]
			);
		}
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Transaction</h1>
				<p><?=QS?></p>
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
			<pre>
				<?=print_r($charge_info)?>
			</pre>
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