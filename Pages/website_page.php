<?
	$query = DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$site = mysqli_fetch_assoc($query);
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Website Edit</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end"></div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-3">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($site['images'])?>">
				<label for="floatingInput">Page URL</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($site['images'])?>">
				<label for="floatingInput">Subpage URL</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3">
			<?
				$query = DB_Query("SELECT * FROM `page_styles`");
				while($row = mysqli_fetch_array($query)) {
					()?$checked=:;
					print('
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="' . $row['id'] . '" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								' . $row['name'] . '
							</label>
						</div>
					');
				}
			?>
		</div>
		<div class="col-12 col-md-6 col-lg-3">
			<?
				$query = DB_Query("SELECT * FROM `page_scripts`");
				while($row = mysqli_fetch_array($query)) {
					print('
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="' . $row['id'] . '" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								' . $row['name'] . '
							</label>
						</div>
					');
				}
			?>
		</div>
	</div>
</section>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<h1>Website not found.</h1>
			</div>
			<div class="col-12 col-md-6 col-lg-4 text-md-end">
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