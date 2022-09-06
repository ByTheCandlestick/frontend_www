<?
	$query = DB_Query(sprintf("SELECT * FROM `User accounts` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$user = mysqli_fetch_assoc($query);
?>
    <section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>User Cart</h1>
                <p>UID: <?print($user['ID'])?></p>
                <p>Name: <?print($user['First_name'].' '.$user['Last_name'])?></p>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
    </section>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>User not found.</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<button class="btn btn-outline-primary col-12 col-md-3 col-lg-1" onclick="history.go(-1)">Go back</buton>
		</div>
	</section>
<?
	}
?>