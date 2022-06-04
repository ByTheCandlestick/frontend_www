<?
	print_r($products = mysqli_fetch_assoc(DB_Query("SELECT * FROM `products`")));
?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">SKU</th>
			<th scope="col">Name</th>
			<th scope="col">Category</th>
			<th scope="col">Range</th>
			<th scope="col">Price</th>
			<th scope="col">Slug</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">1</th>
			<td>Mark</td>
			<td>Otto</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<th scope="row">2</th>
			<td>Jacob</td>
			<td>Thornton</td>
			<td>@fat</td>
		</tr>
		<tr>
			<th scope="row">3</th>
			<td colspan="2">Larry the Bird</td>
			<td>@twitter</td>
		</tr>
	</tbody>
</table>