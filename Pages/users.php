<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-4">
			<h1>Products</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-8 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<table class="table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section);">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Email</th>
					<th scope="col">Username</th>
					<th scope="col">First Name / Last Name</th>
					<th scope="col"></th>
					<th scope="col">Enabled</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Users`");
					while ($row = mysqli_fetch_array($query)) {
						print('
							<tr>
								<th scope="row">'.$row['ID'].'</th>
								<td>'.$row['Email'].'</td>
								<td>'.$row['Username'].'</td>
								<td>'.$row['First_name'].' '.$row['Last_name'].'</td>
								<td>'.$row[''].'</td>
								<td>'.$row['Active'].'</td>
								<td>
									<a href="/User/View/'.$row['SKU'].'">
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