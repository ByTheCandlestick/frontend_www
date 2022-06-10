<?
	if($result = DB_Query('SELECT * FROM `section_carousel`')){
		if(mysqli_num_rows($result) > 0) {
			$slides = mysqli_num_rows($result);
?>
	<section id="heroCarousel">
		<div class="carousel-container">
			<div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
				<div class="carousel-inner" role="listbox">
					<!-- :: CAROUSEL IN DATABASE :: -->
						<?
							while($row = mysqli_fetch_array($result)){
								$btn_1 = ($row['button_1_enabled'])?'<a href="'.$row['button_1_link'].'" class="btn-get-started animate__animated animate__fadeInUp">'.$row['button_1_text'].'</a>':'';
								$btn_2 = ($row['button_2_enabled'])?'<a href="'.$row['button_2_link'].'" class="btn btn-secondary animate__animated animate__fadeInUp">'.$row['button_2_text'].'</a>':'';
								$active = ($row['id']==0)?' active':'';
								$image = $row['image_url'];
								$title = $row['Title'];
								$description = $row['description'];
								echo "	<div class=\"carousel-item $active\" style=\"background-image: url('$image')\">
											<div class=\"carousel-container\">
												<div class=\"carousel-content container\">
													<h2 class=\"animate__animated animate__fadeInDown\">$title</h2>
													<p class=\"animate__animated animate__fadeInUp\">$description</p>
													$btn_1
													$btn_2
												</div>
											</div>
										</div>";
							}
						?>
				</div>
				<ol class="carousel-indicators <?($slides>1)?print(''):print('d-none'); ?>" id="hero-carousel-indicators"></ol>
				<a class="carousel-control-prev <?($slides>1)?print(''):print('d-none'); ?>" href="#heroCarousel" role="button" data-bs-slide="prev">
					<span class="carousel-control-prev-icon fad fa-chevron-left" aria-hidden="true"></span>
				</a>
				<a class="carousel-control-next <?($slides>1)?print(''):print('d-none'); ?>" href="#heroCarousel" role="button" data-bs-slide="next">
					<span class="carousel-control-next-icon fad fa-chevron-right" aria-hidden="true"></span>
				</a>
			</div>
		</div>
	</section>
<?
		} else{
			echo "No records matching your query were found.";
		}
	}
?>