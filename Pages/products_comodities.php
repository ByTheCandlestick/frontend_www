<?

?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Products</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 col-lg-6 d-flex justify-content-end align-items-center p-0">
				</div>
				<div class="col-12 col-lg-6">
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Containers
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Container/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="containersTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_containers` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Container/'.$row['ID'].'">
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
                    <a href="/Products/Containers/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Wicks
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Wick/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wicksTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_wicks` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Wick stands
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/WickStand/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_wickstands` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Materials
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Material/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col">Price (cl)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_materials` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Fragrances
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Fragrance/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col">Price (cl)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_fragrances` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Colours
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Colour/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col">Price (cl)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_colours` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Packagings
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Packaging/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_packagings` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Shippings
                    </div>
                    <div class="col-4 text-end">
                        <a href="/Products/Shipping/New/" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto" style="max-height: 18rem;">
                    <table class="wickstandsTable table table-striped table-hover m-0">
                        <thead class="sticky-top" style="background: var(--section); z-index: unset;">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price (ea)</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `products_materials` LIMIT 25");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
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
<script>
	$(document).ready(function(){
		$(".tableFilter").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$(".comoditiesTable tbody tr").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>