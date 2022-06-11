<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>All suppliers</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end d-flex">
			<a href="/Suppliers/New/" class="btn btn-outline-primary">
				<i class="fa fa-plus"></i>
			</a>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<table class="suppliersTable table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section); z-index: unset;">
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Reference</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
				<th scope="col">Enabled</th>
				<th scope="col">Created</th>
				<th scope="col"></th>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `suppliers`");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<th scope="row">'.$row['ID'].'</th>
									<td>'.$row['Name'].'</td>
									<td>'.$row['Reference'].'</td>
									<td>'.$row['Email'].'</td>
									<td>'.$row['Phone'].'</td>
									<td>'.$row['Active'].'</td>
									<td>'.$row['Created'].'</td>
									<td>
										<a href="/Suppliers/Edit/'.$row['ID'].'">
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
			$(".suppliersTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>