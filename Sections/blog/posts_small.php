<div class="row boutique">
	<?
		if(isset($secext) && $secext == 'all') {
			//
				if(isset($_GET['p'])){
					$page = $_GET['p'];
				} else {
					$page = 1;
				}
				$start = ($page - 1) * 4;
				$prd_viewed = $page * 4;
                $total_pages
				$count = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `blog_posts` WHERE `Scheduled_for`<=now() AND `Active`=1"))[0];
			//
			$query = DB_Query("SELECT * FROM `blog_posts` WHERE `Scheduled_for`<=now() AND `Active`=1 LIMIT $start, 4");
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)) {
					
					echo '
						<!-- Blog post-->
						<div class="card mb-4">
							<img class="card-img-top" src="'.$row['Image'].'" alt="..." />
							<div class="card-body">
								<div class="small text-muted">'.$row['Timestamp'].'</div>
								<h2 class="card-title h4">'.$row['Title'].'</h2>
								<p class="card-text">'.$row['Content'].'</p>
								<a class="btn btn-primary" href="#!">Read more →</a>
							</div>
						</div>
					';
				}
				($page > 1)? $prev_status = '': $prev_status = ' disabled';
				($prev_status == '')? $prev_page = "/Boutique/?p=".($page - 1) : $prev_page = "";
				($prd_viewed < $count)? $next_status = '': $next_status = ' disabled';
				($next_status == '')? $next_page = "/Boutique/?p=".($page + 1) : $next_page = "";
				// Previous/Next page button
				print('
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="?p='.($page - 1).'" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="'. ($page + 1) .'s">Older</a></li>
                        </ul>
                    </nav>
				');
			} else {
				echo '
					<li class="product-list-item col-6 col-md-4 col-xl-3">
						<article class="product">
							<div class="product-image">
								<picture>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpeg/" type="image/jpeg"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpg/" type="image/jpg"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/png/" type="image/png"/>
									<source srcset="'.__API__.'/Images/fetch/not_found/jpx/" type="image/jpx"/>
									<img src="'.__API__.'/Images/fetch/not_found/webp/" type="image/webp" width="100%" height="auto">
								</picture>
							</div>
							<div class="product-content">
								<h3 class="product-title">No products yet</h3>
							</div>
						</article>
					</li>
				';
			}
		} else {
			echo 'unset';
		}
	?>
</div>