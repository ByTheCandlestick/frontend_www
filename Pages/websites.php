<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Websites</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
			<div class="row">
				<div class="col d-flex justify-content-end align-items-center">
					<a href="/Websites/styles/" class="btn btn-outline-primary">
						<i class="fab fa-css3-alt"></i>
					</a>
					<a href="/Websites/scripts/" class="btn btn-outline-primary">
						<i class="fa fa-scroll"></i>
					</a>
					<a href="/Websites/New/" class="btn btn-outline-primary">
						<i class="fa fa-plus"></i>
					</a>
				</div>
				<div class="col-8">
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
					<th scope="col">Name</th>
					<th scope="col">Domain</th>
					<th scope="col">Maintenance</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `misc_websites`");
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Name'].'</td>
								<td>'.$row['Domain'].'</td>
								<td>'.$row['Maintenance'].'</td>
								<td>
									<a href="/Website/View/'.$row['ID'].'">
										<i class="fa fa-ellipsis-h"></i>
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