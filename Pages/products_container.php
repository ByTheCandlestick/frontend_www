<?
    $query = DB_Query(sprintf("SELECT * FROM `products_containers` WHERE `ID`=%s", QS));
    if(strtolower(QS) == "new") {
?>
    <section>
        <!-- Section Header -->
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>New Container</h1>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <div class="row">
                    <div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
                        <a href="javascript:product.container.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
                            <i class="fa fa-trash-alt"></i>
                        </a>
                        <a href="javascript:product.container.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
                            <i class="fa fa-save"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Section Body -->
        <div class="row ContainerInfo">
            <div class="col-12 col-md-6 col-lg-2" name="reference">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="">
                    <label for="floatingInput">Reference</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3" name="name">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="">
                    <label for="floatingInput">Name</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3" name="email">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="">
                    <label for="floatingInput">Email</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2" name="phone">
                <div class="form-floating mb-3">
                    <input type="tel" class="form-control" id="floatingInput" placeholder="">
                    <label for="floatingInput">Phone</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-2" name="status">
                <div class="form-floating mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="active" id="flexCheck">
                        <label class="form-check-label" for="flexCheck"> Active? </label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3" name="hours">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="">
                    <label for="floatingInput">Opening hours</label>
                </div>
            </div>
        </div>
    </section>
<?  } elseif(mysqli_num_rows($query) > 0) {
        $cont = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Edit container</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-block d-md-flex justify-content-end align-items-center p-0">
						<a href="javascript:product.container.delete(<?print(QS)?>);" class="btn btn-outline-danger m-1">
							<i class="fa fa-trash-alt"></i>
						</a>
						<a href="javascript:product.container.update(<?print(QS)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row SupplierInfo">
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Name'])?>">
					<label for="floatingInput">Name</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="email">
				<div class="form-floating mb-3">
					<input type="email" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Email'])?>">
					<label for="floatingInput">Email</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="phone">
				<div class="form-floating mb-3">
					<input type="tel" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Phone'])?>">
					<label for="floatingInput">Phone</label>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-2" name="status">
				<div class="form-floating mb-3">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" name="active" id="flexCheck" <?($cont['Active']==1)?print("checked"):print("")?>>
						<label class="form-check-label" for="flexCheck"> Active? </label>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3" name="hours">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="" value="<?print($cont['Opening Hours'])?>">
					<label for="floatingInput">Opening hours</label>
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
				<h1>Container not found.</h1>
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