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
			position: relative;
			z-index: 1;
		}
		.order-progress-stepper .step::after {
			content: "";
			display: block;
			width: 100%;
			background-color: #ddd;
			height: 5px;
			position: relative;
			z-index: 0;
			top: -70%;
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
	/* --=== First and last ===-- */
		.order-progress-stepper .step:first-child::after {
			width: 50%;
			left: 50%;
		}
		.order-progress-stepper .step:last-child::after {
			width: 50%;
		}
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
			<div class="col-12">
				<div class="mb-2 row p-2 border text-center">
					<div class="col-6 col-md-3 pb-3">
						<h5>Order ID:</h5>
						<p><?= ($invoice['Invoice ID']) ?></p>
					</div>
					<div class="col-6 col-md-3 pb-3">
						<h5>Order date: </h5>
						<p><?= (date('d M Y', strtotime($invoice['Created'])))?></p>
					</div>
					<hr class="d-block d-md-none" style="border-top: dashed 1px #dddddd;"/>
					<div class="col-6 col-md-3 pb-3">
						<h5>Estimated delivery date: </h5>
						<p><?= (date('d M Y', strtotime($invoice['Created'].'+ 7 days')))?></p>
					</div>
					<div class="col-6 col-md-3 pb-3">
						<h5>Shipped by: </h5>
						<p><?= ($invoice['Shipped by']) ?></p>
					</div>
				</div>
			</div>
			<div class="col-12 order-progress-stepper">
			<?
				/**/if($order['Shipping status']==0):
					$s1 = 'active';
					$s1_click='<a href="javascript:orders.updateStatus(1, \''.$invoice['Invoice ID'].'\');">Mark as Confirmed</a>';
					$s2_click='<a href="javascript:orders.updateStatus(2, \''.$invoice['Invoice ID'].'\');">Mark as picked</a>';
					$s3_click='<a href="javascript:orders.updateStatus(3, \''.$invoice['Invoice ID'].'\');">Mark as out for delivery</a>';
					$s4_click='<a href="javascript:orders.updateStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
				elseif($order['Shipping status']==1):
					$s1='completed';
					$s2 = 'active';
					$s1_click='Order Confirmed';
					$s2_click='<a href="javascript:orders.updateStatus(2, \''.$invoice['Invoice ID'].'\');">Mark as picked</a>';
					$s3_click='<a href="javascript:orders.updateStatus(3, \''.$invoice['Invoice ID'].'\');">Mark as out for delivery</a>';
					$s4_click='<a href="javascript:orders.updateStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
				elseif($order['Shipping status']==2):
					$s1=$s2='completed';
					$s3 = 'active';
					$s1_click='Order Confirmed';
					$s2_click='Picked up by courier';
					$s3_click='<a href="javascript:orders.updateStatus(3, \''.$invoice['Invoice ID'].'\');">Mark as out for delivery</a>';
					$s4_click='<a href="javascript:orders.updateStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
				elseif($order['Shipping status']==3):
					$s1=$s2=$s3='completed';
					$s4 = 'active';
					$s1_click='Order Confirmed';
					$s2_click='Picked up by courier';
					$s3_click='out for delivery';
					$s4_click='<a href="javascript:orders.updateStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
				elseif($order['Shipping status']==4):
					$s1=$s2=$s3=$s4='completed';
					$s1_click='Order Confirmed';
					$s2_click='Picked up by courier';
					$s3_click='out for delivery';
					$s4_click='Delivered';
				endif;
				print("
					<div class=\"step $s1 confirmed\">$s1_click</div>
					<div class=\"step $s2 picked\">$s2_click</div>
					<div class=\"step $s3 dispatched\">$s2_click</div>
					<div class=\"step $s4 delivered\">$s2_click</div>
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