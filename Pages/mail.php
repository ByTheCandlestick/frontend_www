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
		<style>
			#wrap {
				margin: 10px auto;
				width: 500px;
				overflow: hidden;
				border: 1px solid grey;
				text-align: center;
			}
			#wrap .title {
				font-size: 30px;
				padding: 10px;
				border-bottom: 1px solid grey;
			}
			#sidebar {
				position: fixed;
				top: 20%;
				left: 0px;
				background-color: white;
				width: 60px;
				trasintion: all;
				transition-duration: 0.5s;
				border-bottom-right-radius: 5px;
				border-top-right-radius: 5px;
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
			#sidebar div:before { content: ">>" }
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