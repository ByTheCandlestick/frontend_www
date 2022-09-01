<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Controllers</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<?  if($userperm['api_access-controllers-edit']==1) {?>
						<a href="/API/Controller/New/" class="btn btn-outline-primary m-1">
							<i class="fa fa-plus"></i>
						</a>
					<?}?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
        <table class="containersTable table table-striped table-hover m-0">
            <thead class="sticky-top">
                <tr>
                    <th scope="col">Controller</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?
                    $query = DB_Query("SELECT * FROM `API Controllers` WHERE `Active?`=1 LIMIT 7");
                    if(mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            print('
                                <tr>
                                    <td>'.$row['Controller'].'</td>
                                    <td>
                            ');
                            if($userperm['api_access-controllers-edit']==1) {
                                print('
                                        <a href="/API/Controller/'.$row['ID'].'">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                ');
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
                            </tr>
                        ');
                    }
                ?>
            </tbody>
        </table>
	</div>
</section>