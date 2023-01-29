<?

?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12">
			<h1>Blog</h1>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<?if($userperm['adm_access-blog-posts']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>All Posts</h4>
                    </div>
                    <div class="col-4 text-end">
                        <?  if($userperm['adm_access-blog-posts-edit']==1) {?>
                            <a href="/Blog/Post/New/" class="btn btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </a>
                        <?}?>
                    </div>
                </div>
                <div class="card-body p-0 overflow-auto">
                    <table class="containersTable table table-striped table-hover m-0">
                        <thead class="sticky-top">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">User</th>
                                <th scope="col">Timestamp</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                                $query = DB_Query("SELECT * FROM `Blog posts` WHERE `Active?`=1 LIMIT 4");
                                if(mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        ($row['Timestamp'] == $row['Scheduled_for']) $scheduled='checked' : $scheduled='' ;
                                        print('
                                            <tr>
                                                <td>'.$row['Title'].'</td>
                                                <td>
                                                    <a href="/Users/View/'.$row['UID'].'/">
                                                        '.$users[$row['UID']]['Username'].'
                                                    </a>
                                                </td>
                                                <td>'.$row['Timestamp'].'</td>
                                                <td><input type="checkbox"'.$scheduled.'></td>
                                                <td>
                                        ');
                                        if($userperm['adm_access-blog-posts-edit']==1) {
                                            print('
                                                    <a href="/Blog/Post/'.$row['ID'].'">
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
		<?}if($userperm['adm_access-blog-interactions']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Recent Comments</h4>
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
                                                    <a href="/API/key/'.$row['ID'].'">
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
		<?}if($userperm['adm_access-blog-interactions']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Recent reactions</h4>
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
                                                    <a href="/API/Version/'.$row['ID'].'">
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
		<?}if($userperm['adm_access-blog-reports']==1) {?>
        <div class="col-12 col-md-6 col-lg-4 p-2">
            <div class="card h-auto h-md-100">
                <div class="card-header row m-0">
                    <div class="col-8">
                        <h4>Recent Flags</h4>
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