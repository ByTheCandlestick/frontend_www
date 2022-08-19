<?
	if(strtolower(QS_SUBPAGE) == "inbox") {
	} elseif(strtolower(QS_SUBPAGE) == "sent") {
	} elseif(strtolower(QS_SUBPAGE) == "junk") {
	} elseif(strtolower(QS_SUBPAGE) == "deleted") {
	} else {
		$url = URL_CURR."/Mail/Inbox/";
		?><script> misc.redirect("<?= $url ?>"); </script><?
	}
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Mail / <?= ucwords(QS_SUBPAGE) ?></h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<a href="/Mail/New/" class="btn btn-outline-danger m-1 d-none">
				<i class="fa fa-trash-alt"></i>
			</a>
			<a href="/Mail/New/" class="btn btn-outline-primary m-1">
				<i class="fa fa-envelope-open"></i>
			</a>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
		<style>
			sidebar {
				background-color: var(--app-container);
				width: 60px;
				transition-duration: 0.5s;
				border-radius: 0px 5px 5px 0px;
				position: fixed;
				left: 0rem;
				margin-top: 6rem!important;
			}
			sidebar div {
				list-style: none;
				display: block;
				color: black;
				overflow: hidden;
				padding: 20px;
				trasintion: all;
				transition-duration: 0.5s;
			}
			sidebar div:before {
				content: "<<"
			}
			sidebar div.active {
				background: gainsboro;
			}
			sidebar div span {
				margin-left: 30px;
				color: black;
				font-size: 20px;
			}
			sidebar div:hover {
				background-color: silver;
			}
			sidebar:hover {
				width: 250px;
			}
		</style>
		<sidebar>
			<a href="/Mail/Inbox/"><div class="<?=(strtolower(QS_SUBPAGE) == "inbox")?"active":"";?>"><span>Inbox</span></div></a>
			<a href="/Mail/Sent/"><div class="<?=(strtolower(QS_SUBPAGE) == "sent")?"active":"";?>"><span>Sent</span></div></a>
			<a href="/Mail/Junk/"><div class="<?=(strtolower(QS_SUBPAGE) == "junk")?"active":"";?>"><span>Junk</span></div></a>
			<a href="/Mail/Deleted/"><div class="<?=(strtolower(QS_SUBPAGE) == "deleted")?"active":"";?>"><span>Deleted</span></div></a>
		</sidebar>
		<div class="row">

		</div>
</section>