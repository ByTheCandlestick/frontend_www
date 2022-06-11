<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Users</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
			<div class="form-floating">
				<input type="text" class="form-control tableFilter" id="tableSearch" placeholder=" ">
				<label for="tableSearch" class="ps-5">Search</label>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<table class="usersTable table table-striped table-hover">
			<thead class="sticky-top" style="background: var(--section); z-index: unset;">
				<th scope="col">ID</th>
				<th scope="col">Name</th>
				<th scope="col">Username</th>
				<th scope="col">Email</th>
				<th scope="col">Phone</th>
				<th scope="col">Enabled</th>
				<th scope="col">Created</th>
				<th scope="col"></th>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT * FROM `Users`");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<th scope="row">'.$row['ID'].'</th>
									<td>'.$row['First_name'].' '.$row['Last_name'].'</td>
									<td>'.$row['Username'].'</td>
									<td>'.$row['Email'].'</td>
									<td>'.$row['Phone'].'</td>
									<td>'.$row['Active'].'</td>
									<td>'.$row['Created'].'</td>
									<td>
										<a href="/User/View/'.$row['ID'].'">
											<i class="fa fa-pencil"></i>
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
			$(".usersTable tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>