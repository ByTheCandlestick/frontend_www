<?
    $transactions = array();
	$page = intval(QS_SUBPAGE);
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*50 :0;
    $q = DB_Query("SELECT * FROM `Transactions` ORDER BY `Modified` DESC LIMIT 50 OFFSET $offset");
	$count = mysqli_fetch_row(DB_Query("SELECT * FROM `Transactions` ORDER BY `Modified` DESC"));
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
							if($t['Type'] == 'Refund') {
								$textCol = "danger";
								$valueDirection = "-";
							} elseif($t['Type'] == 'Order') {
								$textCol = "success";
								$valueDirection = "+";
							} else {
								$textCol = "muted";
								$valueDirection = "±";
							}
							print('
								<tr>
									<th scope="row">
										<a onclick="">'.$t['Transaction ID'].'</a>
									</th>
									<td>'.$t['Type'].'</td>
									<td>'.$t['Status'].'</td>
									<td class="text-'.$textCol.'">'.$valueDirection.number_format($t['Subtotal'], 2).'</td>
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
		<?
			($page > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Transactions/".($page - 1).'/' : $prev_page = "";
			($prd_viewed < $count)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Transactions/".($page + 1).'/' : $next_page = "";
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
			$(".transactionsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>