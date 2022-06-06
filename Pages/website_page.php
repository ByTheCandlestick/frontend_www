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
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['images'])?>">
				<label for="floatingInput">Page URL</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($prod['images'])?>">
				<label for="floatingInput">Subpage URL</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3">
			<?
				$query = DB_Query("SELECT * FROM `page_styles`");
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