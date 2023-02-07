<?
    $orders = array();
?><?
	$total_orders = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order'"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$config['Maximum list size']: 0;
    $q = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `Type`='Order' ORDER BY `Shipping Status` ASC, `Invoice ID` DESC LIMIT %s OFFSET %s", $config['Maximum list size'], $offset));
	while($order = mysqli_fetch_assoc($q)) { array_push($orders, $order); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Orders</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($orders)): count($orders);?>/<?=$total_orders?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
				</div>
				<div class="col-12 col-lg-6">
					<div class="form-floating">
						<input type="text" class="form-control tableFilter" id="tableSearch" placeholder=" ">
						<label for="tableSearch" class="ps-5">Search</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<table class="ordersTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Date</th>
					<th scope="col">Subtotal</th>
					<th scope="col">Tax</th>
					<th scope="col">Deposit</th>
					<th scope="col">Status</th>
					<th scope="col">txn ID</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($orders) > 0) {
						foreach($orders as $x) {
							$editable = ($userperm['adm_access-orders']==1)?'<a href="/Orders/View/'.$x['Invoice ID'].'">'.$x['Invoice ID'].'</a>':$x['Invoice ID'];
							if($x['Shipping status']<1) {
								// To be accepted
								$status = '<i class="text-primary fa-duotone fa-circle-exclamation"></i>';
							} elseif($x['Shipping status']<2) {
								// To be Made
								$status = '<i class="text-warning fa-duotone fa-industry-windows"></i>';
							} elseif($x['Shipping status']<3) {
								// To be Sent to delivery company
								$status = '<i class="text-warning fa-duotone fa-user"></i>';
							} elseif($x['Shipping status']<4) {
								// To be Delivered
								$status = '<i class="text-warning fa-duotone fa-box"></i>';
							} else {
								// Complete and Delivered
								$status = '<i class="text-success fa-solid fa-check"></i>';
							}
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$x['Created'].'</td>
									<td>'.$x['Subtotal'].'</td>
									<td>'.$x['Tax'].'</td>
									<td>'.$x['Deposit'].'</td>
									<td>'.$status.'</td>
									<td>'.$x['Transaction ID'].'</td>
									<td>
										<a href="/Orders/Shipping/'.$x['Invoice ID'].'">
											<i class="fa fa-box-full"></i>
										</a>
										<a href="javascript:orders.printReciept('.$x['Invoice ID'].');">
											<i class="fa fa-print"></i>
										</a>
									</td>
								</tr>
							');
						}
					} else {
						print('
							<tr>
								<th scope="row"></th>
								<td>No data found</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		<?
			(intval(QS_SUBPAGE) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Orders/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $config['Maximum list size']) < $total_orders)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Orders/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
			// Previous/Next page button
			print("
				<div class=\"row\">
					<div class=\"col-12 col-md-4 offset-md-4 d-flex\">
						<a class=\"col-4 offset-1 col-md-5 offset-md-0 mt-2 mb-3 d-block btn btn-secondary$prev_status\" href=\"$prev_page\" role=\"button\">Previous</a>
						<a class=\"col-4 offset-2 col-md-5 offset-md-2 mt-2 mb-3 d-block btn btn-secondary$next_status\" href=\"$next_page\" role=\"button\">Next</a>
					</div>
				</div>
			");
		?>
	</div>
</section>
<script>
	$(document).ready(function(){
		$(".tableFilter").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".ordersTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>