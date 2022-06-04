<?
	$products = mysqli_fetch_array(DB_Query("SELECT `SKU`,`Title`,`Category_ID`,`Range_ID`,`RetailPrice`,`Slug` FROM `products`"));
?>
<table class="table table-striped table-hover">
	<thead>
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
			foreach($products as $product) {
				print('
					<tr>
						<th scope="row">'.$product[0].'</th>
						<td>'.$product[1].'</td>
						<td>'.$product[2].'</td>
						<td>'.$product[3].'</td>
						<td>'.$product[4].'</td>
						<td>'.$product[5].'</td>
						<td>EDIT</td>
					</tr>
				');
			}
		?>
	</tbody>
</table>