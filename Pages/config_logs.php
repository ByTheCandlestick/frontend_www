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
					<th scope="col">First</th>
					<th scope="col">Last</th>
					<th scope="col">Handle</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<th scope="row">2</th>
					<td>Jacob</td>
					<td>Thornton</td>
					<td>@fat</td>
				</tr>
				<tr>
					<th scope="row">3</th>
					<td>Larry</td>
					<td>the Bird</td>
					<td>@twitter</td>
				</tr>
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