<?
	// Currencies
		$fmt = new \NumberFormatter( 'en', \NumberFormatter::CURRENCY);
		$fmt->setAttribute( $fmt::FRACTION_DIGITS, 2 );
	// List of all days from today backwards 1 week
		$days = $days_b = array();
		for ($i = 0; $i < 7; $i++){
			array_push($days_b, date('l', $day));
			$day = strtotime('yesterday', $day);
		}
		for ($i=count($days_b)-1; $i>=0; $i--) {
			array_push($days, $days_b[$i]);
		}
	// List of all Months from this month backwards 1 week
		$months = $months_b = array();
		for ($i = 0; $i < 12; $i++){
			array_push($months_b, date('M', $month));
			$month = strtotime('last month', $month);
		}
		for($i=count($months_b)-1; $i>=0; $i--) {
			array_push($months, $months_b[$i]);
		}
	// Gets all sales data for the last 7 days
		$dailySales = array();
		$dailySales_raw = mysqli_fetch_all(DB_QUERY("SELECT date_format(`Created`,'%Y-%m-%d'), SUM(`Deposit`) FROM `Transactions` GROUP BY 1 ORDER BY 1 ASC LIMIT 7"));
		for($i=1; $i<8; $i++) {
			if(isset($dailySales_raw[$i])) {
				array_push($dailySales, $dailySales_raw[$i][1]);
			} else {
				array_unshift($dailySales, 0);
			}
		}
	// Gets all sales data from the last 12 months
		$monthlySales = array();
		$monthlySales_raw = mysqli_fetch_all(DB_QUERY("SELECT date_format(`Created`,'%Y-%m'), SUM(`Deposit`) FROM `Transactions` GROUP BY 1 ORDER BY 1 ASC LIMIT 12"));
		for($i=1; $i<13; $i++) {
			if(isset($monthlySales_raw[$i])) {
				array_push($monthlySales, $monthlySales_raw[$i][1]);
			} else {
				array_unshift($monthlySales, 0);
			}
		}
		print_r($monthlySales);
	// Gets current and last year / month
		$currYear = date("d/m/Y", mktime(0, 0, 0, 1, 1, date('Y')));
		$lastYear = date("d/m/Y", mktime(0, 0, 0, 1, 1, date('Y')-1));
		$currMonth = date("d/m/Y", mktime(0, 0, 0, 1, date('m'), date('Y')));
		$lastMonth = date("d/m/Y", mktime(0, 0, 0, 1, date('m')-1, date('Y')));
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
					<h5 class="card-title">SALES YoY</h5>
					<?
						$currSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='01/01/%d' GROUP BY `Currency`;", date("Y"))));
						$lastSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='01/01/%d' AND `Created`<='01/01/%d' GROUP BY `Currency`;", date("Y")-1, date("Y"))));
					?>
					<p class="card-text">
						<span>
							<?
								if($currSales[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currSales[0] );
									print($fmt->format(number_format($currSales[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastSales[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastSales[0] );
									print($fmt->format(number_format($lastYearSales[1], 2)));
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
						$currIncome = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY `Currency`;", $currYear)));
						$currExpences = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' GROUP BY `Currency`;", $currYear)));
						$lastIncome = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", $lastYear, $currYear)));
						$lastExpences = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", $lastYear, $currYear)));
					?>
					<p class="card-text">
						<span>
							<?
								if($currIncome[1] == 0 && $currExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currIncome[0] );
									print($fmt->format(number_format($currIncome[1] - $currExpences[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastIncome[1] == 0 && $lastExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastIncome[0] );
									print($fmt->format(number_format($lastIncome[1] - $lastExpences[1], 2)));
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
					<h5 class="card-title">SALES MoM</h5>
					<?
						$currSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY `Currency`;", $currMonth)));
						$lastSales = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", $lastMonth, $currMonth)));
					?>
					<p class="card-text">
						<span>
							<?
								if($currSales[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currSales[0] );
									print($fmt->format(number_format($currSales[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastSales[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastSales[0] );
									print($fmt->format(number_format($lastSales[1], 2)));
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
					<h5 class="card-title">GROSS PROFIT MoM</h5>
					<?
						$currIncome = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY `Currency`;", $currMonth)));
						$currExpences = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' GROUP BY `Currency`;", $currMonth)));
						$lastIncome = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", $lastMonth, $currMonth)));
						$lastExpences = mysqli_fetch_row(DB_QUERY(sprintf("SELECT `Currency`, SUM(`Subtotal`) FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<='%s' GROUP BY `Currency`;", $lastMonth, $currMonth)));
					?>
					<p class="card-text">
						<span>
							<?
								if($currIncome[1] == 0 && $currExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currIncome[0] );
									print($fmt->format(number_format($currIncome[1] - $currExpences[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastIncome[1] == 0 && $lastExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastIncome[0] );
									print($fmt->format(number_format($lastIncome[1] - $lastExpences[1], 2)));
								}
							?>
						</span>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row" name="Sales / day">
		<div class="col-12 col-lg-6">
			<h3>Sales this week</h3>
			<chart class="ct-sales-day" />
		</div>
			<script>
				new Chartist.Line('.ct-sales-day', {
					labels: ['<?print(implode('\', \'', $days))?>'],
					series: [
						[<?print(implode(', ', $dailySales))?>]
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
			<h3>Sales This year</h3>
			<chart class="ct-sales-month" />
		</div>
			<script>
				new Chartist.Line('.ct-sales-month', {
					labels: ['<?print(implode('\', \'', $months))?>'],
					series: [
						[<?print(implode(', ', $monthlySales))?>]
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
	<div class="row" name="Sales / Month">
	</div>
</section>