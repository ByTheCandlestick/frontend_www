<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Create a new website</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:website.domain.create();" class="btn btn-outline-primary m-1">
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
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Name</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="domain">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
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
							print_r('<option value="'.$row['ID'].'">'.$row['Name'].'</option>');
						}
					?>
				</select>
				<label for="floatingInput">Page type</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="status">
			<div class="form-floating mb-3">
				<div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" name="maintenance" id="flexCheck">
					<label class="form-check-label" for="flexCheck"> Maintenance? </label>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-6 col-lg-3" name="title">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Title</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="slogan">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Slogan</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="email">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Email</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="phone">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Phone</label>
			</div>
		</div>
		
		<div class="col-12 col-md-6 col-lg-3" name="meta_title">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Meta title</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="meta_keywords">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Meta keywords</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="meta_description">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Meta description</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="meta_colour">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Meta colour</label>
			</div>
		</div>
		
		<div class="col-12 col-md-6 col-lg-3" name="primary_colour">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Primary colour</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="secondary_colour">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Secondary colour</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="logo">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Logo</label>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3" name="favicon">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
				<label for="floatingInput">Favicon</label>
			</div>
		</div>
		<hr>
		<div class="col-12 col-md-6 col-lg-3" name="permission">
			<div class="form-floating mb-3">
				<select class="form-select" id="floatingSelect">
					<option value="-1" selected>Please select</option>
					<?
						$query = DB_Query("DESCRIBE `Users_permissions`");
						while($row = mysqli_fetch_array($query)) {
							if(preg_match("([a-z]+\_[a-z\-]+)", $row['Field'])) {
								print_r('<option value="'.$row['Field'].'">'.$row['Field'].'</option>');
							}
						}
					?>
				</select>
				<label for="floatingInput">Permission</label>
			</div>
		</div>
		<div class="col-12 col-lg-6" name="permission">
			<div class="form-floating mb-3">
				<a class="btn btn-outline-primary" href="/Config/Permissions/New/"><i class="fa fa-plus"></i> New permission</a>
			</div>
		</div>
	</div>
</section>