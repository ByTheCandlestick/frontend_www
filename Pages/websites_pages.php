<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Pages</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
			<input type="text" class="tableFilter"> </input>
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
			$(".productsTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>