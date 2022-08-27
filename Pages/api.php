<?

?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>API</h1>
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
                        <h4>Allowed Hosts</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['api_access-hosts-edit']==1) {?>
                            <a href="/API/allowed_hosts/New/" class="btn btn-outline-primary">
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
                                <th scope="col">Hostname</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `API Allowed hosts` WHERE `Active?`=1 LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Name'].'</td>
                                                <td>'.$row['Hostname'].'</td>
                                                <td>
                                        ');
                                        if($userperm['api_access-hosts-edit']==1) {
                                            print('
                                                    <a href="/API/allowed_hosts/'.$row['ID'].'">
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
                <div class="card-footer text-muted">
                    <a href="/API/allowed_hosts/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Private Keys</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['api_access-Keys-edit']==1) {?>
                            <a href="/API/keys/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="containersTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">Last used</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT LEFT(`Key` , 7) as 'Key1', RIGHT(`Key` , 5) as 'Key2', `Last used` FROM `API Keys` WHERE `Active?`=1 LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Key1'].'...'.$row['Key2'].'</td>
                                                <td>'.$row['Last used'].'</td>
                                                <td>
                                        ');
                                        if($userperm['api_access-keys-edit']==1) {
                                            print('
                                                    <a href="/API/keys/'.$row['ID'].'">
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
                <div class="card-footer text-muted">
                    <a href="/API/keys/">
                        See more
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Versions</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['api_access-Keys-edit']==1) {?>
                            <a href="/API/keys/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="containersTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Version</th>
                                <th scope="col">Public?</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `API Versions` WHERE `Active?`=1 LIMIT 7");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Version'].'</td>
                                                <td>'.$row['Public?'].'</td>
                                                <td>
                                        ');
                                        if($userperm['api_access-keys-edit']==1) {
                                            print('
                                                    <a href="/API/keys/'.$row['ID'].'">
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
                <div class="card-footer text-muted">
                    <a href="/API/Versions/">
                        See more
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>