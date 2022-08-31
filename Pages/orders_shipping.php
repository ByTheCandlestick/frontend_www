<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Invoice ID`='%s'", QS))) > 0) {
		$invoice = mysqli_fetch_assoc($query);
		$delivery = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `products_shippings` WHERE `id`=%s", $invoice['Shipping by'])));

?>
<style>
	/* --=== standard ===-- */
		.order-progress-stepper {
			width: 100%;
			display: flex;
			flex-direction: row;
			flex-wrap: nowrap;
			justify-content: space-between;
			background: transparent;
		}
		.order-progress-stepper .step {
			padding: 0;
			margin: 0;
			flex-grow: 0;
			width: 100%;
			text-align: center;
			position: relative;
			font-weight: bold;
		}
		.order-progress-stepper .step::before {
			font-family: "Font Awesome 5 Pro";
			content: "\f128";
			font-weight: 900;
		}
	/* --=== Before and after ===-- */
		.order-progress-stepper .step::before {
			background-color: white;
			display: block;
			border-radius: 50%;
			width: 35px;
			height: 35px;
			line-height: 35px;
			margin: 0 auto 10px auto;
			text-align: center;
		}
		.order-progress-stepper .step::after {
			content: "";
			display: block;
			width: 100%;
			background-color: #ddd;
			height: 5px;
			top: 13px;
			z-index: -1;
		}
	/* --=== Contents ===-- */
		.order-progress-stepper .step.confirmed::before { content: "\f00c"; }
		.order-progress-stepper .step.picked::before { content: "\f007"; }
		.order-progress-stepper .step.dispatched::before { content: "\f0d1"; }
		.order-progress-stepper .step.delivered::before { content: "\f466"; }
		.order-progress-stepper .step.completed::before { content: "\f00c"; }
		.order-progress-stepper .step.caution::before { content: "\f12a"; }
		.order-progress-stepper .step.error::before { content: "\f00d"; }
	/* --=== Font colours ===-- */
		.order-progress-stepper .step::before { color: #ffffff; }
		.order-progress-stepper .step.active { color: #009cde; }
		.order-progress-stepper .step.active { color: #009cde; }
		.order-progress-stepper .step.caution { color: #ff8200; }
		.order-progress-stepper .step.error { color: #d50032; }
	/* --=== Background colours ===-- */
		.order-progress-stepper .step::before,
		.order-progress-stepper .step::after { background-color: #dadada; }
		.order-progress-stepper .step.completed::before,
		.order-progress-stepper .step.completed::after { background-color: #4caf50; }
		.order-progress-stepper .step.active::before,
		.order-progress-stepper .step.active::after { background-color: #009cde; }
		.order-progress-stepper .step.caution::before,
		.order-progress-stepper .step.caution::after { background-color: #ff8200; }
		.order-progress-stepper .step.error::before,
		.order-progress-stepper .step.error::after { background-color: #d50032; }
	/* --===  ===--*/
</style>
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
			<div class="order-progress-stepper">
				<?
					$s1=$s2=$s3=$s4='';
					if($order['Status'] > 0 && $order['Status'] <= 9) :
						$s1 = 'completed';
						$s2 = 'active';
					elseif($order['Status'] > 10 && $order['Status'] <= 19) :
						$s1=$s2 = 'completed';
						$s3 = 'active';
					elseif($order['Status'] > 20 && $order['Status'] <= 29) :
						$s1=$s2=$s3 = 'completed';
						$s4 = 'active';
					elseif($order['Status'] > 30 && $order['Status'] <= 39) :
						$s1=$s2=$s3=$s4 = 'completed';
					endif;

					print("
						<div class=\"step completed $s1 confirmed\">Order Confirmed</div>
						<div class=\"step completed $s2 picked\">Picked by courier</div>
						<div class=\"step $s3 dispatched\">On the way</div>
						<div class=\"step $s4 delivered\">Delivered</div>
					");
				?>
			</div>
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