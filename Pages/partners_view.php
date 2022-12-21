<?
	$query = DB_Query(sprintf("SELECT * FROM `Partners` WHERE `Reference`=%s", QS));
	if(mysqli_num_rows($query) > 0) {
		$part = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Partner</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="/Partner/Edit/<?=(QS)?>/;" class="btn btn-outline-primary m-1">
							<i class="fa fa-pencil"></i>
						</a>
						<a href="javascript:partner.delete(<?=(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row PartnerInfo">
		</div>
	</section>
<?
	}
?>