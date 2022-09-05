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
		$currYearIncome		= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY 1) as a;", $currYear)));
		$currYearExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' GROUP BY 1) as a;", $currYear)));
		$lastYearIncome		= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastYear, $currYear)));
		$lastYearExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastYear, $currYear)));
		$currMonthIncome	= mysqli_fetch_row(DB_QUERY( sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' GROUP BY 1) as a;", $currMonth)));
		$currMonthExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' GROUP BY 1) as a;", $currMonth)));
		$lastMonthIncome	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Order' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastMonth, $currMonth)));
		$lastMonthExpences	= mysqli_fetch_row(DB_QUERY(sprintf("SELECT a.Curr AS 'Currency', SUM(a.Depo) AS 'Value' FROM (SELECT `Currency` AS Curr, SUM(`Deposit`) AS Depo FROM `Transactions` WHERE `Type`='Refund' AND `Created`>='%s' AND `Created`<'%s' GROUP BY 1) as a;", $lastMonth, $currMonth)));
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Analytics</h1>
			<p class="text-warning">Warning: This page is currently in development and does not hold any accurate values.</p>
		</div>
		<div class="col-12 col-md-6 text-md-end">
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<div class="col-12 col-md-6">
			<div class="row">
				<h3>Pages</h3>
				<div class="col-12 col-md-6 h-100">
					<h5>Page referrers</h5>
					<chart class="ct-page-referrers" />
					<script>
						new Chartist.Line('.ct-page-referrers', {
							labels: ['<?print(implode('\', \'', $days))?>'],
							series: [
								[0,1,2,3,4,5,6],
								[1,2,3,4,5,6,7],
								[2,3,4,5,6,7,8],
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
				<div class="col-12 col-md-6 h-100">
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
		</div>
		<div class="col-12 col-md-6">
			<div class="row">
				<h3>Products</h3>
				<div class="col-12 col-md-6 h-100">
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
				<div class="col-12 col-md-6 h-100">
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
		</div>
		<div class="col-12 col-md-6">
			<div class="row">
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
		<div class="col-12 col-md-6">
			<div class="row">
				<h3>Sales</h3>
				<div class="col-12 col-md-6">
					<h5>Sales this week</h3>
					<chart class="monetary ct-sales-day d-block h-100" />
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
				</div>
				<div class="col-12 col-md-6">
					<h3>Sales This year</h3>
					<chart class="monetary ct-sales-month d-block h-100" />
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
			</div>
		</div>
	</div>
</section>