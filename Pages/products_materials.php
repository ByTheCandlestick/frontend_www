<?
	$materials = array();
?><?
	$q = DB_Query("SELECT * FROM `Suppliers` WHERE `Active`=1");
	while($row = mysqli_fetch_array($q)) { $suppliers[$row['Reference']] = $row; }
	$total_materials = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Product materials`"))[0];
	$offset = (QS !== null)?(intval(QS)-1)*$config['Maximum list size'] :0;
    $q = DB_Query($prnt = "SELECT * FROM `Product materials` ORDER BY `ID` ASC LIMIT $config['Maximum list size'] OFFSET $offset");
	while($material = mysqli_fetch_assoc($q)) { array_push($materials, $material); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Materials</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($materials)): count($materials);?>/<?=$total_materials?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Products/Material/New/" class="btn btn-outline-primary m-1">
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
		<table class="materialTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Supplier</th>
					<th scope="col">Suppplier Ref</th>
					<th scope="col">Size (cl)</th>
					<th scope="col">Price (cl)</th>
					<th scope="col">Price (ea)</th>
					<th scope="col">Active</th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($materials) > 0) {
						foreach($materials as $x) {
							$editable = ($userperm['adm_access-products-materials-edit']==1)?'<a href="/Products/Material/'.$x['ID'].'">'.$x['Name'].'</a>':$x['Name'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td><a href="javascript:modal.simple();">'.$suppliers[$x['Supplier']]['Name'].'<a></td>
									<td><a href="javascript:misc.copyToClipboard(\''.$x['ItemRef'].'\');alert.simple(\'Copied. Please search for this item in the new tab\', \'info\');setTimeout(function(){misc.openInNewTab(\''.$suppliers[$x['Supplier']]['Website'].'\');},1500);">'.$x['ItemRef'].'</a></td>
									<td>'.$x['Size (cl)'].'</td>
									<td>£'.$x['Price (cl)'].'</td>
									<td>£'.$x['Price (pack)'].'</td>
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
			($prev_status == '')? $prev_page = "/Materials/".(intval(QS) - 1).'/' : $prev_page = "";
			(($offset + $config['Maximum list size']) < $total_materials)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Materials/".(intval(QS) + 1).'/' : $next_page = "";
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
			$(".materialTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>