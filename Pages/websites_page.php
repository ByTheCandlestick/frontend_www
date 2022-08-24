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
					<div class="col-12" name="domain">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `Websites`");
									while ($row = mysqli_fetch_array($query)) {
										print_r('<option value="'.$row['ID'].'">'.$row['Domain'].' - '.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Domain</label>
						</div>
					</div>
					<h5>Menu info</h5>
					<div class="col-12" name="menu_item">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="MenuCheckboxe">
							<label class="form-check-label" for="MenuCheckboxe">Is menu item?</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="menu_order">
						<div class="form-floating mb-3">
							<input type="number" class="form-control" id="floatingInput" placeholder="" value="">
							<label for="floatingInput">Menu Order</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="menu_icon">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
							<label for="floatingInput">Icon</label>
						</div>
					</div>
					<div class="col-12 col-lg-6" name="menu_url">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
							<label for="floatingInput">URL</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="row">
					<div class="col-12 col-md-6" name="styles">
						<h5>Styles</h5>
						<?
							$query = DB_Query("SELECT * FROM `Websites styles` WHERE `Active`=1 ORDER BY `importance` ASC");
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
							$query = DB_Query("SELECT * FROM `Websites scripts` WHERE `Active`=1 ORDER BY `importance` ASC");
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
	} else if($query = DB_Query(sprintf("SELECT * FROM `Websites pages` WHERE `ID`=%s", QS))) {
		if(mysqli_num_rows($query) > 0) {
			$page = mysqli_fetch_assoc($query);
			$styles = explode(',', $page['style_ids']);
			$scripts = explode(',', $page['script_ids']);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Website Edit</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-flex justify-content-end align-items-center p-0">
						<a href="javascript:website.page.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:website.page.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
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
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['page_name']=='')?'No name was set':'')?>" value="<? print(($page['page_name']=='')?'':$page['page_name'])?>">
							<label for="floatingInput">Name</label>
						</div>
					</div>
					<div class="col-12 col-md-6" name="title">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['page_title']=='')?'No title was set':'')?>" value="<? print(($page['page_title']=='')?'':$page['page_title'])?>">
							<label for="floatingInput">Title</label>
						</div>
					</div>
					<div class="col-12 col-md-6" name="page_url">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['page_url']=='')?'No base URL was set':'')?>" value="<? print(($page['page_url']=='')?'':$page['page_url'])?>">
							<label for="floatingInput">Page URL</label>
						</div>
					</div>
					<div class="col-12 col-md-6" name="subpage_url">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['subpage_url']=='')?'No sub URL was set':'')?>" value="<? print(($page['subpage_url']=='')?'':$page['subpage_url'])?>">
							<label for="floatingInput">Subpage URL</label>
						</div>
					</div>
					<div class="col-12" name="domain">
						<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect">
								<option value="-1" selected>Please select</option>
								<?
									$query = DB_Query("SELECT * FROM `Websites`");
									while ($row = mysqli_fetch_array($query)) {
										$row['ID'] == $page['domain_id'] ? $selected="selected" : $selected="";
										print_r('<option value="'.$row['ID'].'"'.$selected.'>'.$row['Domain'].' - '.$row['Name'].'</option>');
									}
								?>
							</select>
							<label for="floatingInput">Domain</label>
						</div>
					</div>
					<h5>Menu info</h5>
					<div class="col-12" name="menu_item">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="MenuCheckbox" <?($page['menu_item']==1)?print("checked"):print("")?>>
							<label class="form-check-label" for="MenuCheckbox">Is menu item?</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="menu_order">
						<div class="form-floating mb-3">
							<input type="number" class="form-control" id="floatingInput" placeholder="<? print(($page['menu_order']=='')?'No title was set':'')?>" value="<? print(($page['menu_order']=='')?'':$page['menu_order'])?>">
							<label for="floatingInput">Menu Order</label>
						</div>
					</div>
					<div class="col-12 col-lg-3" name="menu_icon">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['menu_icon']=='')?'No title was set':'')?>" value="<? print(($page['menu_icon']=='')?'':$page['menu_icon'])?>">
							<label for="floatingInput">Icon</label>
						</div>
					</div>
					<div class="col-12 col-lg-6" name="menu_url">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['menu_url']=='')?'No title was set':'')?>" value="<? print(($page['menu_url']=='')?'':$page['menu_url'])?>">
							<label for="floatingInput">URL</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="row">
					<div class="col-12 col-md-6" name="styles">
						<h5>Styles</h5>
						<?
							$query = DB_Query("SELECT * FROM `Websites styles` WHERE `Active`=1 ORDER BY `importance` ASC");
							while($row = mysqli_fetch_array($query)) {
								(in_array($row['ID'], $styles))?$checked=" checked":$checked="";
								print('
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="' . $row['ID'] . '" id="StyleCheckboxes-'.$row['ID'].'"'.$checked.'>
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
							$query = DB_Query("SELECT * FROM `Websites scripts` WHERE `Active`=1 ORDER BY `importance` ASC");
							while($row = mysqli_fetch_array($query)) {
								(in_array($row['ID'], $scripts))?$checked=" checked":$checked="";
								print('
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="'.$row['ID'].'" id="ScriptCheckboxes-'.$row['ID'].'"'.$checked.'>
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
		}
	} else {
		header('location: /Error/404/');
	}
?>