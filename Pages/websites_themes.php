<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Themes</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Websites/Theme/New/" class="btn btn-outline-primary m-1">
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
		<table class="themesTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Description</th>
					<th scope="col">Location</th>
					<th scope="col">Active</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query(sprintf("SELECT * FROM `page_types`"));
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Name'].'</td>
								<td>'.$row['Description'].'</td>
								<td>'.$row['Location'].'</td>
								<td>'.$row['Active'].'</td>
								<td>
									<a href="/Websites/Theme/'.$row['ID'].'">
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
			$(".themesTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>