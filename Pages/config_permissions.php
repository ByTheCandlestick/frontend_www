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
		<table class="permissionsTable table table-striped table-hover">
			<thead class="sticky-top">
				<th scope="col">Permission</th>
			</thead>
			<tbody>
				<?
					$query = DB_Query("DESCRIBE `Users_permissions`");
					if(mysqli_num_rows($query) > 0) {
                        $id=0;
						while ($row = mysqli_fetch_array($query)) {
							if(preg_match("([a-z]+\_[a-z\-]+)", $row['Field'])) {
                                print('
                                    <tr>
                                        <th scope="row"><a href="/Config/Permissions/'.$id.'/">'.$row['Field'].'</a></th>
                                    </tr>
                                ');
                                $id++
                            }
						}
					} else {
						print('
							<tr>
								<th scope="row">No data found</th>
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
			$(".permissionsTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>