<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Websites</h1>
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
	<div class="row">
		<table class="productsTable table table-striped table-hover">
			<thead class="sticky-top">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Domain</th>
					<th scope="col">Maintenance</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `misc_websites`");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<th scope="row">'.$row['ID'].'</th>
									<td>'.$row['Name'].'</td>
									<td>'.$row['Domain'].'</td>
									<td>'.$row['Maintenance'].'</td>
									<td>
										<a href="/Websites/Edit/'.$row['ID'].'">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="/Websites/Pages/'.$row['ID'].'">
											<i class="fa fa-ellipsis-h"></i>
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
	</div>
</section>