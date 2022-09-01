<?
    $websites = array();
	$websites_per_page = 100;
?><?
	$total_websites = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Website domains`"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$websites_per_page :0;
    $q = DB_Query("SELECT * FROM `Website domains` ORDER BY `ID` DESC LIMIT $websites_per_page OFFSET $offset");
	while($website = mysqli_fetch_assoc($q)) { array_push($websites, $website); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Websites</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($websites)): count($websites);?>/<?=$total_websites?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Websites/Themes/" class="btn btn-outline-primary m-1">
						<i class="fa fa-palette"></i>
					</a>
					<a href="/Websites/styles/" class="btn btn-outline-primary m-1">
						<i class="fa fa-book-spells"></i>
					</a>
					<a href="/Websites/scripts/" class="btn btn-outline-primary m-1">
						<i class="fa fa-scroll"></i>
					</a>
					<a href="/Websites/New/" class="btn btn-outline-primary m-1">
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
		<table class="websiteTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Domain</th>
					<th scope="col">Maintenance</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($websites) > 0) {
						foreach($websites as $x) {
							$editable = ($userperm['adm_access-websites-page']==1)?'<a href="/Websites/Pages/'.$x['ID'].'">'.$x['Name'].'</a>':$x['ID'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td><a href="'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')?'https':'http').'://'.$x['Domain'].'" target="_blank">'.$x['Domain'].'</a></td>
									<td>'.$x['Maintenance'].'</td>
									<td>
										<a href="/Websites/Edit/'.$x['ID'].'">
											<i class="fa fa-pencil"></i>
										</a>
									</td>
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
			($prev_status == '')? $prev_page = "/Websites/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $websites_per_page) < $total_websites)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Websites/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
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
			$(".websiteTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>