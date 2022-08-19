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
			.s-sidebar__trigger {
				z-index: 2;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 4em;
				background: #192b3c;
			}
			.s-sidebar__trigger > i {
				display: inline-block;
				margin: 1.5em 0 0 1.5em;
				color: #f07ab0;
			}
			.s-sidebar__nav {
				position: fixed;
				top: 0;
				left: -15em;
				overflow: hidden;
				transition: all .3s ease-in;
				width: 15em;
				height: 100%;
				background: #243e56;
				color: rgba(255, 255, 255, 0.7);
			}
			.s-sidebar__nav:hover,
			.s-sidebar__nav:focus,
			.s-sidebar__trigger:focus + .s-sidebar__nav,
			.s-sidebar__trigger:hover + .s-sidebar__nav {
				left: 0;
			}
			.s-sidebar__nav ul {
				position: absolute;
				top: 4em;
				left: 0;
				margin: 0;
				padding: 0;
				width: 15em;
			}
			.s-sidebar__nav ul li {
				width: 100%;
			}
			.s-sidebar__nav-link {
				position: relative;
				display: inline-block;
				width: 100%;
				height: 4em;
			}
			.s-sidebar__nav-link em {
				position: absolute;
				top: 50%;
				left: 4em;
				transform: translateY(-50%);
			}
			.s-sidebar__nav-link:hover {
				background: #4d6276;
			}
			.s-sidebar__nav-link > i {
				position: absolute;
				top: 0;
				left: 0;
				display: inline-block;
				width: 4em;
				height: 4em;
			}
			.s-sidebar__nav-link > i::before {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
			}

			/* Mobile First */
			@media (min-width: 42em) {
				.s-layout__content {
					margin-left: 4em;
				}
				
				/* Sidebar */
				.s-sidebar__trigger {
					width: 4em;
				}
				
				.s-sidebar__nav {
					width: 4em;
					left: 0;
				}
				
				.s-sidebar__nav:hover,
				.s-sidebar__nav:focus,
				.s-sidebar__trigger:hover + .s-sidebar__nav,
				.s-sidebar__trigger:focus + .s-sidebar__nav {
					width: 15em;
				}
			}

			@media (min-width: 68em) {
				.s-layout__content {
					margin-left: 15em;
				}
				
				/* Sidebar */
				.s-sidebar__trigger {
					display: none
				}
				
				.s-sidebar__nav {
					width: 15em;
				}
				
				.s-sidebar__nav ul {
					top: 1.3em;
				}
			}

		</style>
		<sidebar>
			<a class="s-sidebar__trigger" href="#0">
				<i class="fa fa-bars"></i>
			</a>
			<nav class="s-sidebar__nav">
				<ul>
					<li>
					<a class="s-sidebar__nav-link" href="#0">
						<i class="fa fa-home"></i><em>Home</em>
					</a>
					</li>
					<li>
					<a class="s-sidebar__nav-link" href="#0">
						<i class="fa fa-user"></i><em>My Profile</em>
					</a>
					</li>
					<li>
					<a class="s-sidebar__nav-link" href="#0">
						<i class="fa fa-camera"></i><em>Camera</em>
					</a>
					</li>
				</ul>
			</nav>
		</sidebar>
		<div class="row">

		</div>
</section>