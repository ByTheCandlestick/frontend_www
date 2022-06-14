<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Create a new website</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
		<div class="row">
			<div class="col-12 col-lg-6 d-flex justify-content-end align-items-center p-0">
				<a href="javascript:website.save();" class="btn btn-outline-primary m-1">
					<i class="fa fa-save"></i>
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
						<label for="floatingInput">Domain</label>
					</div>
				</div>
				<div class="col-12 col-lg-6" name="type">
					<div class="form-floating mb-3">
						<select class="form-select" id="floatingSelect">
							<option value="-1" selected>Please select</option>
							<?
								$query = DB_Query("SELECT * FROM `page_types` WHERE `Active`=1");
								while ($row = mysqli_fetch_array($query)) {
									print_r('<option value="'.$row['ID'].'">'.$row['Name'].'</option>');
								}
							?>
						</select>
						<label for="floatingInput">Range</label>
					</div>
				</div>

				<div class="col-12 col-lg-3" name="status">
						<div class="form-floating mb-3">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" name="maintenance" id="flexCheck">
								<label class="form-check-label" for="flexCheck"> Maintenance? </label>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>