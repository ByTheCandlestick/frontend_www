<?
	if(strToLower(QS) == "new"){
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>New Theme</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:website.theme.create();" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<h5>Theme info</h5>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="Description">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Description</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="Location">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
					<label for="floatingInput">Location</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="discontinued" id="flexCheck" checked>
						<label class="form-check-label" for="flexCheck"> Active </label>
					</div>
				</div>
			</div>
		</div>
	</section>
<?
	} else if($query = DB_Query(sprintf("SELECT * FROM `page_types` WHERE `ID`=%s", QS))) {
		if(mysqli_num_rows($query) > 0) {
			$theme = mysqli_fetch_assoc($query);
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
						<a href="javascript:website.theme.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:website.theme.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<h5>Theme info</h5>
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($theme['name']=='')?'No name was set':'')?>" value="<? print(($theme['name']=='')?'':$theme['name'])?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="Description">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($theme['Description']=='')?'No name was set':'')?>" value="<? print(($theme['Description']=='')?'':$theme['Description'])?>">
					<label for="floatingInput">Description</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="Location">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($theme['Location']=='')?'No name was set':'')?>" value="<? print(($theme['Location']=='')?'':$theme['Location'])?>">
					<label for="floatingInput">Location</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="discontinued" id="flexCheck" <?($prod['Active']==1)?print("checked"):print("")?>>
						<label class="form-check-label" for="flexCheck"> Active </label>
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