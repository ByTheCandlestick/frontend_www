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
		for($i=0; $i<7; $i++) {
			if(isset($dailySales_raw[$i])) {
				array_push($dailySales, $dailySales_raw[$i][1]);
			} else {
				array_unshift($dailySales, 0);
			}
		}
	// Gets all sales data from the last 12 months
		$monthlySales = array();
		$monthlySales_raw = mysqli_fetch_all(DB_QUERY("SELECT date_format(`Created`,'%Y-%m'), SUM(`Deposit`) FROM `Transactions` GROUP BY 1 ORDER BY 1 ASC LIMIT 12"));
		for($i=0; $i<12; $i++) {
			if(isset($monthlySales_raw[$i])) {
				array_push($monthlySales, $monthlySales_raw[$i][1]);
			} else {
				array_unshift($monthlySales, 0);
			}
		}
	// Gets current and last year / month
		$currMonth	= date("Y-m-d", mktime(0, 0, 0, 1, date('m'), date('Y')));
		$lastMonth	= date("Y-m-d", mktime(0, 0, 0, 1, date('m')-1, date('Y')));
		$currYear	= date("Y-m-d", mktime(0, 0, 0, 1, 1, date('Y')));
		$lastYear	= date("Y-m-d", mktime(0, 0, 0, 1, 1, date('Y')-1));
	// Gets all sales and refund info 
		$currYearIncome		= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY 1) as a;", $currYear)));
		$currYearExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' GROUP BY 1) as a;", $currYear)));
		$lastYearIncome		= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastYear, $currYear)));
		$lastYearExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastYear, $currYear)));
		$currMonthIncome	= mysqli_fetch_row(DB_QUERY($print = sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY 1) as a;", $currMonth)));
		$currMonthExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' GROUP BY 1) as a;", $currMonth)));
		$lastMonthIncome	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastMonth, $currMonth)));
		$lastMonthExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastMonth, $currMonth)));
		print_r($print);
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
					<p class="card-text">
						<span>
							<?
								if($currYearIncome[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currYearIncome[0] );
									print($fmt->format(number_format($currYearIncome[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastYearIncome[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastYearIncome[0] );
									print($fmt->format(number_format($lastYearIncome[1], 2)));
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
					<h5 class="card-title">INCOME YoY</h5>
					<p class="card-text">
						<span>
							<?
								if($currYearIncome[1] == 0 && $currYearExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currYearIncome[0] );
									print($fmt->format(number_format($currYearIncome[1] - $currYearExpences[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastYearIncome[1] == 0 && $lastYearExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastYearIncome[0] );
									print($fmt->format(number_format($lastYearIncome[1] - $lastYearExpences[1], 2)));
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
					<p class="card-text">
						<span>
							<?
								if($currMonthIncome[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currMonthIncome[0] );
									print($fmt->format(number_format($currMonthIncome[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastMonthIncome[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastMonthIncome[0] );
									print($fmt->format(number_format($lastMonthIncome[1], 2)));
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
					<h5 class="card-title">INCOME MoM</h5>
					<p class="card-text">
						<span>
							<?
								if($currMonthIncome[1] == 0 && $currMonthExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currMonthIncome[0] );
									print($fmt->format(number_format($currMonthIncome[1] - $currMonthExpences[1], 2)));
								}
							?>
						</span>
						</br>
						<span>
							<?
								if($lastMonthIncome[1] == 0 && $lastMonthExpences[1] == 0) {
									print('NaN');
								} else {
									$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastMonthIncome[0] );
									print($fmt->format(number_format($lastMonthIncome[1] - $lastMonthExpences[1], 2)));
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