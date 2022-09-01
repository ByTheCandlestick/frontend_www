<?
    $pages = array();
	$pages_per_page = 100;
?><?
	[$domainID, $z] = QS;
	if($z==null) $z=1;
	$website = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Website domains` WHERE `ID`=%s", QS[0])));
	$total_pages = mysqli_fetch_row(DB_Query(sprintf("SELECT COUNT(*) FROM `Website pages` WHERE `domain_id`='%s'", QS[0])))[0];
	$offset = ($z !== null)?(intval($z)-1)*$pages_per_page :0;
    $q = DB_Query($prnt = sprintf("SELECT * FROM `Website pages` WHERE `domain_id`=%s ORDER BY CASE WHEN `menu_order`=0 THEN 99+`ID` ELSE `menu_order` END, `ID` ASC LIMIT %s OFFSET %s", $domainID, $pages_per_page, $offset));
	print($prnt);
	while($page = mysqli_fetch_assoc($q)) { array_push($pages, $page); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Pages: <?print($website['Name'])?></h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($pages)): count($pages);?>/<?=$total_pages?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Websites/Page/New/" class="btn btn-outline-primary m-1">
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
		<table class="pagesTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">URL</th>
					<th scope="col">Sub URL</th>
					<th scope="col">Menu order</th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($pages) > 0) {
						foreach($pages as $x) {
							print('
								<tr>
									<th scope="row"><a href="/Websites/Page/'.$x['ID'].'">'.$x['page_name'].'<a/></th>
									<td>'.$x['page_url'].'</td>
									<td>'.$x['subpage_url'].'</td>
									<td>'.(($x['menu_order']=='0')?null:$x['menu_order']).'</td>
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
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		<?
			(intval($z) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Websites/Pages/".QS[0].(intval($z) - 1).'/' : $prev_page = "";
			(($offset + $pages_per_page) < $total_pages)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Websites/Pages/".QS[0].(intval($z) + 1).'/' : $next_page = "";
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
			$(".pagesTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>