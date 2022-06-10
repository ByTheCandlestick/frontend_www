<div class="container-fluid py-5" style="background: #314648; color: white;">
	<div class="row justify-content-center">
		<!-- :: FEATURED IN DATABASE :: -->
			<?
				(isset($secext))?NULL:$secext=1;
				if($result = DB_Query("SELECT * FROM `section_CTAs` WHERE `id`='$secext' AND `type`='features' AND `active`=1")){
					while($row = mysqli_fetch_array($result)){
						echo '	<h3 class="text-center">'.$row['title'].'</h3>
								<h6 class="text-center">'.$row['subtitle'].'</h6>
								<style>
								.fa-'.$row['icon1'].'.icon1::before { color: '.$row['icon1_colour_before'].'; }
								.fa-'.$row['icon1'].'.icon1::after { color: '.$row['icon1_colour_after'].'; }

								.fa-'.$row['icon2'].'.icon2::before { color: '.$row['icon2_colour_before'].'; }
								.fa-'.$row['icon2'].'.icon2::after { color: '.$row['icon2_colour_after'].'; }

								.fa-'.$row['icon3'].'.icon3::before { color: '.$row['icon3_colour_before'].'; }
								.fa-'.$row['icon3'].'.icon3::after { color: '.$row['icon3_colour_after'].'; }
								</style>
								<div class="row">
									<div class="col-sm-1 col-md-4 col-lg-3 text-center offset-lg-1 p-4">
										<div class="row d-block"><i class="fad fa-6x fa-'.$row['icon1'].' icon1"></i></div>
										</br>
										<div class="row d-block">'.$row['icon1_text'].'</div>
									</div>
									<div class="col-sm-1 col-md-4 col-lg-4 text-center p-4">
										<div class="row d-block"><i class="fad fa-6x fa-'.$row['icon2'].' icon2"></i></div>
										</br>
										<div class="row d-block">'.$row['icon2_text'].'</div>
									</div>
									<div class="col-sm-1 col-md-4 col-lg-3 text-center p-4">
										<div class="row d-block"><i class="fad fa-6x fa-'.$row['icon3'].' icon3"></i></div>
										</br>
										<div class="row d-block">'.$row['icon3_text'].'</div>
									</div>
								</div>';
					}
				}
			?>
	</div>
</div>