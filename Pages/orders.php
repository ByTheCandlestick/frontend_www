<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Orders</h1>
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
	<div class="row">
		<table class="ordersTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Date</th>
					<th scope="col">Subtotal</th>
					<th scope="col">Tax</th>
					<th scope="col">Deposit</th>
					<th scope="col">Payment status</th>
					<th scope="col">Status</th>
					<th scope="col">txn ID</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Sales - orders` ORDER BY `Invoice ID` DESC");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<th scope="row"><a href="/Orders/View/'.$row['Invoice ID'].'">'.$row['Invoice ID'].'</a></th>
									<td>'.$row['Date'].'</td>
									<td>'.$row['Subtotal'].'</td>
									<td>'.$row['Tax'].'</td>
									<td>'.$row['Deposit'].'</td>
									<td>'.$row['Payment status'].'</td>
									<td>'.$row['Status'].'</td>
									<td>'.$row['Transaction ID'].'</td>
									<td>
										<a href="/Orders/Shipping/'.$row['Invoice ID'].'">
											<i class="fa fa-truck"></i>
										</a>
										<a href="javascript:orders.printReciept('.$row['Invoice ID'].');">
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