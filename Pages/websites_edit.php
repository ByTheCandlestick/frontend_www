<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `misc_websites` WHERE `ID`=%s", QS))) > 0) {
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
							$query = DB_Query("SELECT * FROM `page_types` WHERE `Active`=1");
							while ($row = mysqli_fetch_array($query)) {
								$row['ID'] == $domain['page_type'] ? $selected="selected" : $selected="";
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
			
			<div class="col-12 col-md-6 col-lg-3" name="meta_title">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_title']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_title']=='')?'':$domain['meta_title'])?>">
					<label for="floatingInput">Meta title</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="meta_keywords">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_keywords']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_keywords']=='')?'':$domain['meta_keywords'])?>">
					<label for="floatingInput">Meta keywords</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="meta_description">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_description']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_description']=='')?'':$domain['meta_description'])?>">
					<label for="floatingInput">Meta description</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="meta_colour">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Meta colour</label>
				</div>
			</div>
			
			<div class="col-12 col-md-6 col-lg-3" name="title">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Title</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="slogan">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Slogan</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="email">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="phone">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Phone</label>
				</div>
			</div>
			
			<div class="col-12 col-md-6 col-lg-3" name="primary_colour">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Primary colour</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="secondary_colour">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Secondary colour</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="logo">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['meta_colour']=='')?'No domain was set':'')?>" value="<? print(($domain['meta_colour']=='')?'':$domain['meta_colour'])?>">
					<label for="floatingInput">Logo</label>
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