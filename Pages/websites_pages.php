<?
	$page = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `Website domains` WHERE `ID`=%s", QS)));
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Pages</h1>
			<h3>url: <?print($page['Domain'])?></h3>
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
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">URL</th>
					<th scope="col">Sub URL</th>
					<th scope="col">Menu order</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query(sprintf("SELECT * FROM `Website pages` WHERE `domain_id`=%s ORDER BY `menu_order` DESC, `ID` ASC", QS));
					while($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['page_name'].'</td>
								<td>'.$row['page_url'].'</td>
								<td>'.$row['subpage_url'].'</td>
								<td>'.(($row['menu_order']==null)?'0':$row['menu_order']).'</td>
								<td>
									<a href="/Oxygen/'.$row['ID'].'/" class="px-1">
										<i class="fad fa-circle"></i>
									</a>
									<a href="/Websites/Page/'.$row['ID'].'" class="px-1">
										<i class="fa fa-pencil"></i>
									</a>
								</td>
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
			$(".pagesTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>