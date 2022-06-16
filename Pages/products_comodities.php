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
                    <div class="col-4">
                        Containers
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="productsTable table table-striped table-hover">
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
                                $query = DB_Query("SELECT * FROM `products_containers` LIMIT 4");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Como/'.$row['ID'].'">
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
                    <a href="">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Containers
                    </div>
                    <div class="col-4">
                        Containers
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="productsTable table table-striped table-hover">
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
                                $query = DB_Query("SELECT * FROM `products_wicks` LIMIT 4");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Como/'.$row['ID'].'">
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
                    <a href="">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 p-2">
            <div class="card">
                <div class="card-header row m-0">
                    <div class="col-8">
                        Containers
                    </div>
                    <div class="col-4">
                        Containers
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="productsTable table table-striped table-hover">
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
                                $query = DB_Query("SELECT * FROM `products_wickStands` LIMIT 4");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <th scope="row">'.$row['ID'].'</th>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Price (ea)'].'</td>
                                                <td>
                                                    <a href="/Products/Como/'.$row['ID'].'">
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
                    <a href="">
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