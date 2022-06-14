<div class="row">
	<?
		if(isset($secext) && $secext == 'all') {
			//
				if(isset($_GET['p'])){
					$page = $_GET['p'];
				} else {
					$page = 1;
				}
			//
			$query = DB_Query("SELECT * FROM `blog_posts` WHERE `Scheduled_for`<=now() AND `Active`=1 LIMIT 4");
			if(mysqli_num_rows($query) > 0){
				while($row = mysqli_fetch_array($query)) {
					
					echo '
						<!-- Blog post-->
						<div class="card mb-4 col-12 col-md-6">
							<picture>
								<source srcset="'.__API__.'/Images/fetch/'. $row['Image'] .'/jpeg/" type="image/jpeg"/>
								<source srcset="'.__API__.'/Images/fetch/'. $row['Image'] .'/jpg/" type="image/jpg"/>
								<source srcset="'.__API__.'/Images/fetch/'. $row['Image'] .'/png/" type="image/png"/>
								<source srcset="'.__API__.'/Images/fetch/'. $row['Image'] .'/jpx/" type="image/jpx"/>
								<img src="'.__API__.'/Images/fetch/'. $row['Image'] .'/webp/" type="image/webp" width="414px" height="207px">
							</picture>
							<div class="card-body">
								<div class="small text-muted">'.$row['Timestamp'].'</div>
								<h2 class="card-title h4">'.$row['Title'].'</h2>
								<p class="card-text">'.$row['Content'].'</p>
								<a class="btn btn-primary" href="/Post/'.$row['Slug'].'">Read more →</a>
							</div>
						</div>
					';
				}
				// Previous/Next page button
				print('
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
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