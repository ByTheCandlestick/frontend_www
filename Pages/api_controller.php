<?
	if(strToLower(QS) == "new"){
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>New Controller</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:api.controller.create();" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
		</div>
	</section>
<?
	} else if($query = DB_Query(sprintf("SELECT * FROM `API Controllers` WHERE `ID`=%s", QS))) {
		if(mysqli_num_rows($query) > 0) {
			$controller = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit Controller</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-flex justify-content-end align-items-center p-0">
						<a href="javascript:api.controller.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
						<a href="javascript:api.controller.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<?=$controller?>
		</div>
	</section>
<?
		}
	} else {
		header('location: /Error/404/');
	}
?>