<?
	$users = array();
	$query = DB_QUERY(sprintf("SELECT `ID`, CONCAT(`First_name`, ' ', `Last_name`) as 'Name' FROM `User accounts`"));
	if($query) {
		while($row = mysqli_fetch_assoc($query)){
			$users += [$row['ID'] => $row['Name']];
		}
	}
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-9">
			<h1>Logs</h1>
		</div>
		<div class="col-12 col-md-3">
			<div class="row">
				<div class="col-12 col-md-6 form-floating" name="logSelector">
					<select class="form-control" id="LogSelect" style="padding: unset; appearance: auto; -webkit-appearance: auto; -moz-appearance: auto;" onChange="misc.filterLogs('user', this)">
						<option value="">Please select a user...</option>
						<?
							$query = DB_QUERY(sprintf("SELECT `User ID` FROM `Audit trail` GROUP BY `User ID`"));
							if($query) {
								while($row = mysqli_fetch_assoc($query)){
									printf('<option value="%s">%s</option>', $row['User ID'], $users[$row['User ID']]);
								}
							}
						?>
					</select>
				</div>
				<div class="col-12 col-md-6 form-floating" name="logSelector">
					<select class="form-control" id="LogSelect" style="padding: unset; appearance: auto; -webkit-appearance: auto; -moz-appearance: auto;" onChange="misc.filterLogs('category', this)">
						<option value="">Please select a category...</option>
						<?
							$query = DB_QUERY(sprintf("SELECT `Category` FROM `Audit trail` GROUP BY `Category`"));
							if($query) {
								while($row = mysqli_fetch_assoc($query)){
									printf('<option value="%s">%s</option>', $row['Category'], $row['Category']);
								}
							}
						?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Title</th>
					<th scope="col">Category</th>
					<th scope="col">User</th>
					<th scope="col">IP</th>
					<th scope="col">Timestamp</th>
				</tr>
			</thead>
			<tbody>
				<?
					$str[0] = (isset($_GET['category']) && $_GET['category'] != '')? sprintf(" `Category`='%s'", $_GET['category']): '';
					$str[1] = (isset($_GET['category']) && $_GET['category'] != '')? sprintf(" `User ID`='%s'", $_GET['user']): '';
					$query = DB_QUERY(sprintf("SELECT `ID`, `User ID`, `Category`, `String`, `IP`, `Timestamp` FROM `Audit trail` WHERE %s ORDER BY `ID` DESC LIMIT %s", implode('AND', $str), $config['Maximum list size']));
					if($query) {
						while($row = mysqli_fetch_assoc($query)){
							?>
								<tr>
									<td><a href="/Logs/Item/<?=$row['ID']?>/"><?=$row['String']?></a></td>
									<td><?=$row['Category']?></td>
									<td><?=$users[$row['User ID']]?></td>
									<td><?=$row['IP']?></td>
									<td><?=$row['Timestamp']?></td>
								</tr>
							<?
						}
					}
				?>
			</tbody>
		</table>
	</div>
</section>
<script>
	var logSelector = $('div[name=logSelector]').find('select');
	logSelector.change(() => {
		var path = logSelector.find("option:selected").val();
		if(path!=="") {
			$.get(path, function(data) {
				$('div[name=logData]').html(data.replace(/\n/g, "<br />"));
			}, 'text');
		} else {
				$('div[name=logData]').html('');
		}
	});
</script>