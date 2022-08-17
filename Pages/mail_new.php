<?
	(isset($_GET['from']) && $_GET['from']!='')?$f=$_GET['from']:$f=strtolower($userdata['Username']).'@thecandlestick.co.uk';
	(isset($_GET['to']) && $_GET['to']!='')?$t=$_GET['to']:$t='';
	(isset($_GET['cc']) && $_GET['cc']!='')?$c=$_GET['cc']:$c='';
	(isset($_GET['bcc']) && $_GET['bcc']!='')?$b=$_GET['bcc']:$b='';
	(isset($_GET['subject']) && $_GET['subject']!='')?$s=$_GET['subject']:$s='';
	(isset($_GET['message']) && $_GET['message']!='')?$m=$_GET['message']:$m='';
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
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control mail-from" id="floatingInput" placeholder="mail@from.com" value="<?print($f)?>">
				<label for="floatingInput">From</label>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control mail-to" id="floatingInput" placeholder="mail@from.com" value="<?print($t)?>">
				<label for="floatingInput">To</label>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control mail-cc" id="floatingInput" placeholder="mail@from.com" value="<?print($c)?>">
				<label for="floatingInput">Cc</label>
			</div>
		</div>
		<div class="col-12 col-lg-6">
			<div class="form-floating mb-3">
				<input type="text" class="form-control mail-bcc" id="floatingInput" placeholder="mail@from.com" value="<?print($b)?>">
				<label for="floatingInput">Bcc</label>
			</div>
		</div>
		<div class="col-12">
			<div class="form-floating mb-3">
				<input type="text" class="form-control mail-subject" id="floatingInput" placeholder="mail@from.com" value="<?print($s)?>">
				<label for="floatingInput">Subject</label>
			</div>
		</div>
		<div class="col-12">
			<div class="form-floating mb-3">
				<textarea class="form-control mail-message" id="floatingInput" placeholder="mail@from.com" value="" style="min-height: 200px;"><?print($m)?></textarea>
				<label for="floatingInput">Message</label>
			</div>
		</div>
	</div>
	<script>
      tinymce.init({
        selector: '.mail-message',
        toolbar: 'undo redo |'+
				 'formatpainter casechange blocks |'+
				 'bold italic backcolor | '+
          		 'alignleft aligncenter alignright alignjustify | ' +
        		 'bullist numlist checklist outdent indent |'+
				 'removeformat |'+
				 'code table help'
      });
    </script>
</section>