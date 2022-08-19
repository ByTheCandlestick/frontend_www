<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Inbox</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<a href="/Mail/New/" class="btn btn-outline-primary m-1">
				<i class="fa fa-envelope-open"></i>
			</a>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
		<div id="sidebar">
			<div><span><a href="/Mail/Inbox/">Inbox</a></span></div>
			<div><span><a href="/Mail/Sent/">Sent</a></span></div>
			<div><span><a href="/Mail/Junk/">Junk</a></span></div>
			<div><span><a href="/Mail/Deleted/">Deleted</a></span></div>
		</div>
<?
	if( strtolower(QS_SUBPAGE) == "inbox" ) {
?>
		<div class="row">
			
		</div>
<?
	} else {
?>
	<div class="row">
	</div>
<?
	}
?>
</section>