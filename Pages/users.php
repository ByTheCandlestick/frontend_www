<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Users</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Users/Perms/" class="btn btn-outline-warning m-1">
						<i class="fa fa-key"></i>
					</a>
					<a href="/Users/New/" class="btn btn-outline-primary m-1">
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
		<table class="usersTable table table-striped table-hover">
			<thead class="sticky-top">
				<th scope="col">Name</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
				<th scope="col">Enabled</th>
				<th scope="col">Created</th>
				<th scope="col">Cart</th>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Users`");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<td><a href="/Users/Edit/'.$row['ID'].'">'.$row['First_name'].' '.$row['Last_name'].'</a></td>
									<td>'.$row['Username'].'</td>
									<td>'.$row['Email'].'</td>
									<td>'.$row['Phone'].'</td>
									<td>'.$row['Active'].'</td>
									<td>'.$row['Created'].'</td>
									<td>
										<a href="/Users/Cart/'.$row['ID'].'">
											<i class="fa fa-shopping-cart"></i>
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
<script>
	$(document).ready(function(){
		$(".tableFilter").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".usersTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>