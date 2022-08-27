<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `Website domains` WHERE `ID`=%s", QS))) > 0) {
		$domain = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit a website</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-flex justify-content-end align-items-center p-0">
						<a href="javascript:website.domain.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:website.domain.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<h5>Site info</h5>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Name']=='')?'No name was set':'')?>" value="<? print(($domain['Name']=='')?'':$domain['Name'])?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="domain">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Domain']=='')?'No domain was set':'')?>" value="<? print(($domain['Domain']=='')?'':$domain['Domain'])?>">
					<label for="floatingInput">Domain</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="page_type">
				<div class="form-floating mb-3">
					<select class="form-select" id="floatingSelect">
						<option value="-1" selected>Please select</option>
						<?
							$query = DB_Query("SELECT * FROM `Website themes` WHERE `Active`=1");
							while ($row = mysqli_fetch_array($query)) {
								$row['ID'] == $domain['Page_type'] ? $selected="selected" : $selected="";
								print_r('<option value="'.$row['ID'].'" '.$selected.'>'.$row['Name'].'</option>');
							}
						?>
					</select>
					<label for="floatingInput">Page type</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="maintenance" id="flexCheck" <?($domain['Maintenance']==1)?print("checked"):print("")?>>
						<label class="form-check-label" for="flexCheck"> Maintenance? </label>
					</div>
				</div>
			</div>
			
			<div class="col-12 col-md-6 col-lg-3" name="title">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Title']=='')?'No domain was set':'')?>" value="<? print(($domain['Title']=='')?'':$domain['Title'])?>">
					<label for="floatingInput">Title</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="slogan">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Slogan']=='')?'No domain was set':'')?>" value="<? print(($domain['Slogan']=='')?'':$domain['Slogan'])?>">
					<label for="floatingInput">Slogan</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="email">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Email']=='')?'No domain was set':'')?>" value="<? print(($domain['Email']=='')?'':$domain['Email'])?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="phone">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Phone']=='')?'No domain was set':'')?>" value="<? print(($domain['Phone']=='')?'':$domain['Phone'])?>">
					<label for="floatingInput">Phone</label>
				</div>
			</div>
			
			<div class="col-12 col-md-6 col-lg-3" name="meta_title">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Meta_title']=='')?'No domain was set':'')?>" value="<? print(($domain['Meta_title']=='')?'':$domain['Meta_title'])?>">
					<label for="floatingInput">Meta title</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="meta_keywords">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Meta_keywords']=='')?'No domain was set':'')?>" value="<? print(($domain['Meta_keywords']=='')?'':$domain['Meta_keywords'])?>">
					<label for="floatingInput">Meta keywords</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="meta_description">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Meta_description']=='')?'No domain was set':'')?>" value="<? print(($domain['Meta_description']=='')?'':$domain['Meta_description'])?>">
					<label for="floatingInput">Meta description</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="meta_colour">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['Meta_colour']=='')?'':$domain['Meta_colour'])?>">
					<label for="floatingInput">Meta colour</label>
				</div>
			</div>
			
			<div class="col-12 col-md-6 col-lg-3" name="primary_colour">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Colour_primary']=='')?'No domain was set':'')?>" value="<? print(($domain['Colour_primary']=='')?'':$domain['Colour_primary'])?>">
					<label for="floatingInput">Primary colour</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="secondary_colour">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Colour_secondary']=='')?'No domain was set':'')?>" value="<? print(($domain['Colour_secondary']=='')?'':$domain['Colour_secondary'])?>">
					<label for="floatingInput">Secondary colour</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="logo">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Logo']=='')?'No domain was set':'')?>" value="<? print(($domain['Logo']=='')?'':$domain['Logo'])?>">
					<label for="floatingInput">Logo</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="favicon">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Favicon']=='')?'No domain was set':'')?>" value="<? print(($domain['Favicon']=='')?'':$domain['Favicon'])?>">
					<label for="floatingInput">Favicon</label>
				</div>
			</div>
		</div>
		<hr>
		<div class="col-12 col-md-6 col-lg-3" name="page_type">
			<div class="form-floating mb-3">
				<label for="floatingInput">Page type</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="permission">
			<div class="form-floating mb-3">
				
				<select class="form-select" id="floatingSelect">
					<option value="-1" selected>Please select</option>
					<?
						$query = mysqli_fetch_array(DB_Query("DESCRIBE `Users_permissions`"));
						array_shift($query);
						while($row = $query) {
							$row['field'] == $domain['Permission'] ? $selected="selected" : $selected="";
							print_r('<option value="'.$row['field'].'" '.$selected.'>'.$row['field'].'</option>');
						}
					?>
				</select>

				<label for="floatingInput">Permission</label>
			</div>
		</div>
	</section>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Website page not found.</h1>
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