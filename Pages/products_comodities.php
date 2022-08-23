<?

?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Comodities</h1>
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
	<div class="row overflow-scroll">
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Containers</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['adm_access-products-containers-edit']==1) {?>
                            <a href="/Products/Container/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="containersTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_containers` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                        ')
                                        if($userperm['adm_access-products-comodities-edit']==1) {
                                            print('
                                                    <a href="/Products/Container/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                            ')
                                        }
                                        print('
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Containers/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Wicks</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['adm_access-products-wicks-edit']==1) {?>
                            <a href="/Products/Wick/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wicksTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_wicks` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Wick/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Wicks/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Wick stands</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['adm_access-products-wickstands-edit']==1) {?>
                            <a href="/Products/WickStand/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_wickstands` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Product/WickStand/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/WickStands/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Materials</h4>
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Material/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col">Price (cl)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_materials` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>'.$row['Price (cl)'].'</td>
                                                <td>
                                                    <a href="/Products/Material/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Materials/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Fragrances</h4>
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Fragrance/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col">Price (cl)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_fragrances` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>'.$row['Price (cl)'].'</td>
                                                <td>
                                                    <a href="/Products/Material/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Fragrances/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Colours</h4>
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Colour/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col">Price (cl)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_colours` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>'.$row['Price (cl)'].'</td>
                                                <td>
                                                    <a href="/Products/Material/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Colours/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Packagings</h4>
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Packaging/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_packagings` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Material/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Packagings/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Shippings</h4>
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Shipping/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_materials` LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Shipping/'.$row['ID'].'">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        ');
                                    }
                                } else {
                                    print('
                                        <tr>
                                            <th scope="row"></th>
                                            <td>No data found</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    ');
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-muted">
                    <a href="/Products/Shippings/">
                        See more
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>