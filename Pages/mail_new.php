<?

?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>New mail</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<a href="javascript:mail.archive()" class="btn btn-outline-primary m-1">
				<i class="fa fa-inbox-in"></i>
			</a>
			<a href="javascript:mail.send()" class="btn btn-outline-primary m-1">
				<i class="fa fa-paper-plane"></i>
			</a>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row mailNew">
		<style>
		</style>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="mail@from.com" value="<?print(strtolower($userdata['Username']))?>@thecandlestick.co.uk" disabled>
				<label for="floatingInput">From</label>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="mail@from.com" value="">
				<label for="floatingInput">To</label>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="mail@from.com" value="">
				<label for="floatingInput">Cc</label>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="mail@from.com" value="">
				<label for="floatingInput">Bcc</label>
			</div>
		</div>
		<div class="col-12">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="mail@from.com" value="">
				<label for="floatingInput">Subject</label>
			</div>
		</div>
		<div class="col-12">
			<div class="form-floating mb-3">
				<textarea class="form-control" id="floatingInput" placeholder="mail@from.com" value="" style="min-height: 200px;"></textarea>
			</div>
		</div>
	</div>
</section>