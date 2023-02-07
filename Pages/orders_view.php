<?
	$cart_total = 0;
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Invoice ID`='%s' AND `Type`='Order'", QS))) > 0) {
		$invoice = mysqli_fetch_assoc($query);
		$address = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `User addresses` WHERE `id`=%s", $invoice['Billing address'])));
		$delivery = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Product shippings` WHERE `id`=%s", $invoice['Shipping by'])));
		$refunds = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Charge ID`='%s' AND `Type`='Refund' ORDER BY `Created` ASC", $invoice['Charge ID']));
		$refundsValue = 0;
		while($refund = mysqli_fetch_assoc($refunds)) {
			$refundsValue += $refund['Subtotal'];
		}
		$income = ($invoice['Deposit'] - $invoice['Processing Fees']) - $invoice['tax'];
		$incomeAfterRefunds = (($invoice['Deposit'] - $invoice['Processing Fees']) - $invoice['Tax']) - $refundsValue;
		$depositAfterRefunds = $invoice['Deposit'] - $refundsValue;
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
				font-family: "Font Awesome 6 Pro";
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
			.order-progress-stepper .step.assembled::before { content: "\f007"; }
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
				<h1>Invoice: <?=(QS)?></h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="mailto:<?=($invoice['Email'])?>;" class="btn btn-outline-primary m-1">
							<i class="fa fa-envelope"></i>
						</a>
						<a href="javascript:orders.printOrder('<?=($invoice['Invoice ID'])?>');" class="btn btn-outline-primary m-1">
							<i class="fa fa-print"></i>
						</a>
						<a href="javascript:orders.refunds.modal('<?=($invoice['Invoice ID'])?>');" class="btn btn-outline-primary m-1">
							<i class="fa fa-fax"></i>
						</a>
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
						<h5>Order date: </h5>
						<p><?=(date('d M Y', strtotime($invoice['Created'])))?></p>
					</div>
					<hr class="d-block d-md-none" style="border-top: dashed 1px #dddddd;"/>
					<div class="col-6 col-md-3 pb-3">
						<h5>Estimated delivery date: </h5>
						<p><?=(date('d M Y', strtotime($invoice['Created'].'+ 7 days')))?></p>
					</div>
					<div class="col-6 col-md-3 pb-3">
						<h5>Shipped:</h5>
						<p></p>
					</div>
					<div class="col-6 col-md-3 pb-3">
						<h5>Shipped by: </h5>
						<p><?=($invoice['Shipping by'])?></p>
					</div>
				</div>
				<div class="col-12 order-progress-stepper">
					<?
						/**/if($invoice['Shipping status']==0):
							$s1 = 'active';
							$t1 = '<a href="javascript:orders.confirmStatus(1, \''.$invoice['Invoice ID'].'\');">Mark as confirmed</a>';
							$t2 = '<a href="javascript:orders.confirmStatus(2, \''.$invoice['Invoice ID'].'\');">Mark as assembled</a>';
							$t3 = '<a href="javascript:orders.confirmStatus(3, \''.$invoice['Invoice ID'].'\');">Mark as out for delivery</a>';
							$t4 = '<a href="javascript:orders.confirmStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
						elseif($invoice['Shipping status']==1):
							$s1 = 'completed';
							$t1 = 'Confirmed';
							$s2 = 'active';
							$t2 = '<a href="javascript:orders.confirmStatus(2, \''.$invoice['Invoice ID'].'\');">Mark as assembled</a>';
							$t3 = '<a href="javascript:orders.confirmStatus(3, \''.$invoice['Invoice ID'].'\');">Mark as out for delivery</a>';
							$t4 = '<a href="javascript:orders.confirmStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
						elseif($invoice['Shipping status']==2):
							$s1 = $s2 = 'completed';
							$t1 = 'Confirmed';
							$t2 = 'Assembled';
							$s3 = 'active';
							$t3 = '<a href="javascript:orders.confirmStatus(3, \''.$invoice['Invoice ID'].'\');">Mark as out for delivery</a>';
							$t4 = '<a href="javascript:orders.confirmStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
						elseif($invoice['Shipping status']==3):
							$s1 = $s2 = $s3 = 'completed';
							$t1 = 'Confirmed';
							$t2 = 'Assembled';
							$t3 = 'Dispatched';
							$s4 = 'active';
							$t4 = '<a href="javascript:orders.confirmStatus(4, \''.$invoice['Invoice ID'].'\');">Mark as delivered</a>';
						elseif($invoice['Shipping status']==4):
							$s1 = $s2 = $s3 = $s4 = 'completed';
							$t1 = 'Confirmed';
							$t2 = 'Assembled';
							$t3 = 'Dispatched';
							$t4 = 'Delivered';
						endif;
						print("
							<div class=\"step $s1 confirmed\">$t1</div>
							<div class=\"step $s2 assembled\">$t2</div>
							<div class=\"step $s3 dispatched\">$t3</div>
							<div class=\"step $s4 delivered\">$t4</div>
						");
					?>
				</div>
			</div>

			<div class="col-12">
				<h5>Taxonomy</h5>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Subtotal'])?>" disabled>
						<label for="floatingInput">Goods price</label>
					</div>
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Deposit'])?>" disabled>
						<label for="floatingInput">Total paid</label>
					</div>
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Processing fees'])?>" disabled>
						<label for="floatingInput">Processing Fees</label>
					</div>
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Tax'])?>" disabled>
						<label for="floatingInput">Tax</label>
					</div>
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<a class="form-control disabled" id="floatingInput"value="<? print($refundsValue)?>" onclick="orders.displayRefunds()" disabled><? print($refundsValue)?></a>
						<label for="floatingInput">Refunds</label>
					</div>
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="<? print($incomeAfterRefunds)?>" disabled>
						<label for="floatingInput">Income</label>
					</div>
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Subtotal'] - $invoice['Deposit'])?>" disabled>
						<label for="floatingInput">Balance</label>
					</div>
				</div>
			</div>

			<div class="col-12">
				<h5>Stripe</h5>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
						<a name="charge_id" class="form-control border-0" id="floatingInput" href="/Transactions/View/<? print($invoice['Transaction ID'])?>"><?=$invoice['Transaction ID']?></a>
						<label for="floatingInput">Transaction ID</label>
					</div>
				</div>
			</div>

			<div class="col-12">
				<h5>Delivery</h5>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-4 form-floating mb-3">
						<textarea type="text" class="form-control" id="floatingInput" style="height:10rem; resize:none;" disabled><? print($address['number_name'].' '.$address['line_1'].','.PHP_EOL.$address['line_2'].','.PHP_EOL.$address['town'].','.PHP_EOL.$address['county'].','.PHP_EOL.$address['country'].','.PHP_EOL.$address['postcode'])?></textarea>
						<label for="floatingInput">Delivery address</label>
					</div>
					<div class="col-8">
						<div class="row">
							<div class="col-12 col-md-6 col-lg-6 form-floating mb-3">
								<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Name'])?>" disabled>
								<label for="floatingInput">Deliver to name</label>
							</div>
							<div class="col-12 col-md-6 col-lg-6 form-floating mb-3">
								<input type="text" class="form-control" id="floatingInput" value="<? print($delivery['Name'])?>" disabled>
								<label for="floatingInput">Delivery by</label>
							</div>
							
							<div class="col-12 col-md-6 col-lg-6 form-floating mb-3">
								<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Email'])?>" disabled>
								<label for="floatingInput">Customer email</label>
							</div>
							<div class="col-12 col-md-6 col-lg-6 form-floating mb-3">
								<input type="text" class="form-control" id="floatingInput" value="<? print($invoice['Phone'])?>" disabled>
								<label for="floatingInput">Customer phone</label>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<h5>Notes</h5>
				<div class="row">
					<div class="col-12 col-md-6 form-floating mb-3">
						<textarea type="text" class="form-control" id="floatingInput" style="resize:none;" disabled><? print($invoice['Notes'])?></textarea>
						<label for="floatingInput">Order notes</label>
					</div>
				</div>
			</div>

			<div class="col-12">
				<h5>Items</h5>
				<div class="row">
					<?
						$invoiced_items = explode(";", $invoice['Items']);
						if($invoiced_items != null) {
							$invoiced_items_count = count($invoiced_items);
							for($i=0;$i<$invoiced_items_count;$i++) {
								$invoiced_item = $invoiced_items[$i];
								list($invoiced_item_sku,
									$invoiced_item_qty,
									$invoiced_item_opt) = explode(",", $invoiced_item);
								if($q = DB_Query("SELECT * FROM `Product` WHERE `SKU`=$invoiced_item_sku AND `Active`=1 LIMIT 1")) {
									while($res = mysqli_fetch_array($q)) {
										$currency = $res['Currency'];
										$fmt = new NumberFormatter( locale_get_default()."@currency=$currency", NumberFormatter::CURRENCY );
										$invoiced_item_curr = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
										$invoiced_item_image = explode(',', $res['Images'])[0];
										$invoiced_item_title = $res['Title'];
										$invoiced_item_price = $res['RetailPrice'];
										$invoiced_item_total = $invoiced_item_price * $invoiced_item_qty;
										$cart_total = $cart_total + $invoiced_item_total;


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
									print('
										<cart-item raw="'.$invoiced_item_sku.','.$invoiced_item_qty.','.$invoiced_item_opt.'" prod-id="'.$invoiced_item_sku.'" prod-qty="'.$invoiced_item_qty.'" prod-opt="'.$invoiced_item_opt.'">
											<div class="row border-bottom m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5">
												<div class="row col-12 col-lg-9 pb-2 pb-lg-0">
													<div class="mw-25 mw-md-10 col-3 pe-3 / col-md-3 pe-md-3">
														<picture>
															<source srcset="'.__API__.'/Images/fetch/'. $invoiced_item_image .'/jpeg/" type="image/jpeg"/>
															<source srcset="'.__API__.'/Images/fetch/'. $invoiced_item_image .'/jpg/" type="image/jpg"/>
															<source srcset="'.__API__.'/Images/fetch/'. $invoiced_item_image .'/png/" type="image/png"/>
															<source srcset="'.__API__.'/Images/fetch/'. $invoiced_item_image .'/jpx/" type="image/jpx"/>
															<img src="'.__API__.'/Images/fetch/'. $invoiced_item_image .'/webp/" type="image/webp" width="100%" height="auto">
														</picture>
													</div>
													<div class="col-9 col-md-8 align-items-center">
														<div class="top-50 position-relative" style="transform:translatey(-50%);">
															<p>
																<a href="'.URL_ADMIN.'/Products/Method/'.$invoiced_item_sku.'">
																	'.$invoiced_item_title.'
																</a>
																<span class="font-monospace text-muted">');
																	for($n=0; $n<count($titles);$n++) {
																		$item_options = explode(':', $invoiced_item[2]);
																		print($titles[$n].': '.$options[$n][$item_options[$n]-1].'&nbsp;&nbsp;&nbsp;');
																	}
																print('
																</span>
															</p>
														</div>
													</div>
												</div>
												<div class="row col-12 col-lg-3 align-items-center">
													<div class="col-12 col-lg-6">
														<div class="form-floating">
															<input class="text-center form-control border-0 bg-transparent" id="floatingTextarea" value="'.$invoiced_item_qty.'" disabled>
															<label for="floatingTextarea">Quantity</label>
														</div>
													</div>
													<div class="col-12 col-lg-6">
														<div class="form-floating">
															<input class="text-center form-control border-0 bg-transparent" id="floatingTextarea" value="'.$invoiced_item_curr.$invoiced_item_total.'" disabled>
															<label for="floatingTextarea">Value</label>
														</div>
													</div>
												</div>
											</div>
										</cart-item>
									');
								}
							}
						} else {
							print('
								<div class="border-bottom row p-3">
									<div class="col-12 p-3 text-center">
										<span> There were no products on this invoice </span>
									</div>
								</div>
							');
						}
						print("
							<div class=\"row m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5\">
								<div class=\"pb-3 offset-0 col-12 / offset-md-9 col-md-2\">
									<div class=\"row\">
										<div class=\"col-6 text-center\">
											<h4>Subtotal</h4>
										</div>
										<div class=\"col-6 text-center\">
											<p class=\"h4\">$cart_item_curr$cart_total</p>
										</div>
									</div>
								</div>
							</div>
						");
					?>
				</div>
			</div>
		</div>
	</section>
	<div class="modal" tabindex="-1" id="refundModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Refund order</h5>
				</div>
				<div class="modal-body">
					<p>How much would you like to refund to the customer?</p>
					<div class="row">
						<div class="col-6">
							<div class="form-floating mb-3 input-group">
								<span class="input-group-text" id="">£</span>
								<input type="number" class="form-control" id="floatingInput" value="0" min="0" max="<?=($depositAfterRefunds)?>" step=".01" name="refundCurrValue" onKeyUp="orders.refunds.check();">
								<label for="floatingInput" class="ps-5">Value</label>
							</div>
						</div>
						<div class="col-6">
							<div class="form-floating mb-3 input-group">
								<span class="input-group-text" id="">£</span>
								<input type="number" class="form-control" id="floatingInput" value="<?=($depositAfterRefunds)?>" step=".01" name="refundMaxValue" disabled>
								<label for="floatingInput" class="ps-5">Max</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onClick="orders.refunds.confirm();">Refund</button>
					<button type="button" class="btn btn-secondary" onClick="$('#refundModal').modal('hide');">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" id="refundConfirmModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Refund order</h5>
				</div>
				<div class="modal-body">
					<p>
						Are you sure you would like to make this refund?
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" onClick="jsvsdcript:orders.refunds.commit();">Confirm.</button>
					<button type="button" class="btn btn-secondary" onClick="javascript:$('#refundconfirmModal').modal('hide');">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" id="allRefundModal">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Order refunds</h5>
				</div>
				<div class="modal-body">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Subtotal</th>
								<th scope="col">Refund ID</th>
								<th scope="col">Status</th>
								<th scope="col">Created</th>
							</tr>
						</thead>
						<tbody>
							<?
								if(mysqli_num_rows($refunds) > 0) {
									foreach($refunds as $row) {
										print(
											sprintf(
												'<tr>
													<th scope="row">%s</th>
													<td class="text-danger">-%s</td>
													<td>%s</td>
													<td>%s</td>
													<td>%s</td>
												</tr>',
												$row['Transaction ID'],
												number_format($row['Subtotal'], 2),
												$row['Refund ID'],
												$row['Status'],
												$row['Created']
											)
										);
									}
								}
							?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" onClick="javascript:$('#allRefundModal').modal('hide');">Close</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" tabindex="-1" id="orderStatusChangeModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Change status?</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to change the status of this order?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning confirmStausChange" onClick="">Confirm changes</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
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