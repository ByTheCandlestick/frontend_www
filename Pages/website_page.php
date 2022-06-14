<?
	if(strToLower(QS) == "new"){
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>New Page</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
		<div class="row">
			<div class="col-12 d-flex justify-content-end align-items-center p-0">
				<a href="javascript:website.page.create();" class="btn btn-outline-primary m-1">
					<i class="fa fa-save"></i>
				</a>
			</div>
		</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="row">
				<h5>Site info</h5>
				<div class="col-12 col-md-6" name="name">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Name</label>
					</div>
				</div>
				<div class="col-12 col-md-6" name="title">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Title</label>
					</div>
				</div>
				<div class="col-12 col-md-6" name="page_url">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Page URL</label>
					</div>
				</div>
				<div class="col-12 col-md-6" name="subpage_url">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Subpage URL</label>
					</div>
				</div>
				<div class="col-12" name="page_type">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `misc_websites`");
								while ($row = mysqli_fetch_array($query)) {
									print_r('<option value="'.$row['ID'].'">'.$row['Domain'].' - '.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Domain</label>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="row">
				<div class="col-12 col-md-6" name="styles">
					<h5>Styles</h5>
					<?
						$query = DB_Query("SELECT * FROM `page_styles` ORDER BY `importance` ASC");
						while($row = mysqli_fetch_array($query)) {
							print('
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="' . $row['ID'] . '" id="StyleCheckboxes-'.$row['ID'].'">
									<label class="form-check-label" for="StyleCheckboxes-'.$row['ID'].'">
										' . $row['Name'] . '
									</label>
								</div>
							');
						}
					?>
				</div>
				<div class="col-12 col-md-6" name="scripts">
					<h5>Scripts</h5>
					<?
						$query = DB_Query("SELECT * FROM `page_scripts` ORDER BY `importance` ASC");
						while($row = mysqli_fetch_array($query)) {
							print('
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="'.$row['ID'].'" id="ScriptCheckboxes-'.$row['ID'].'">
									<label class="form-check-label" for="ScriptCheckboxes-'.$row['ID'].'">
										' . $row['Name'] . '
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
	} else if($query = DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `ID`=%s", QS))) {
		if(mysqli_num_rows($query) > 0) {
			$site = mysqli_fetch_assoc($query);
			$styles = explode(',', $site['style_ids']);
			$scripts = explode(',', $site['script_ids']);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Website Edit</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:website.page.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
					<a href="/Oxygen/<?print(QS)?>/" class="btn btn-outline-primary m-1">
						<i class="fa fa-pencil"></i>
					</a>
				</div>
				<div class="col-12 col-lg-6">
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="row">
					<h5>Site info</h5>
					<div class="col-12" name="name">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($site['page_name']=='')?'No name was set':'')?>" value="<? print(($site['page_name']=='')?'':$site['page_name'])?>">
							<label for="floatingInput">Name</label>
						</div>
					</div>
					<div class="col-12" name="title">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($site['page_title']=='')?'No title was set':'')?>" value="<? print(($site['page_title']=='')?'':$site['page_title'])?>">
							<label for="floatingInput">Title</label>
						</div>
					</div>
					<div class="col-12 col-md-6" name="page_url">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($site['page_url']=='')?'No base URL was set':'')?>" value="<? print(($site['page_url']=='')?'':$site['page_url'])?>">
							<label for="floatingInput">Page URL</label>
						</div>
					</div>
					<div class="col-12 col-md-6" name="subpage_url">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($site['subpage_url']=='')?'No sub URL was set':'')?>" value="<? print(($site['subpage_url']=='')?'':$site['subpage_url'])?>">
							<label for="floatingInput">Subpage URL</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="row">
					<div class="col-12 col-md-6" name="styles">
						<h5>Styles</h5>
						<?
							$query = DB_Query("SELECT * FROM `page_styles` ORDER BY `importance` ASC");
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
					<div class="col-12 col-md-6" name="scripts">
						<h5>Scripts</h5>
						<?
							$query = DB_Query("SELECT * FROM `page_scripts` ORDER BY `importance` ASC");
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
		}
	} else {
		header('location: /Error/404/');
	}
?>