<?
    $partners = array();
	$partners_per_page = 100;
?><?
	$total_partners = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Partner accounts`"))[0];
	$offset = (QS_SUBPAGE !== null)? (intval(QS_SUBPAGE)-1)*$partners_per_page: 0;
    $q = DB_Query($prnt = "SELECT * FROM `Partner accounts` ORDER BY `Reference` ASC LIMIT $partners_per_page OFFSET $offset");
	while($partner = mysqli_fetch_assoc($q)) { array_push($partners, $partner); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>All partners</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($partners)): count($partners);?>/<?=$total_partners?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Partners/New/" class="btn btn-outline-primary m-1">
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
		<table class="partnersTable table table-striped table-hover">
			<thead class="sticky-top">
				<th scope="col">Name</th>
				<th scope="col">Reference</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
				<th scope="col">Enabled</th>
				<th scope="col">Created</th>
			</thead>
			<tbody>
				<?
					if(count($partners) > 0) {
						foreach($partners as $x) {
							$editable = ($userperm['adm_access-partners-edit']==1)?'<a href="/Partners/Edit/'.$x['ID'].'">'.$x['Name'].'</a>':$x['Name'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$x['Reference'].'</td>
									<td><a href="/Mail/New/?to='.$x['Email'].'">'.$x['Email'].'</a></td>
									<td><a href="tel:'.$x['Phone'].'">'.$x['Phone'].'</a></td>
									<td>'.$x['Active'].'</td>
									<td>'.$x['Created'].'</td>
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
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		<?
			(intval(QS_SUBPAGE) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Partners/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $partners_per_page) < $partners)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Partners/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
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
			$(".partnersTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>