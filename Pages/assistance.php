<style>
	.nav {
		width: 500px;
		height: 80px;
		margin: 0 auto;
	}
	.nav:hover .link {
		width: 5%;
	}
	.nav .link {
		position: relative;
		float: left;
		width: 20%;
		height: 100%;
		color: #aaa;
		border-right: 1px solid #ddd;
		transition: 0.5s width;
		overflow: hidden;
		cursor: pointer;
	}
	.nav .link:last-child {
		border-right: 0;
	}
	.nav .link:hover {
		width: 80%;
		color: #555;
	}
	.nav .link .small {
		position: absolute;
		top: 0;
		left: 0;
		width: 100px;
		line-height: 78px;
		text-align: center;
		font-size: 24px;
	}
	.nav .link .full {
		position: absolute;
		top: 22px;
		left: 100px;
		text-transform: uppercase;
	}
	.nav .link .full .f1, .nav .link .full .f2 {
		font-size: 16px;
		font-weight: 700;
		white-space: nowrap;
	}
	.nav .link .full .f2 {
		margin-top: 8px;
		font-size: 12px;
	}
	.nav .link .prev {
		position: absolute;
		top: 0;
		left: 7px;
		font-family: fontawesome;
		font-size: 12px;
		line-height: 78px;
		transition: 0.5s opacity;
		opacity: 0;
	}
	.nav .link:hover .prev {
		opacity: 0;
	}
	.nav:hover .prev {
		opacity: 1;
	}
</style>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Assistance</h1>
			<p>What would you like help with?</p>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class='nav'>
			<div class='link'>
				<div class='prev'><i class="fad fa-chart-network"></i></div>
				<div class='small'><i class="fad fa-chart-network"></i></div>
				<div class='full'>
					<div class='f1'>Api</div>
					<div class='f2'>Click here for assistance with the API</div>
				</div>
			</div>
			<div class='link'>
				<div class='prev'><i class="fad fa-chalkboard"></i></div>
				<div class='small'><i class="fad fa-chalkboard"></i></div>
				<div class='full'>
					<div class='f1'>Learning</div>
					<div class='f2'></div>
				</div>
			</div>
			<div class='link'>
				<div class='prev'><i class="fad fa-books"></i></div>
				<div class='small'><i class="fad fa-books"></i></div>
				<div class='full'>
					<div class='f1'>Recipes</div>
					<div class='f2'></div>
				</div>
			</div>
		</div>
    </div>
</section>