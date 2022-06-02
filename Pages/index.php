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
			<chart class="ct-sales-day" />
		</div>
		<div class="col-12 col-lg-6">
			<chart class="ct-money-day" />
		</div>
	</div>
	<div class="row" name="Website analytics">

	</div>
</section>

<script>
	new Chartist.Line('.ct-sales-day', {
		labels: ['<?print(implode('\', \'', $days))?>'],
		series: [
			[12, 9, 7, 8, 5, 11, 0]
		]
	}, {
		fullWidth: true,
		showArea: true,
		showLine: false,
		chartPadding: {
			right: 40
		}
	});
	
	new Chartist.Line('.ct-money-day', {
		labels: ['<?print(implode('\', \'', $days))?>'],
		series: [
			[24, 18, 14, 16, 10, 22, 0],
			[18, 13.5, 10.5, 12, 7.5, 16.5, 0]
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