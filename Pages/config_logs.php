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
			<!--
				<div class="form-floating" name="logSelector">
					<select class="form-control" id="LogSelect" style="padding: unset; appearance: auto; -webkit-appearance: auto; -moz-appearance: auto;">
						<option value="">Please select a log...</option>
						<?
							/*
								foreach(getDirContents(__ROOT__, '.log') as $log) {
									printf('<option value="%s">%s</option>', $log['Path'], $log['File']);
								}
							*/
						?>
					</select>
				</div>
			-->
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">User</th>
					<th scope="col">Category</th>
					<th scope="col">String</th>
					<th scope="col">Command</th>
					<th scope="col">Arguments</th>
					<th scope="col">IP</th>
					<th scope="col">Timestamp</th>
				</tr>
			</thead>
			<tbody>
				<?
					$users = array();
					$query = DB_QUERY(sprintf("SELECT `ID`, `User ID`, `Category`, `String`, `Function`, SUBSTRING(`Args`, 0, 20), `IP`, `Timestamp` FROM `Audit trail`"));
					if($query) {
						while($row = mysqli_fetch_assoc($query)){
							?>
								<tr>
									<td><?=$row['ID']?></td>
									<td><?=$users[$row['User ID']]?></td>
									<td><?=$row['Category']?></td>
									<td><?=$row['String']?></td>
									<td><?=$row['Function']?></td>
									<td><?=$row['Args']?></td>
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