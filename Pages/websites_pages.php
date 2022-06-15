<?
	$page = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `misc_websites` WHERE `ID`=%s", QS)));
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Pages</h1>
			<p>url: <?print($page['Domain'])?></p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-flex justify-content-end align-items-center p-0">
					<a href="/Website/Page/New/" class="btn btn-outline-primary m-1">
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
	<div class="row">
		<table class="productsTable table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section); z-index: unset;">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">URL</th>
					<th scope="col">Sub URL</th>
					<th scope="col">Page Title</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `domain_id`=%s ORDER BY `id`", QS));
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['page_url'].'</td>
								<td>'.$row['subpage_url'].'</td>
								<td>'.$row['page_title'].'</td>
								<td>
									<a href="/Website/Page/'.$row['ID'].'">
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
			$(".productsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>