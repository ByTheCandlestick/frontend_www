<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Websites</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<table class="productsTable table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section);">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Domain</th>
					<th scope="col">Maintenance</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `misc_websites`");
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Name'].'</td>
								<td>'.$row['Domain'].'</td>
								<td>'.$row['Maintenance'].'</td>
								<td>
									<a href="/Product/View/'.$row['SKU'].'">
										<i class="fa fa-ellipsis"></i>
									</a>
								</td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
	</div>
</section>