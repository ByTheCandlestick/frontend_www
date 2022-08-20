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
				width:14em;
				height: auto;
				margin:4em auto 0;
				font-size: 1em;
				line-height: 2em;
				color: #fff;
				font-weight:700;
				text-transform:uppercase;
				position:absolute;
				top:0; 
				bottom:0;
				left: -10em;
			}
			.side-menu ul {
				list-style: none;
				margin: 0;
				padding: 0;
			}
			.side-menu ul li {
			display:block;
				background-color: #333;
				height: 2em;
				padding: 1em 1.5em;
				position: relative;
				-webkit-transition: -webkit-transform 0.5s,     background-color .5s, color .5s;
				transition: transform .5s, background-color .5s, color .5s;
			}
			/*the colors of the different columns*/
			.side-menu ul li:nth-child(1) { background-color: #00aced;}
			.side-menu ul li:nth-child(2) { background-color: #3b5998;}
			.side-menu ul li:nth-child(3) { background-color: #00a300;}
			.side-menu ul li:nth-child(4) { background-color: #1e7145;}
			.side-menu ul li:nth-child(5) { background-color: #ffc40d;}
			.side-menu ul li:nth-child(6) { background-color: #cb2027;}

			.side-menu ul li:hover {
				background-color: #339966; /*you can make different colors depending on the nth-child like above*/
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
				<li><a href="#">What to do?<span><i class="fa fa-map-marker"></i></span></a></li>
				<li><a href="#">Where to go?<span><i class="fa fa-compass"></i></span></a></li>
				<li><a href="#">Services<span><i class="fa fa-bicycle"></i></span></a></li>
				<li><a href="#">Accomodation<span><i class="fa fa-bed"></i></span></a></li>
				<li><a href="#">Free Time<span><i class="fa fa-book"></i></span></a></li>
				<li><a href="#">Food&Drnk<span><i class="fa fa-beer"></i></span></a></li>
			</ul>
		</nav>
		<div class="row">
			
		</div>
</section>