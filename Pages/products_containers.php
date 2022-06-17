<?
	$q = DB_Query("SELECT * FROM `suppliers` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $suppliers[$row['Reference']] = $row; }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Containers</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Products/Container/New/" class="btn btn-outline-primary m-1">
						<i class="fa fa-plus"></i>
					</a>
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
		<table class="productsTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Type</th>
					<th scope="col">Supplier</th>
					<th scope="col">Suppplier Ref</th>
					<th scope="col">Size (cl)</th>
					<th scope="col">Price (ea)</th>
					<th scope="col">Active</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `products_containers`");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<th scope="row">'.$row['ID'].'</th>
									<td>'.$row['Name'].'</td>
									<td>'.$row['Type'].'</td>
									<td><a href="javascript:modal.simple();">'.$suppliers[$row['Supplier']]['Name'].'<a></td>
									<td><a href="javascript:misc.copyToClipboard(\"'.$row['ItemRef'].'\");misc.openInBackground("'.$suppliers[$row['Supplier']]['Website'].'");alert.simple("Copied. Please search for this item in the new tab", "info");">'.$row['ItemRef'].'</a></td>
									<td>'.$row['Size (cl)'].'</td>
									<td>'.$row['Price (ea)'].'</td>
									<td>'.$row['Active'].'</td>
									<td>
										<a href="/Products/Container/'.$row['ID'].'">
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
			$(".productsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>