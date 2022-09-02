<?
    $keys = array();
	$keys_per_page = 100;
?><?
	$total_keys = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `API Keys`"))[0];
	$offset = (QS !== null)? (intval(QS)-1)*$keys_per_page: 0;
    $q = DB_Query($p = "SELECT * FROM `API Keys` ORDER BY `ID` DESC LIMIT $keys_per_page OFFSET $offset");
	print($p);
	while($key = mysqli_fetch_assoc($q)) { array_push($keys, $key); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Keys</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($keys)): count($keys);?>/<?=$total_keys?> Rows</p>
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
					if(count($keys) > 0) {
						foreach($keys as $x) {
							$editable = ($userperm['api_access-keys-edit']==1)?'<a href="/API/Key/'.$x['ID'].'">'.substr($row['Key'], 0, 10).' . . . '.substr($row['Key'], 0, 10).'</a>':$row['Key1'].' . . . '.$row['Key2'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.''.'</td>
									<td>'.$row['Last used'].'</td>
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
		<?
			(intval(QS) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Keys/".(intval(QS) - 1).'/' : $prev_page = "";
			(($offset + $keys_per_page) < $total_keys)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Keys/".(intval(QS) + 1).'/' : $next_page = "";
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