<?
	if(QS=="new") {
?>
    <section>
        <!-- Section Header -->
        <div class="row">
            <div class="col-12 col-md-6">
                <h1>Style Edit</h1>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end align-items-center p-0">
                        <a href="javascript:website.style.create();history.go(-1);" class="btn btn-outline-primary m-1">
                            <i class="fa fa-save"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Section Body -->
        <div class="row">
            <h5>Style info</h5>
            <div class="col-12 col-md-6 col-lg-4" name="name">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" value="">
                    <label for="floatingInput">Name</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4" name="location">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" value="">
                    <label for="floatingInput">Location</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4" name="importance">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="" value="">
                    <label for="floatingInput">Importance</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4" name="status">
                <div class="form-floating mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="preload" id="flexCheck">
                        <label class="form-check-label" for="flexCheck"> Preload? </label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="available" id="flexCheck">
                        <label class="form-check-label" for="flexCheck"> Active? </label>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?
	} elseif(mysqli_num_rows($query = DB_Query(sprintf("SELECT * FROM `page_styles` WHERE `ID`=%s", QS))) > 0) {
		$style = mysqli_fetch_assoc($query);
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Style Edit</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:website.style.save(<?print(QS)?>);history.go(-1);" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
			</div>
		</div>
		<hr>
		<!-- Section Body -->
		<div class="row">
            <h5>Style info</h5>
            <div class="col-12 col-md-6 col-lg-4" name="name">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="<? print(($style['Name']=='')?'No name was set':'')?>" value="<? print(($style['Name']=='')?'':$style['Name'])?>">
                    <label for="floatingInput">Name</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4" name="location">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="<? print(($style['Location']=='')?'No title was set':'')?>" value="<? print(($style['Location']=='')?'':$style['Location'])?>">
                    <label for="floatingInput">Location</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4" name="page_url">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="<? print(($style['Importance']=='')?'No base URL was set':'')?>" value="<? print(($style['Importance']=='')?'':$style['Importance'])?>">
                    <label for="floatingInput">Importance</label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4" name="status">
                <div class="form-floating mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="available" id="flexCheck" <?($style['Active']==1)?print("checked"):print("")?>>
                        <label class="form-check-label" for="flexCheck"> Active? </label>
                    </div>
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
				<h1>Website page not found.</h1>
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