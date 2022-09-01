<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Keys</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<?  if($userperm['api_access-keys-edit']==1) {?>
						<a href="/API/Key/New/" class="btn btn-outline-primary m-1">
							<i class="fa fa-plus"></i>
						</a>
					<?}?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<table class="keysTable table table-striped table-hover m-0">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Key</th>
					<th scope="col">Last used</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					$query = DB_Query("SELECT LEFT(`Key` , 30) as 'Key1', RIGHT(`Key` , 15) as 'Key2', `Last used` FROM `API Keys` WHERE `Active?`=1 LIMIT 4");
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							print('
								<tr>
									<td>'.$row['Key1'].' . . . '.$row['Key2'].'</td>
									<td>'.$row['Last used'].'</td>
									<td>
							');
							if($userperm['api_access-keys-edit']==1) {
								print('
										<a href="/API/key/'.$row['ID'].'">
											<i class="fa fa-pencil"></i>
										</a>
								');
							}
							print('
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
							</tr>
						');
					}
				?>
			</tbody>
		</table>
	</div>
</section>