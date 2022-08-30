<?
	$q = DB_Query("SELECT * FROM `products_categories` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $categories[$row['ID']] = $row['Name']; }
	$q = DB_Query("SELECT * FROM `products_collections` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $collections[$row['ID']] = $row['Name']; }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Products</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<?  if($userperm['adm_access-products-edit']==1) {?>
						<a href="/Products/New/" class="btn btn-outline-primary m-1">
							<i class="fa fa-plus"></i>
						</a>
					<?} if($userperm['adm_access-products-categories']==1) {?>
						<a href="/Categories/" class="btn btn-outline-primary m-1">
							Categories
						</a>
					<?} if($userperm['adm_access-products-collections']==1) {?>
						<a href="/Collections/" class="btn btn-outline-primary m-1">
							Collections
						</a>
					<?} if($userperm['adm_access-products-comodities']==1) {?>
						<a href="/Products/Comodities/" class="btn btn-outline-primary m-1">
							Comodities
						</a>
					<?}?>
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
	<div class="row overflow-scroll">
		<table class="productsTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">SKU</th>
					<th scope="col">Title</th>
					<th scope="col">Category</th>
					<th scope="col">Range</th>
					<th scope="col">Price</th>
					<th scope="col">Slug</th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `products`");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							$editable = ($userperm['adm_access-products-edit']==1)?'<a href="/Products/Edit/'.$row['SKU'].'">'.$row['SKU'].'</a>':$row['SKU'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$row['Title'].'</td>
									<td>'.$categories[$row['Category_ID']].'</td>
									<td>'.$collections[$row['Collection_ID']].'</td>
									<td>'.$row['RetailPrice'].'</td>
									<td>'.$row['Slug'].'</td>
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