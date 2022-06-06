<?
	if(QS_SUBPAGE != "") {
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Oxygen</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
			<a href="/Oxygen/<?print(QS)?>" class="btn btn-outline-primary">
				<i class="fa fa-pencil"></i>
			</a>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">

	</div>
</section>
<?
	} else {
?>
	<script>
		window.location = "/";
	</script>
<?
	}
?>