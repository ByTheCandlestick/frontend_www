<?
	$days = $days_b = array();
	for ($i = 0; $i < 7; $i++){
		array_push($days_b, date('l', $day));
		$day = strtotime('yesterday', $day);
	}
	for ($i=count($days_b)-1; $i>=0; $i--) {
		array_push($days, $days_b[$i]);
	}
	echo $currYear = date(mktime(0, 0, 0, 1, 1, date('Y')));
	echo ' - ';
	echo $lastYear = date(mktime(0, 0, 0, 1, 1, date('Y')-1));
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Dashboard</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row" name="Sales snippets">
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">YOY Sales</h5>
					<?
						$currYearSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='01/01/%d' GROUP BY `Currency`;", date("Y"))));
						$lastYearSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='01/01/%d' AND `Created`<='01/01/%d' GROUP BY `Currency`;", date("Y")-1, date("Y"))));
					?>
					<p class="card-text">
						<span>
							<?
								if($currYearSales[1] == 0) {
									print('NaN');
								} else {
									print($currYearSales[0] . number_format($currYearSales[1], 2));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastYearSales[1] == 0) {
									print('NaN');
								} else {
									print($lastYearSales[0] . number_format($lastYearSales[1], 2));
								}
							?>
						</span>
					</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">GROSS PROFIT YoY</h5>
					<?
						$currYearIncome = mysqli_fetch_row(DB_QUERY("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='01/01/2022' GROUP BY `Currency`;"));
						$currYearExpences = mysqli_fetch_row(DB_QUERY("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='01/01/2022' GROUP BY `Currency`;"));
						$lastYearIncome = mysqli_fetch_row(DB_QUERY("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='01/01/2021' AND `Created`<='01/01/2022' GROUP BY `Currency`;"));
						$lastYearExpences = mysqli_fetch_row(DB_QUERY("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='01/01/2021' AND `Created`<='01/01/2022' GROUP BY `Currency`;"));
					?>
					<p class="card-text">
						<span>
							<?
								if($currYearIncome[1] == 0 && $currYearExpences[1] == 0) {
									print('NaN');
								} else {
									print($currYearIncome[0] . number_format($currYearIncome[1] - $currYearExpences[1], 2));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastYearIncome[1] == 0 && $lastYearExpences[1] == 0) {
									print('NaN');
								} else {
									print($lastYearIncome[0] . number_format($lastYearIncome[1] - $lastYearExpences[1], 2));
								}
							?>
						</span>
					</p>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body">
					<h5 class="card-title">SALES TODAY</h5>
					<?
						$currYearSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY `Currency`;", date("d/m/Y"))));
						$lastYearSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", date("d/m/Y")-1, date("d/m/Y"))));
						print(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", date("d/m/Y")-1, date("d/m/Y")));
					?>
					<p class="card-text">
						<span>
							<?
								if($currYearSales[1] == 0) {
									print('NaN');
								} else {
									print($currYearSales[0] . number_format($currYearSales[1], 2));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastYearSales[1] == 0) {
									print('NaN');
								} else {
									print($lastYearSales[0] . number_format($lastYearSales[1], 2));
								}
							?>
						</span>
					</p>
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
			<h3>Sales per day</h3>
			<chart class="ct-sales-day" />
		</div>
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
			</script>
		<div class="col-12 col-lg-6">
			<h3>Income / Profit per day</h3>
			<chart class="ct-money-day" />
		</div>
			<script>
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
	</div>
	<div class="row" name="Website analytics">

	</div>
</section>