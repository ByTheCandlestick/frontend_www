<?
    $hosts = array();
?><?
	$total_hosts = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `API Allowed hosts` WHERE `Active?`='1'"))[0];
	$offset = (QS !== null)? (intval(QS)-1)*$config['Maximum list size']: 0;
    $q = DB_Query(sprintf("SELECT * FROM `API Allowed hosts` WHERE `Active?`='1' ORDER BY `ID` DESC LIMIT %s OFFSET %s", $config['Maximum list size'], $offset));
	while($host = mysqli_fetch_assoc($q)) { array_push($hosts, $host); }
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Hosts</h1>
			<p>Displaying: <?=($offset > 1)? ($offset + 1).'-'.($offset + count($hosts)): count($hosts);?>/<?=$total_hosts?> Rows</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<?  if($userperm['api_access-hosts-edit']==1) {?>
						<a href="/API/Hosts/New/" class="btn btn-outline-primary m-1">
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
		<table class="hostsTable table table-striped table-hover m-0">
			<thead class="sticky-top">
				<tr>
					<th scope="col">Name</th>
					<th scope="col">Hostname</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<?
					if(count($hosts) > 0) {
						foreach($hosts as $x) {
							$editable = ($userperm['api_access-hosts-edit']==1)?'<a href="/API/Host/'.$x['ID'].'">'.$x['Name'].'</a>':$x['Name'];
							print('
								<tr>
									<th scope="row">'.$editable.'</th>
									<td>'.$x['Hostname'].'</td>
								</tr>
							');
						}
					} else {
						print('
							<tr>
								<th scope="row"></th>
								<td>No data found</td>
							</tr>
						');
					}
				?>
			</tbody>
		</table>
		<?
			(intval(QS) > 1)? $prev_status = '': $prev_status = ' disabled';
			($prev_status == '')? $prev_page = "/Hosts/".(intval(QS) - 1).'/' : $prev_page = "";
			(($offset + $config['Maximum list size']) < $total_hosts)? $next_status = '': $next_status = ' disabled';
			($next_status == '')? $next_page = "/Hosts/".(intval(QS) + 1).'/' : $next_page = "";
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