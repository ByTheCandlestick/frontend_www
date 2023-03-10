<?
	$users = array();
	$query = DB_QUERY(sprintf("SELECT `ID`, CONCAT(`First_name`, ' ', `Last_name`) as 'Name', `Email` FROM `User accounts`"));
	if($query) {
		while($row = mysqli_fetch_assoc($query)){
			$users += [$row['ID'] => [$row['Name'], $row['Email']]];
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
					<input type="text" class="form-control" id="floatingInput" value="<?=($row['String'])?>" disabled>
					<label for="floatingInput">String description</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($row['Category'])?>" disabled>
					<label for="floatingInput">Category</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($row['Timestamp'])?>" disabled>
					<label for="floatingInput">Timestamp</label>
				</div>
			</div>
		</div>
		<div class="col-12">
			<? 
				$geoRAW = file_get_contents(sprintf("https://ip.seeip.org/geoip/%s", $row['IP']));
				$timeRAW = file_get_contents(sprintf("https://www.timeapi.io/api/Time/current/zone?timeZone=%s", $geo['timezone']));
				$geo = json_decode($geoRAW, true);
				$time = json_decode($timeRAW, true);
			?>
			<h5>IP</h5>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['ip'])?>" disabled>
					<label for="floatingInput">IP address</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['timezone'])?>" disabled>
					<label for="floatingInput">Timezone</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['offset']/3600)?> hour(s)" disabled>
					<label for="floatingInput">DST</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($time['time'])?>" disabled>
					<label for="floatingInput">Current time (NOT LIVE)</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<a name="charge_id" class="form-control disabled" id="floatingInput" href="https://www.google.co.uk/maps/@<?=$geo['latitude']?>,<?=$geo['longitude']?>,15z"><?=($geo['latitude'].', '.$geo['longitude'])?></a>
					<label for="floatingInput">Coordinates</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['country'])?>" disabled>
					<label for="floatingInput">Country</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['region'])?>" disabled>
					<label for="floatingInput">Region</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['city'])?>" disabled>
					<label for="floatingInput">City</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['postal_code'])?>" disabled>
					<label for="floatingInput">Postcode</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($geo['organization'])?>" disabled>
					<label for="floatingInput">ISP</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="AS<?=($geo['asn'])?>" disabled>
					<label for="floatingInput">ISP ASN</label>
				</div>
			</div>
		</div>
		<div class="col-12">
			<h5>User</h5>
			<div class="row">
				<div class="col-12 col-md-3 col-lg-3 form-floating mb-3">
					<a name="charge_id" class="form-control disabled" id="floatingInput" href="/User/View/<?=$row['User ID']?>/"><?=($users[$row['User ID']][0])?></a>
					<label for="floatingInput">User</label>
				</div>
				<div class="col-12 col-md-6 col-lg-3 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($users[$row['User ID']][1])?>" disabled>
					<label for="floatingInput">Email address</label>
				</div>
			</div>
		</div>
		<div class="col-12">
			<h5>Functions -- Development only</h5>
			<div class="row">
				<div class="col-12 col-lg-2 form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" value="<?=($row['Function'])?>" disabled>
					<label for="floatingInput">Function</label>
				</div>
				<div class="col-12 col-lg-10 form-floating mb-3">
					<?
						$args = $row['Args'];
						print_r($args);
						$args = preg_replace("/], /", "],\n", $args);
						print_r($args);
						$lines = ($x=count($args) > 10)? 10: $x;
					?>
					<textarea type="text" class="form-control" id="floatingInput" rows="<?=($lines)?>" style="height: unset;" disabled><?=($args)?></textarea>
					<label for="floatingInput">Args</label>
				</div>
			</div>
		</div>
	</div>
</section>
<?
	}
?>