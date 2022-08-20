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
			.side-menu {
				width: 14em;
				height: auto;
				margin: 4em auto 0;
				font-size: 1em;
				line-height: 2em;
				color: var(--main-color);
				font-weight: 700;
				text-transform: uppercase;
				position: relative;
				top: 0;
				bottom: 0;
				left: -11em;
			}
			.side-menu ul {
				list-style: none;
				margin: 0;
				padding: 0;
			}
			.side-menu ul li {
				display: block;
				background-color: var(--app-container);
				padding: 1em 1.5em;
				position: relative;
				-webkit-transition: -webkit-transform 0.5s,     background-color .5s, color .5s;
						transition: transform .5s, background-color .5s, color .5s;
			}
			.side-menu ul li.active {
				background-color: gainsboro;
			}
			.side-menu ul li:hover {
				background-color: silver; /*you can make different colors depending on the nth-child like above*/
				-webkit-transform: translateX(10em);
				transform: translateX(10em);/*equal to left in the .side-menu*/
			}
			.side-menu ul li a {
				display:block;
				color: #FFF;
				text-decoration: none;
			}
			.side-menu ul li span {
				display:block;
				position: absolute;
				font-size:1em;
				line-height: 2em;
				height:2em;
				top:0; 
				bottom:0;
				margin:0 auto;
				padding:1em 1.5em;
				right: 0.16666666666667em;
				color: #F8F6FF;
			}
		</style>
		<nav class="side-menu">
			<ul>
				<li class="<?=(strtolower(QS_SUBPAGE) == "inbox")?"active":"";?>"><a href="#">Inbox<span><i class="fad fa-inbox"></i></span></a></li>
				<li class="<?=(strtolower(QS_SUBPAGE) == "sent")?"active":"";?>"><a href="#">Sent<span><i class="fad fa-inbox-out"></i></span></a></li>
				<li class="<?=(strtolower(QS_SUBPAGE) == "junk")?"active":"";?>"><a href="#">Junk<span><i class="fad fa-"></i></span></a></li>
				<li class="<?=(strtolower(QS_SUBPAGE) == "deleted")?"active":"";?>"><a href="#">Deleted<span><i class="fad fa-trash-alt"></i></span></a></li>
			</ul>
		</nav>
		<div class="row">
			
		</div>
</section>