<?
	$products = mysqli_fetch_array(DB_Query("SELECT `SKU`,`Title`,`Category_ID`,`Range_ID`,`RetailPrice`,`Slug` FROM `products`"));
	//print_r($products);
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
				print_r($product.' // ');
/*				print('
					<tr>
						<th scope="row">'.$product['SKU'].'</th>
						<td>'.$product['Title'].'</td>
						<td>'.$product['Category_ID'].'</td>
						<td>'.$product['Range_ID'].'</td>
						<td>'.$product['RetailPrice'].'</td>
						<td>'.$product['Slug'].'</td>
						<td>EDIT</td>
					</tr>
				');
*/			}
		?>
	</tbody>
</table>