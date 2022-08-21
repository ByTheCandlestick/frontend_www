<?
	$query = "";
	if(strtolower(QS_SUBPAGE) == "inbox") {
		$query = "SELECT * FROM `Mail` WHERE `Direction`='Inbound' AND `Status`='Inbox'";
	} elseif(strtolower(QS_SUBPAGE) == "sent") {
		$query = "SELECT * FROM `Mail` WHERE `Direction`='Outbound' AND `Status`='Sent'";
	} elseif(strtolower(QS_SUBPAGE) == "junk") {
		$query = "SELECT * FROM `Mail` WHERE `Direction`='Inbound' AND `Status`='Junk'";
	} elseif(strtolower(QS_SUBPAGE) == "deleted") {
		$query = "SELECT * FROM `Mail` WHERE `Deleted`=1";
	} else {
		?><script> misc.redirect("<?= URL_CURR."/Mail/Inbox/" ?>");</script><?
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
	<!-- Seperator -->
	<hr>
	<!-- Section Body -->
	<style>
		.side-menu {
			width: 10rem;
			height: auto;
			font-size: 1rem;
			line-height: 2rem;
			color: var(--main-color);
			font-weight: 700;
			text-transform: uppercase;
			position: relative;
			top: 0;
			bottom: 0;
			left: -7rem;
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
			-webkit-transition: -webkit-transform 0.5s, background-color .5s, color .5s;
				-moz-transition: -moz-transform 0.5s, background-color .5s, color .5s;
					-o-transition: -o-transform 0.5s, background-color .5s, color .5s;
					transition: transform .5s, background-color .5s, color .5s;
		}
		.side-menu ul li.active {
			background-color: gainsboro;
		}
		.side-menu ul li:hover {
			background-color: silver;
			-webkit-transform: translateX(6rem);
				-moz-transform: translateX(6rem);
					-o-transform: translateX(6rem);
					transform: translateX(6rem);
		}
		.side-menu ul li a:hover {
			color: var(--link-color-hover);
		}
		.side-menu ul li span {
			display: block;
			position: absolute;
			font-size: 1em;
			line-height: 2em;
			height: 2em;
			top: 0;
			bottom: 0;
			margin: 0 auto;
			padding: 1em 1.5em;
			right: 0.16666666666667em;
		}
	</style>
	<div class="row">
		<div class="p-0" style="width: 3rem;">
			<nav class="side-menu">
				<ul>
					<li class="<?=(strtolower(QS_SUBPAGE) == "inbox")?"active":"";?>"><a href="/Mail/Inbox/">Inbox<span><i class="fad fa-inbox"></i></span></a></li>
					<li class="<?=(strtolower(QS_SUBPAGE) == "sent")?"active":"";?>"><a href="/Mail/Sent/">Sent<span><i class="fad fa-inbox-out"></i></span></a></li>
					<li class="<?=(strtolower(QS_SUBPAGE) == "junk")?"active":"";?>"><a href="/Mail/Junk/">Junk<span><i class="fad fa-ban"></i></span></a></li>
					<li class="<?=(strtolower(QS_SUBPAGE) == "deleted")?"active":"";?>"><a href="/Mail/Deleted/">Deleted<span><i class="fad fa-trash-alt"></i></span></a></li>
				</ul>
			</nav>
		</div>
		<div class="" style="width: calc(100% - 3rem);">
			<table class="categoriesTable table table-striped table-hover">
				<thead class="sticky-top">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Name</th>
						<th scope="col">Enabled</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?
						if(mysqli_num_rows($query) > 0) {
							while ($row = mysqli_fetch_array($query)) {
								print('
									<tr>
										<th scope="row">'.$row['ID'].'</th>
										<td>'.$row['Name'].'</td>
										<td>'.$row['Active'].'</td>
										<td>
											<a href="/Categories/Edit/'.$row['ID'].'">
												<i class="fa fa-pencil"></i>
											</a>
										</td>
									</tr>
								');
							}
						} else {
							print('
								<tr>
									<th scope="row"></th>
									<td>No data found</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							');
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>