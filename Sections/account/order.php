<?
	if($q = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Invoice ID`='%s' AND `Type`='Order'", QS))) {
		$order = mysqli_fetch_assoc($q);
		$currency = $order['Currency'];
		$fmt = new NumberFormatter( locale_get_default()."@currency=$currency", NumberFormatter::CURRENCY );
		$order_curr = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
		$user_id = $order['UID'];
		$order_items = explode(';', $order['Items']);
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
				position: absolute;
				top: 13px;
				z-index: -1;
			}
		/* --=== Contents ===-- */
			.order-progress-stepper .step.confirmed::before { content: "\f00c"; }
			.order-progress-stepper .step.awaDelivery::before { content: "\f007"; }
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
	<div class="container">
		<div class="mb-2 row p-2 border text-center">
			<div class="col-6 col-md-3 pb-3">
				<h5>Order ID:</h5>
				<p><?= ($order['Invoice ID']) ?></p>
			</div>
			<div class="col-6 col-md-3 pb-3">
				<h5>Order date: </h5>
				<p><?= (date('d M Y', strtotime($order['Created'])))?></p>
			</div>
			<hr class="d-block d-md-none" style="border-top: dashed 1px #dddddd;"/>
			<div class="col-6 col-md-3 pb-3">
				<h5>Estimated delivery date: </h5>
				<!--<p><?= (date('d M Y', strtotime($order['Created'].'+ 7 days')))?></p>-->
				<p><?= (date('d M Y', strtotime($order['Estimated del date'])))?></p>
			</div>
			<div class="col-6 col-md-3 pb-3">
				<h5>Shipped by: </h5>
				<p><?= ($order['Shipping by']) ?></p>
			</div>
		</div>
		<div class="col-12 order-progress-stepper">
			<?
				/**/if($order['Shipping status']==0):
					$s1 = 'active';
				elseif($order['Shipping status']==1):
					$s1='completed';
					$s2 = 'active';
				elseif($order['Shipping status']==2):
					$s1=$s2='completed';
					$s3 = 'active';
				elseif($order['Shipping status']==3):
					$s1=$s2=$s3='completed';
					$s4 = 'active';
				elseif($order['Shipping status']==4):
					$s1=$s2=$s3=$s4='completed';
				endif;
				print("
					<div class=\"step $s1 confirmed\">Order Confirmed</div>
					<div class=\"step $s2 awaDelivery\">Awaiting delivery</div>
					<div class=\"step $s3 dispatched\">On the way</div>
					<div class=\"step $s4 delivered\">Delivered</div>
				");
			?>
		</div>
		<hr />
		<?
			foreach($order_items as $order_item) {
				$item_info = explode(',', $order_item);
				$order_item_id = $item_info[0];
				$order_item_qty = $item_info[1];
				$order_item_opt = explode(',', $item_info[2]);
				if($q = DB_Query("SELECT * FROM `Product` WHERE `SKU`=$order_item_id AND `active`=1 LIMIT 1")) {
					while($res = mysqli_fetch_array($q)) {
						$order_item_image = explode(',', $res['Images'])[0];
						$order_item_slug = $res['Slug'];
						$order_item_title = $res['Title'];
						print_r($order_item_title);
						$titles=$options=array();

						$x = explode(';', $res['Variants']);
						foreach($x as $y) {
							$z = explode(':', $y);
							if(isset($z[0]) && isset($z[1])) {
								$ttl = $z[0];
								$opt = explode(',', $z[1]);
								if(isset($z[0]) && isset($z[1])) {
									array_push($titles,$ttl);
									array_push($options,$opt);
								}
							}
						}

					}
					print("
						<div class=\"row border-bottom p-3 / m-md-0 p-md-2 mx-md-5 px-md-5\">
							<div class=\"row col-12 pb-2 pb-md-0\">
								<div class=\"col-4 pe-3 / col-md-2\">
								<picture>
									<source srcset='".__API__."/Images/fetch/$order_item_image/jpeg/' type='image/jpeg'/>
									<source srcset='".__API__."/Images/fetch/$order_item_image/jpg/' type='image/jpg'/>
									<source srcset='".__API__."/Images/fetch/$order_item_image/png/' type='image/png'/>
									<source srcset='".__API__."/Images/fetch/$order_item_image/jpx/' type='image/jpx'/>
									<img src='".__API__."/Images/fetch/$order_item_image/webp/' type='image/webp' class=\"mw-100\" alt=\"$order_item_title\">
								</picture>
								</div>
								<div class=\"col-8 col-md-10 align-items-center\">
									<div class=\"top-50 position-relative\" style=\"transform:translatey(-50%);\">
										<p><a class=\"link-dark\" href=\"/Boutique/Product/$order_item_slug\">
											$order_item_title
										</a></p>
										<p class=\"font-monospace text-muted\">
					");
					for($n=0; $n<count($titles);$n++) {
						print(
							$titles[$n].': '.
							$options[$n][
								$item_options[$n]-1
							].'&nbsp;&nbsp;&nbsp;
						');
					}
					print("				</p>
									</div>
								</div>
							</div>
						</div>
					");
				}
			}
		?>
		<div class="row py-3">
			<div class="col-md-10">
				<?=($order['notes']) ?>
			</div>
			<div class="offset-md-10 col-md-2 text-end">
				<?
					$subtotal = $order['Subtotal'];
					$deposit = $order['Deposit'];
					$diff = $subtotal - $deposit;
					if($deposit == $subtotal) {
						print("<h4> Total: $subtotal</h4>");
					} else {
						print("	<h4> Total: $order_curr$subtotal</h4>
								<h3> Paid: $order_curr$deposit</h3>
								<hr />");
						if($deposit < $subtotal) {
							print("<h3 class=\"text-danger\"> Difference: $order_curr$diff</h3>");
						} else if($deposit > $subtotal) {
							print("<h3 class=\"text-success\"> Difference: $order_curr$diff</h3>");
						}
					}
				?>
				<a href="/My/Invoice/<?=(QS)?>" class="btn"> Get a printable copy</a>
			</div>
		</div>
	</div>
<?
	}
?>