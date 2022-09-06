<?
	$colours = array();
	$colours_per_page = 100;
?><?
	$q = DB_Query("SELECT * FROM `Suppliers` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $suppliers[$row['Reference']] = $row; }
	$total_colours = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Product colours`"))[0];
	$offset = (QS !== null)?(intval(QS)-1)*$colours_per_page :0;
    $q = DB_Query($prnt = "SELECT * FROM `Product colours` ORDER BY `ID` ASC LIMIT $colours_per_page OFFSET $offset");
	while($colour = mysqli_fetch_assoc($q)) { array_push($colours, $colour); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Colours</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($colours)): count($colours);?>/<?=$total_colours?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Products/Colour/New/" class="btn btn-outline-primary m-1">
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
		<table class="colourTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Supplier</th>
					<th scope="col">Suppplier Ref</th>
					<th scope="col">Size (g)</th>
					<th scope="col">Price (cl)</th>
					<th scope="col">Price (ea)</th>
					<th scope="col">Active</th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($colours) > 0) {
						foreach($colours as $x) {
							$editable = ($userperm['adm_access-products-colours-edit']==1)?'<a href="/Products/Colour/'.$x['ID'].'">'.$x['Name'].'</a>':$x['Name'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td><a href="javascript:modal.simple();">'.$suppliers[$x['Supplier']]['Name'].'<a></td>
									<td><a href="javascript:misc.copyToClipboard(\''.$x['ItemRef'].'\');alert.simple(\'Copied. Please search for this item in the new tab\', \'info\');setTimeout(function(){misc.openInNewTab(\''.$suppliers[$x['Supplier']]['Website'].'\');},1500);">'.$x['ItemRef'].'</a></td>
									<td>'.$x['Grams_pack'].'</td>
									<td>'.$x['Price_cl'].'</td>
									<td>'.$x['Price_pack'].'</td>
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
								<td></td>
								<td></td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		<?
			(intval(QS) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Colours/".(intval(QS) - 1).'/' : $prev_page = "";
			(($offset + $colours_per_page) < $total_colours)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Colours/".(intval(QS) + 1).'/' : $next_page = "";
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
			$(".colourTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>