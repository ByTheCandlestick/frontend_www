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
			array_push($days, substr($days_b[$i], 0, 3));
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
		$currMonth	= date("Y-d-m", mktime(0, 0, 0, 1, date('m'), date('Y')));
		$lastMonth	= date("Y-d-m", mktime(0, 0, 0, 1, date('m')-1, date('Y')));
		$currYear	= date("Y-d-m", mktime(0, 0, 0, 1, 1, date('Y')));
		$lastYear	= date("Y-d-m", mktime(0, 0, 0, 1, 1, date('Y')-1));
	// Gets all sales and refund info 
		$currYearIncome		= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Shipping status`=4 GROUP BY 1) as a;", $currYear)));
		$currYearExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Shipping status`=4 GROUP BY 1) as a;", $currYear)));
		$lastYearIncome		= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<'%s' AND `Shipping status`=4 GROUP BY 1) as a;", $lastYear, $currYear)));
		$lastYearExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<'%s' AND `Shipping status`=4 GROUP BY 1) as a;", $lastYear, $currYear)));

		$currMonthIncome	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Shipping status`=4 GROUP BY 1) as a;", $currMonth)));
		$currMonthExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Shipping status`=4 GROUP BY 1) as a;", $currMonth)));
		$lastMonthIncome	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<'%s' AND `Shipping status`=4 GROUP BY 1) as a;", $lastMonth, $currMonth)));
		$lastMonthExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<'%s' AND `Shipping status`=4 GROUP BY 1) as a;", $lastMonth, $currMonth)));
?>
<section>
	<!-- Section Body -->
	<div class="row" name="Sales snippets">
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body row">
					<h5 class="col-12 card-title">YEARLY SALES</h5>
					<div class="col-7">
						<p class="card-text">
							<span>
								Current: 
								<?
									if($currYearIncome[1] == 0) {
										print('NaN');
									} else {
										$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currYearIncome[0] );
										print($fmt->format($currYearIncome[1], 2));
									}
								?>
							</span>
							</br>
							<span>
								Last: 
								<?
									if($lastYearIncome[1] == 0) {
										print('NaN');
									} else {
										$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastYearIncome[0] );
										print($fmt->format($lastYearIncome[1], 2));
									}
								?>
							</span>
						</p>
					</div>
					<div class="col-5 text-end">
						<h3>
							<?
								if($lastYearIncome[1] == $currYearIncome[1]) {
									print('<i class="far fa-hyphen"></i>');
								} elseif($lastYearIncome[1] == 0) {
									print('<i class="far fa-infinity"></i>');
								} else {
									print(number_format(((($currYearIncome[1] - $lastYearIncome[1])/$lastYearIncome[1])*100), 2));
								}
							?>%
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body row">
					<h5 class="col-12 card-title">MONTHLY SALES</h5>
					<div class="col-7">
						<p class="card-text row">
							<span>
								Current: 
								<?
									if($currMonthIncome[1] == 0) {
										print('NaN');
									} else {
										$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currMonthIncome[0] );
										print($fmt->format($currMonthIncome[1], 2));
									}
								?>
							</span>
							</br>
							<span>
								Last: 
								<?
									if($lastMonthIncome[1] == 0) {
										print('NaN');
									} else {
										$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $lastMonthIncome[0] );
										print($fmt->format($lastMonthIncome[1], 2));
									}
								?>
							</span>
						</p>
					</div>
					<div class="col-5 text-end">
						<h3>
							<?
								if($lastMonthIncome[1] == $currMonthIncome[1]) {
									print('<i class="far fa-hyphen"></i>');
								} elseif($lastMonthIncome[1] == 0) {
									print('<i class="far fa-infinity"></i>');
								} else {
									print(number_format(((($currMonthIncome[1]-$lastMonthIncome[1])/$lastMonthIncome[1])*100), 2));
								}
							?>%
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body row">
					<h5 class="col-12 card-title">OPEN ORDERS</h5>
					<div class="col-7">
						<p class="card-text">
							<span>
								<?=(mysqli_fetch_row(DB_QUERY("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order' AND `Shipping status`=0"))[0])?> To be acknowleged
							</span>
							</br>
							<span>
								<?=(mysqli_fetch_row(DB_QUERY("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order' AND `Shipping status`=1"))[0])?> To be Assembled
							</span>
							</br>
							<span>
								<?=(mysqli_fetch_row(DB_QUERY("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order' AND `Shipping status`=2"))[0])?> To be shipped
							</span>
							</br>
							<span>
								<?=(mysqli_fetch_row(DB_QUERY("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order' AND `Shipping status`=3"))[0])?> To be Delivered
							</span>
						</p>
					</div>
					<div class="col-5 text-end">
						<h3>
							<?
								if(mysqli_fetch_row(DB_QUERY("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order' AND `Shipping status`<4"))[0] < 10) {
									print('<i class="text-primary fad fa-2x fa-circle-exclamation"></i>');
								} elseif(mysqli_fetch_row(DB_QUERY("SELECT COUNT(*) FROM `Transactions` WHERE `Type`='Order' AND `Shipping status`<4"))[0] < 20) {
									print('<i class="text-warning fad fa-2x fa-triangle-exclamation"></i>');
								} else {
									print('<i class="text-danger fad fa-2x fa-hexagon-exclamation"></i>');
								}
							?>
						</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-3 p-2">
			<div class="card h-100">
				<div class="card-body row">
					<h5 class="col-12 card-title">UNRESOLVED COMPLAINTS</h5>
					<div class="col-7">
						<p class="card-text row">
							<span>
								<?
									if($currMonthIncome[1] == 0 && $currMonthExpences[1] == 0) {
										print('NaN');
									} else {
										$fmt->setTextAttribute( $fmt::CURRENCY_CODE, $currMonthIncome[0] );
										print($fmt->format($currMonthIncome[1] - $currMonthExpences[1], 2));
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
										print($fmt->format($lastMonthIncome[1] - $lastMonthExpences[1], 2));
									}
								?>
							</span>
						</p>
					</div>
					<div class="col-5 text-end">
						<h3>
							<?=(number_format($lastMonthIncome[1] - $lastMonthExpences[1], 2) == 0)?'<i class="far fa-infinity"></i>':((number_format($currMonthIncome[1] - $currMonthExpences[1], 2) - number_format($lastMonthIncome[1] - $lastMonthExpences[1], 2)) / number_format($lastMonthIncome[1] - $lastMonthExpences[1], 2)) * 100;?>%
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" name="Sales / day">
		<div class="col-12 col-lg-6">
			<h3>Sales this week</h3>
			<chart class="monetary ct-sales-day d-block h-100" />
		</div>
		<script>
			new Chartist.Line('.ct-sales-day', {
				labels: ['<?=(implode('\', \'', $days))?>'],
				series: [
					[<?=(implode(', ', $dailySales))?>]
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
			<chart class="monetary ct-sales-month d-block h-100" />
		</div>
		<script>
			new Chartist.Line('.ct-sales-month', {
				labels: ['<?=(implode('\', \'', $months))?>'],
				series: [
					[<?=(implode(', ', $monthlySales))?>]
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
</section>