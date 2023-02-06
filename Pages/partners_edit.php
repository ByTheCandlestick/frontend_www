<?
	$query = DB_Query(sprintf("SELECT * FROM `Partner accounts` WHERE `ID`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$partner = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit partner</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:partner.delete(<?=(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:partner.update(<?=(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row PartnerInfo">
			<div class="col-12 col-md-4">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6" name="name">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Name']?>">
							<label for="floatingInput">Name</label>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6" name="slug">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Slug']?>">
							<label for="floatingInput">Slug</label>
						</div>
					</div>
					<div class="col-12 col-md-3 col-lg-6" name="misc">
						<div class="form-floating mb-3">
							<div class="form-check form-switch">
								<? ($partner['Active']==1)?$checked="checked":$checked=""; ?>
								<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="active" <?=($checked)?>>
								<label class="form-check-label" for="flexCheckDisabled"> Active? </label>
							</div>
							<div class="form-check form-switch">
								<? ($partner['Public']==1)?$checked="checked":$checked=""; ?>
								<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="public" <?=($checked)?>>
								<label class="form-check-label" for="flexCheckDisabled"> Public? </label>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6" name="link">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Shop link']?>">
							<label for="floatingInput">Shop link</label>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6" name="email">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Email']?>">
							<label for="floatingInput">Email</label>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6" name="phone">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['Phone']?>">
							<label for="floatingInput">Phone</label>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-8">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6" name="description_short">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['About short']?>">
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6" name="description_long">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?= $partner['About long']?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		tinymce.init({
			selector: 'div[name=description_long] input, div[name=description_short] input',
			toolbar: 'undo redo |'+
					 'formatpainter casechange blocks |'+
					 'bold italic backcolor | '+
					 'alignleft aligncenter alignright alignjustify | ' +
					 'bullist numlist checklist outdent indent |'+
					 'removeformat |'+
					 'code table help'
		});
	</script>
<?
	}
?>