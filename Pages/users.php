<?
    $users = array();
	$users_per_page = 100;
	$total_users = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Users`"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$users_per_page :0;
    $q = DB_Query("SELECT * FROM `Users` ORDER BY `ID` DESC LIMIT $users_per_page OFFSET $offset");
	while($user = mysqli_fetch_assoc($q)) { array_push($users, $user); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Users</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($users)): count($users);?>/<?=$total_users?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
					<a href="/Config/Permissions/" class="btn btn-outline-warning m-1">
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
					if(count($users) > 0) {
						foreach($users as $x) {
							$editable = ($userperm['adm_access-users-edit']==1)?'<a href="/Users/Edit/'.$x['ID'].'">'.$x['First_name'].' '.$x['Last_name'].'</a>':$x['First_name'].' '.$x['last_name'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$x['Username'].'</td>
									<td>'.$x['Email'].'</td>
									<td>'.$x['Phone'].'</td>
									<td>'.$x['Active'].'</td>
									<td>'.$x['Created'].'</td>
									<td>
										<a href="/Users/Cart/'.$x['ID'].'">
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
		<?
			(intval(QS_SUBPAGE) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Users/".(intval(QS_SUBPAGE) - 1).'/' : $prev_page = "";
			(($offset + $users_per_page) < $total_users)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Users/".(intval(QS_SUBPAGE) + 1).'/' : $next_page = "";
			// Previous/Next page button
			print("
				<div class=\"row\">
					<div class=\"col-12 col-md-4 offset-md-4 d-flex\">
						<a class=\"col-4 offset-1 col-md-5 offset-md-0 mt-2 mb-3 d-block btn btn-secondary$prev_status\" href=\"$prev_page\" role=\"button\">Previous</a>
						<a class=\"col-4 offset-2 col-md-5 offset-md-2 mt-2 mb-3 d-block btn btn-secondary$next_status\" href=\"$next_page\" role=\"button\">Next</a>
					</div>
				</div>
			");
		?>
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