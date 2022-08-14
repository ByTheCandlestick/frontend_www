<?
    $transactions = array();
    $q = DB_Query("SELECT * FROM `Transactions` ORDER BY `Modified` DESC LIMIT 50");
	while($transaction = mysqli_fetch_assoc($q)) { array_push($transactions, $transaction); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Transactions</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
				</div>
				<div class="col-12 col-lg-6">
					<div class="form-floating">
						<input type="text" class="form-control tableFilter" id="tableSearch" placeholder="">
						<label for="tableSearch" class="ps-5">Search</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<table class="transactionsTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">#</th>
					<th scope="col">type</th>
					<th scope="col">Status</th>
					<th scope="col">Value</th>
					<th scope="col">Modified</th>
					<th scope="col">Created</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($transactions) > 0) {
						foreach($transactions as $t) {
							print('
								<tr>
									<th scope="row">
										<a onclick="">'.$t['Transaction ID'].'</a>
									</th>
									<td>'.$t['Type'].'</td>
									<td>'.$t['Status'].'</td>
									<td class="text-'.(($t['Type'] == 'Refund')?"danger":($t['Type'] == 'Order')?"sucess":"").'">'.(($t['Type'] == 'Refund')?"-":($t['Type'] == 'Order')?"+":"").number_format($t['Subtotal'], 2).'</td>
									<td>'.$t['Modified'].'</td>
									<td>'.$t['Created'].'</td>
									<td>
										<a href="#">
											<i class="fa fa-external-link-alt"></i>
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
			$(".transactionsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>