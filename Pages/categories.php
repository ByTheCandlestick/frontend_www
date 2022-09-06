<?
    $categories = array();
	$categories_per_page = 100;
?><?
	$total_categories = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Product categories`"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$categories_per_page :0;
    $q = DB_Query("SELECT * FROM `Product categories` ORDER BY `ID` ASC LIMIT $categories_per_page OFFSET $offset");
	while($category = mysqli_fetch_assoc($q)) { array_push($categories, $category); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Product Categories</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($categories)): count($categories);?>/<?=$total_categories?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Categories/New/" class="btn btn-outline-primary m-1">
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
	<div class="row overflow-scroll">
		<table class="categoriesTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Enabled</th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($categories) > 0) {
						foreach($categories as $x) {
							$editable = ($userperm['adm_access-categories-edit']==1)?'<a href="/Category/Edit/'.$x['ID'].'">'.$x['Name'].'</a>':$x['Name'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$x['Active'].'</td>
								</tr>
							');
						}
					} else {
						print('
							<tr>
								<th scope="row"></th>
								<td>No data found</td>
								<td></td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		<?
			(intval(QS_SUBPAGE) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Categories/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $categories_per_page) < $total_categories)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Categories/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
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
			$(".categoriesTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>