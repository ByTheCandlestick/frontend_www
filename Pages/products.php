<div class="">
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-4">
			<h1>Products</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-8 text-md-end">
		</div>
	</div>
	<hr>
	<table class="table table-striped table-hover">
		<thead class="sticky-top" style="background: var(--section);">
			<tr>
				<th scope="col">SKU</th>
				<th scope="col">Title</th>
				<th scope="col">Category</th>
				<th scope="col">Range</th>
				<th scope="col">Price</th>
				<th scope="col">Slug</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?
				$query = DB_Query("SELECT * FROM `products`");
				while ($row = mysqli_fetch_array($query)) {
					print('
						<tr>
							<th scope="row">'.$row['SKU'].'</th>
							<td>'.$row['Title'].'</td>
							<td>'.$row['Category_ID'].'</td>
							<td>'.$row['Range_ID'].'</td>
							<td>'.$row['RetailPrice'].'</td>
							<td>'.$row['Slug'].'</td>
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