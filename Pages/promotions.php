<?
    $promos = array();
?><?
	$total_promos = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Promotions`"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$config['Maximum list size'] :0;
    $q = DB_Query("SELECT * FROM `Promotions` ORDER BY `ID` DESC LIMIT $config['Maximum list size'] OFFSET $offset");
	while($promo = mysqli_fetch_assoc($q)) { array_push($promos, $promo); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Promotions</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($promos)): count($promos);?>/<?=$total_promos?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Promotions/New/" class="btn btn-outline-primary m-1">
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
		<table class="promosTable table table-striped table-hover">
			<thead class="sticky-top">
				<th scope="col">Name</th>
				<th scope="col">Description</th>
				<th scope="col">Percentage</th>
				<th scope="col">Start</th>
				<th scope="col">End</th>
				<th scope="col">Live</th>
				<th scope="col"></th>
			</thead>
			<tbody>
				<?
					if(count($promos) > 0) {
						foreach($promos as $x) {
							$active = (date("Y-m-d") > $x['Scheduled start'] && date("Y-m-d") < $x['Scheduled end'])? '<i style="color: green;" class="fa-duotone fa-check"></i>' : '<i style="color: red;" class="fa-duotone fa-xmark"></i>' ;
							$editable = ($userperm['adm_access-promotion-edit']==1)?'<a href="/Promotions/Edit/'.$x['ID'].'"><i class="fad fa-pencil"></i></a>':$x['Name'];
							print('
								<tr>
									<th scope="row">
										<a href="/Promotions/View/'.$x['ID'].'">'.$x['Name'].'</a>
									</th>
									<td>'.$x['Description'].'</td>
									<td>'.$x['Percentage discount'].'</td>
									<td>'.$x['Scheduled start'].'</td>
									<td>'.$x['Scheduled end'].'</td>
									<td>'.$active.'</td>
									<td>'.$editable.'</td>
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
			(intval(QS_SUBPAGE) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Promotions/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $config['Maximum list size']) < $total_promos)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Promotions/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
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
			$(".promosTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>