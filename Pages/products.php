<?
	$q = DB_Query("SELECT * FROM `products_categories` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $categories[$row['ID']] = $row['Name']; }
	$q = DB_Query("SELECT * FROM `products_collections` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $collections[$row['ID']] = $row['Name']; }

	$products = array();
	$products_per_page = 100;
	$total_products = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `products` ORDER BY `SKU` DESC"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$products_per_page :0;
    $q = DB_Query("SELECT * FROM `products` ORDER BY `SKU` DESC LIMIT $products_per_page OFFSET $offset");
	while($product = mysqli_fetch_assoc($q)) { array_push($products, $product); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Products</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($products)): count($products);?>/<?=$total_products?> Rows</p>
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
					if(count($products) > 0) {
						foreach($products as $x) {
							$editable = ($userperm['adm_access-products-edit']==1)?'<a href="/Products/Edit/'.$x['SKU'].'">'.$x['SKU'].'</a>':$x['SKU'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$x['Title'].'</td>
									<td>'.$categories[$x['Category_ID']].'</td>
									<td>'.$collections[$x['Collection_ID']].'</td>
									<td>'.$x['RetailPrice'].'</td>
									<td>'.$x['Slug'].'</td>
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
		<?
			(intval(QS_SUBPAGE) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Products/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $products_per_page) < $total_products)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Products/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
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
			$(".productsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>