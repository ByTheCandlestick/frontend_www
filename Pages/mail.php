<?
	if(strtolower(QS_SUBPAGE) == "inbox") {
	} elseif(strtolower(QS_SUBPAGE) == "sent") {
	} elseif(strtolower(QS_SUBPAGE) == "junk") {
	} elseif(strtolower(QS_SUBPAGE) == "deleted") {
	} else {
		header("Location: ".URL_CURR."/Mail/Inbox/");
		echo URL_CURR;
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
			#sidebar {
				background-color: var(--app-container);
				width: 60px;
				transition-duration: 0.5s;
				border-bottom-right-radius: 5px;
				border-top-right-radius: 5px;
				position: fixed;
				right: 1rem;
				margin-top: 6rem!important;
			}
			#sidebar:hover {
				-webkit-box-shadow: 10px 4px 34px -1px rgba(0,0,0,0.95);
				-moz-box-shadow: 10px 4px 34px -1px rgba(0,0,0,0.95);
				box-shadow: 10px 4px 34px -1px rgba(0,0,0,0.95);
			}
			#sidebar div {
				list-style: none;
				display: block;
				color: black;
				overflow: hidden;
				padding: 20px;
				trasintion: all;
				transition-duration: 0.5s;
			}
			#sidebar div:before { content: "<<" }
			#sidebar div span {
				margin-left: 30px;
				color: black;
				font-size: 20px;
			}
			#sidebar div:hover {
				background-color: #C9C9C9;
			}
			#sidebar:hover { width: 250px }
		</style>
		<div id="sidebar">
			<a href="/Mail/Inbox/"><div><span>Inbox</span></div></a>
			<a href="/Mail/Sent/"><div><span>Sent</span></div></a>
			<a href="/Mail/Junk/"><div><span>Junk</span></div></a>
			<a href="/Mail/Deleted/"><div><span>Deleted</span></div></a>
		</div>
		<div class="row">

		</div>
</section>