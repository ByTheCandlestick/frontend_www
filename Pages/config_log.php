<?
	$users = array();
	$query = DB_QUERY(sprintf("SELECT `ID`, CONCAT(`First_name`, ' ', `Last_name`) as 'Name' FROM `User accounts`"));
	if($query) {
		while($row = mysqli_fetch_assoc($query)){
			$users += [$row['ID'] => $row['Name']];
		}
	}
	$query = DB_QUERY(sprintf("SELECT * FROM `Audit trail` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$row = mysqli_fetch_assoc($query)
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-9">
			<h1>Log</h1>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class="col-12">
			<h5>General</h5>
			<div class="row">
				<div class="col-12 col-lg-6 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($row['String'])?>" disabled>
					<label for="floatingInput">String description</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($row['Category'])?>" disabled>
					<label for="floatingInput">Category</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($row['Timestamp'])?>" disabled>
					<label for="floatingInput">Timestamp</label>
				</div>
			</div>
		</div>
		<div class="col-12">
			<h5>IP</h5>
			<?
				$geo = file_get_contents(sprintf("https://ip.seeip.org/geoip/%s", $row['IP']));
				$geo = json_decode($geo);
				print_r($geo);
			?>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['ip'])?>" disabled>
					<label for="floatingInput">IP address</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['region'])?>" disabled>
					<label for="floatingInput">Country</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['city'])?>" disabled>
					<label for="floatingInput">City</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['postal_code'])?>" disabled>
					<label for="floatingInput">Postcode</label>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<a name="charge_id" class="form-control border-0" id="floatingInput" href="https://www.google.co.uk/maps/@<?=$geo['latitude']?>,<?=$geo['longitude']?>,15z"><?=($geo['latitude'].''.$geo['longitude'])?></a>
					<label for="floatingInput">Coordinates</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['timzone'])?>" disabled>
					<label for="floatingInput">timezone</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['offset'])?>" disabled>
					<label for="floatingInput">DST</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<? print($geo['orginization'])?>" disabled>
					<label for="floatingInput">ISP</label>
				</div>
			</div>
		</div>
	</div>
</section>
<?
	}
?>