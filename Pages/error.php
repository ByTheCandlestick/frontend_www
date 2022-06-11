<?
	if(QS_SUBPAGE !== "") {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Error <?print(QS_SUBPAGE)?>.</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<div class="row">
				An error has occurred, Please try again later.
		</div>
		<div class="row">
				<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="history.go(-1)">Go back</a>
				<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" href="/">Go home</a>
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
				<h1>An error occured, no error code was given.</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<div class="row">
				An error has occurred, Please try again later.
		</div>
		<div class="row">
				<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="history.go(-1)">Go back</a>
				<a class="btn btn-outline-primary col-12 col-md-3 col-lg-1 m-1" onclick="/">Go home</a>
			</div>
		</div>
	</section>
<?
	}
?>