<?
    $sections = array();
?><?
	$total_sections = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Website sections`"))[0];
	$offset = QS_SUBPAGE!==null ? (intval(QS_SUBPAGE)-1)*$config['Maximum list size'] : 0;
    $q = DB_Query(sprintf("SELECT * FROM `Website sections` ORDER BY `id` ASC LIMIT %s OFFSET %s", $config['Maximum list size'], $offset));
	while($section = mysqli_fetch_assoc($q)) { array_push($sections, $section); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Website sections</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($sections)): count($sections);?>/<?=$total_sections?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
				</div>
				<div class="col-12 col-lg-6">
					<div class="form-floating">
						<input type="text" class="form-control tableFilter" id="tableSearch" placeholder="">
						<label for="tableSearch" class="ps-5">Search</label>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<table class="sectionsTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Type</th>
					<th scope="col">Description</th>
					<th scope="col">File</th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($sections) > 0) {
						foreach($sections as $x) {
							print('
								<tr>
									<th scope="row">'.$x['section_type'].'</td>
									<td>'.$x['short_description'].'</th>
									<td>'.$x['section_url'].'</td>
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
			($prev_status == '')? $prev_page = "/Sections/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $config['Maximum list size']) < $total_sections)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Sections/".((intval(QS_SUBPAGE)>0)?intval(QS_SUBPAGE)+1:intval(QS_SUBPAGE)+2).'/' : $next_page = "";
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
			$(".sectionsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>