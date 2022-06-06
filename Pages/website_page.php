<?
	$query = DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$site = mysqli_fetch_assoc($query);
		$styles = explode(',', $site['style_ids']);
		$scripts = explode(',', $site['script_ids']);
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
			<div class="col-12 col-lg-6">
				<div class="row">
					<div class="col-12">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($site['name'])?>">
							<label for="floatingInput">Name</label>
						</div>
					</div>
					<div class="col-12">	
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($site['page_title']=='')?'No title was set':'')?>" value="<? print(($site['page_title']=='')?'':$site['page_title'])?>">
							<label for="floatingInput">Title</label>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($site['page_url'])?>">
							<label for="floatingInput">Page URL</label>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<? print($site['subpage_url'])?>">
							<label for="floatingInput">Subpage URL</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="row">
					<div class="col-12 col-md-6">
						<?
							$query = DB_Query("SELECT * FROM `page_styles`");
							while($row = mysqli_fetch_array($query)) {
								(in_array($row['id'], $styles))?$checked=" checked":$checked="";
								print('
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="' . $row['id'] . '" id="StyleCheckboxes-'.$row['id'].'"'.$checked.'>
										<label class="form-check-label" for="StyleCheckboxes-'.$row['id'].'">
											' . $row['name'] . '
										</label>
									</div>
								');
							}
						?>
					</div>
					<div class="col-12 col-md-6">
						<?
							$query = DB_Query("SELECT * FROM `page_scripts`");
							while($row = mysqli_fetch_array($query)) {
								(in_array($row['id'], $scripts))?$checked=" checked":$checked="";
								print('
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="'.$row['id'].'" id="ScriptCheckboxes-'.$row['id'].'"'.$checked.'>
										<label class="form-check-label" for="ScriptCheckboxes-'.$row['id'].'">
											' . $row['name'] . '
										</label>
									</div>
								');
							}
						?>
					</div>
				</div>
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