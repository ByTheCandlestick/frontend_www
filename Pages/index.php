<?
	$days = array();
	$days_backwards = array();
	for ($i = 0; $i < 7; $i++){
		$day = strtotime('yesterday', $day);
		array_push($days_backwards, date('l', $day));
	}
	for ($i=count($days_backwards)-1; $i>=0; $i--) {
		array_push($days, date('l', $days_backwards[$i]));
	}
	print_r(implode(', ', $days));
?>
<script>
	new Chartist.Line('.ct-chart', {
		labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
		series: [
			[12, 9, 7, 8, 5]
		]
		}, {
		fullWidth: true,
			chartPadding: {
				right: 40
			}
		}
	);

</script>

<section>
	<div class="row" name="Sales snippets">
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">YOY Sales</h5>
					<p class="card-text">With supporting text below.</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">GROSS PROFIT YoY</h5>
					<p class="card-text">With supporting text below as a natural lead-in.</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">SALES TODAY</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">GROSS PROFIT TODAY</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row" name="Sales / day">
		<div class="col-12 col-lg-6">
			<chart class=".ct-sales-day" />
		</div>
	</div>
	<div class="row" name="Website analytics">

	</div>
</section>