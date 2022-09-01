<?

?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12">
			<h1>API</h1>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<?if($userperm['api_access-hosts']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Allowed Hosts</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['api_access-hosts-edit']==1) {?>
                            <a href="/API/host/New/" class="btn btn-outline-primary">
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
                                $query = DB_Query("SELECT * FROM `API Allowed hosts` WHERE `Active?`=1 LIMIT 4");
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
                                                    <a href="/API/host/'.$row['ID'].'">
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
                    <a href="/API/Hosts/">
                        See more
                    </a>
                </div>
            </div>
        </div>
		<?}if($userperm['api_access-keys']==1) {?>
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
                                $query = DB_Query("SELECT LEFT(`Key` , 7) as 'Key1', RIGHT(`Key` , 5) as 'Key2', `Last used` FROM `API Keys` WHERE `Active?`=1 LIMIT 4");
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
                    <a href="/API/Keys/">
                        See more
                    </a>
                </div>
            </div>
        </div>
		<?}if($userperm['api_access-versions']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Versions</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['api_access-versions-edit']==1) {?>
                            <a href="/API/Versions/New/" class="btn btn-outline-primary">
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
                                $query = DB_Query("SELECT * FROM `API Versions` WHERE `Active?`=1 LIMIT 4");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        print('
                                            <tr>
                                                <td>'.$row['Version'].'</td>
                                                <td>'.$row['Public?'].'</td>
                                                <td>
                                        ');
                                        if($userperm['api_access-versions-edit']==1) {
                                            print('
                                                    <a href="/API/Versions/'.$row['ID'].'">
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
		<?}if($userperm['api_access-controllers']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Controllers</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['api_access-controllers-edit']==1) {?>
                            <a href="/API/Controllers/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="containersTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Controller</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `API Controllers` WHERE `Active?`=1 LIMIT 4");
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
                <div class="card-footer text-muted">
                    <a href="/API/Controllers/">
                        See more
                    </a>
                </div>
            </div>
        </div>
		<?}?>
    </div>
</section>