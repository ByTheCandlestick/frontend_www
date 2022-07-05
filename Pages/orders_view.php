<?
	if(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `sales_orders` WHERE `invoice_number`='%s'", QS))) > 0) {
		$invoice = mysqli_fetch_assoc($query);
        $address = DB_Query(sprintf("SELECT * FROM `Users_address` WHERE `id`=%s", $invoice['billto_address']))
?>
    <section>
        <!-- Section Header -->
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>Invoice: <?print(QS)?></h1>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <div class="row">
                    <div class="col-12 col-lg-6 d-block d-md-flex justify-content-end align-items-center p-0">
                    </div>
                    <div class="col-12 col-lg-6">
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Section Body -->
        <div class="row">
            <div class="col-12 col-lg-6" name="title">
                <div class="form-floating mb-3">
                    <textarea type="text" class="form-control" id="floatingInput" rows="6" value="<? print($invoice['number'].$invoice['line_1'].PHP_EOL.$invoice['line_2'].PHP_EOL.$invoice['town'].PHP_EOL.$invoice['county'].PHP_EOL.$invoice['postcode'].PHP_EOL.$invoice['country'])?>"></textarea>
                    <label for="floatingInput">Delivery address</label>
                </div>
            </div>
        </div>
    </section>
<?
    } else {
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Invoice not found.</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
			<button class="btn btn-outline-primary col-12 col-md-3 col-lg-1" onclick="history.go(-1)">Go back</buton>
		</div>
	</section>
<?
	}
?>