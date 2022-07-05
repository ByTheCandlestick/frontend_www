<section class="row container-fluid">
	<header class="row mb-4	">
		<h2 class="col-12">Order history</h2>
	</header>
	<div class="col-12">
		<hr>
		<?
			if($query = DB_Query(sprintf("SELECT * FROM `sales_orders` WHERE `uid`=%d ORDER BY `invoice_number` DESC", $userdata['ID']))) {
				$orderHistory = array();
				while($row = mysqli_fetch_assoc($query)){
					array_push($orderHistory, $row);
				}
				foreach($orderHistory as $invoice) {
					$invoice_date = $invoice['invoice_date'];
					$invoice_number = $invoice['invoice_number'];
					print("
						<div class=\"row border-bottom m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5\">
							<div class=\"row pb-2 pb-md-0\">
								<div class=\"col-9 col-md-8 align-items-center\">
									<div class=\"top-50 position-relative\" style=\"transform:translatey(-50%);\">
										<p>
											<a class=\"link-dark\" href=\"/my/order/$invoice_number\">
												$invoice_number
											</a>
										</p>
										<p class=\"font-monospace text-muted\">
											Order date: $invoice_date
										</p>
									</div>
								</div>
							</div>
						</div>
					");
				}
			}
		?>
	</div>
</section>