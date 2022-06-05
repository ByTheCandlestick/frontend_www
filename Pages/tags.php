<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Product Categories, Collections and Tags</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<table class="table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section);">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Enabled</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Products_categories`");
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Name'].'</td>
								<td>'.$row['Active'].'</td>
								<td>
									<a href="/Product/Category/'.$row['ID'].'">
										<i class="fa fa-ellipsis"></i>
									</a>
								</td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		
		<table class="table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section);">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Username</th>
					<th scope="col">Phone</th>
					<th scope="col">Enabled</th>
					<th scope="col">Created</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Products_collections`");
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Name'].'</td>
								<td>'.$row['Active'].'</td>
								<td>
									<a href="/User/View/'.$row['ID'].'">
										<i class="fa fa-ellipsis"></i>
									</a>
								</td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		
		<table class="table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section);">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Username</th>
					<th scope="col">Phone</th>
					<th scope="col">Enabled</th>
					<th scope="col">Created</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Product_tags`");
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Name'].'</td>
								<td>'.$row['Active'].'</td>
								<td>
									<a href="/User/View/'.$row['ID'].'">
										<i class="fa fa-ellipsis"></i>
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