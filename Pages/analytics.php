<?
	$days = $days_b = array();
	for ($i = 0; $i < 7; $i++){
		array_push($days_b, date('l', $day));
		$day = strtotime('yesterday', $day);
	}
	for ($i=count($days_b)-1; $i>=0; $i--) {
		array_push($days, $days_b[$i]);
	}
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-8">
			<h1>Analytics</h1>
		</div>
		<div class="col-12 col-md-6 col-lg-4 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class="row col-12 col-md-6">
			<h3>Pages</h3>
			<div class="col-12 col-md-6">
				<h5>Page referrers</h5>
				<chart class="ct-page-referrers" />
				<script>
					new Chartist.Line('.ct-page-referrers', {
						labels: ['<?print(implode('\', \'', $days))?>'],
						series: [
							[0,1,2,3]
							[1,2,3,4]
							[2,3,4,5]
						]
					}, {
						fullWidth: true,
						showArea: true,
						showLine: false,
						chartPadding: {
							right: 40
						}
					});
				</script>
			</div>
			<div class="col-12 col-md-6">
				<h5>Interactions</h5>
				<chart class="ct-interactions" />
				<script>
					new Chartist.Line('.ct-interactions', {
						labels: ['L0', 'L1', 'L2', 'L3'],
						series: [
							[0,1,2,3]
						]
					}, {
						fullWidth: true,
						showArea: true,
						showLine: false,
						chartPadding: {
							right: 40
						}
					});
				</script>
			</div>
		</div>
		<div class="row col-12 col-md-6">
			<h3>Products</h3>
			<div class="col-12 col-md-6">
				<h5>Product sales / day</h5>
				<chart class="ct-prod-sales-day" />
				<script>
					new Chartist.Line('.ct-prod-sales-day', {
						labels: ['L0', 'L1', 'L2', 'L3'],
						series: [
							[0,1,2,3]
						]
					}, {
						fullWidth: true,
						showArea: true,
						showLine: false,
						chartPadding: {
							right: 40
						}
					});
				</script>
			</div>
			<div class="col-12 col-md-6">
				<h5>Product popularity</h5>
				<chart class="ct-prod-popularity" />
				<script>
					new Chartist.Line('.ct-prod-popularity', {
						labels: ['L0', 'L1', 'L2', 'L3'],
						series: [
							[0,1,2,3]
						]
					}, {
						fullWidth: true,
						showArea: true,
						showLine: false,
						chartPadding: {
							right: 40
						}
					});
				</script>
			</div>
		</div>
		<div class="row col-12 col-md-6">
			<h3>Users</h3>
			<div class="col-12 col-md-6">
				<h5>Users created / day</h5>
				<chart class="ct-users-created-day" />
				<script>
					new Chartist.Line('.ct-users-created-day', {
						labels: ['L0', 'L1', 'L2', 'L3'],
						series: [
							[0,1,2,3]
						]
					}, {
						fullWidth: true,
						showArea: true,
						showLine: false,
						chartPadding: {
							right: 40
						}
					});
				</script>
			</div>
			<div class="col-12 col-md-6">
				<h5></h5>
			</div>
		</div>
	</div>
</section>