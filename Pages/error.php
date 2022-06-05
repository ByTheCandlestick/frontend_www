<?
	if(QS_SUBPAGE !== "") {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<h1>Error <?print(QS_SUBPAGE)?>.</h1>
			</div>
			<div class="col-12 col-md-6 col-lg-4 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			An error has occurred, Please try again later.
			<br>
			<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="history.go(-1)">Go back</a>
			<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="/">Go home</a>
		</div>
	</section>
<?
	} else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6 col-lg-8">
				<h1>An error occured, no error code was given.</h1>
			</div>
			<div class="col-12 col-md-6 col-lg-4 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			An error has occurred, Please try again later.
			<br>
			<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="history.go(-1)">Go back</a>
			<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="/">Go home</a>
		</div>
	</section>
<?
	}
?>