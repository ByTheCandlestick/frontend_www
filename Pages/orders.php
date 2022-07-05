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
					<th scope="col">Paid</th>
					<th scope="col">txn ID</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `sales_orders` ORDER BY `invoice_number` DESC");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<th scope="row"><a href="/Orders/View/'.$row['invoice_number'].'">'.$row['invoice_number'].'</a></th>
									<td>'.$row['invoice_date'].'</td>
									<td>'.$row['invoice_subtotal'].'</td>
									<td>'.$row['invoice_tax'].'</td>
									<td>'.$row['invoice_deposit'].'</td>
									<td>'.$row['txn_id'].'</td>
									<td>
										<a href="/Orders/Edit/'.$row['invoice_number'].'">
											<i class="fa fa-pencil"></i>
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
							</tr>
						');
					}
				?>
			</tbody>
		</table>
	</div>
</section>