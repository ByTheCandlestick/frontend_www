<?
	if($secext == 'all') {
		$title = 'OUR PARTNERS';
		$sql = "SELECT * FROM `partners` WHERE `public`=1 AND `active`=1";
	} else {
		$title = strtoupper($secext).' PARTNERS.';
		$sql = "SELECT * FROM `partners` WHERE `categories`='$secext' AND `public`=1 AND `active`=1 LIMIT 1";
	}
?>
<div class="container-fluid py-5">
	<div class="row justify-content-center">
		<h5 class="text-center"><?echo $title ?></h5>
		<!-- :: PARTNERS SLIDER SLIM :: -->
		<div class="row boutique partners-slider-slim">
			<?
				if($result = DB_Query($sql)){
					while($row = mysqli_fetch_array($result)){
						$part_image = $row['logo_url'];
						$part_slug = $row['slug'];
						$part_name = $row['name'];
						$part_rating = $row['rating'];
						print('
							<li class="partner-list-item">
								<article class="partner">
									<div class="partner-image">
										<picture>
											<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpeg/" type="image/jpeg"/>
											<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpg/" type="image/jpg"/>
											<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/png/" type="image/png"/>
											<source srcset="'.__API__.'/Images/fetch/'. $part_image .'/jpx/" type="image/jpx"/>
											<img src="'.__API__.'/Images/fetch/'. $part_image .'/webp/" type="image/webp" width="100%" height="auto">
										</picture>
									</div>
									<div class="partner-content">
										<h3 class="partner-title">'. $part_name .'</h3>
										<div class="partner-rating">
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 0)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 1)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 2)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 3)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
											<svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="'.(($part_rating > 4)?'currentColor' : null).'" viewBox="0 0 256 256">
												<rect width="256" height="256" fill="none"></rect>
												<path d="M239.166,97.41117A16.37036,16.37036,0,0,0,224.63477,86.044l-59.39063-4.15625L143.21289,26.41117A16.33117,16.33117,0,0,0,127.99414,15.9971h-.01562A16.324,16.324,0,0,0,112.791,26.41117L90.43164,82.208,31.36914,86.044A16.37036,16.37036,0,0,0,16.83789,97.41117a16.68222,16.68222,0,0,0,5.15625,18.0625l45.4375,38.40625L53.916,207.044a18.37492,18.37492,0,0,0,7.01562,19.51562,17.83088,17.83088,0,0,0,20.0625.625l46.875-29.69531c.0625-.04687.125-.07812.26563,0l50.4375,31.95313a16.14026,16.14026,0,0,0,18.20312-.5625,16.64744,16.64744,0,0,0,6.35938-17.67969L188.77539,153.1221l45.23438-37.64843A16.68222,16.68222,0,0,0,239.166,97.41117Z"></path>
											</svg>
										</div>
										<div class="partner-info">
											<div class="partner-btn-group">
												<a href="/Boutique/Partner/'.$part_slug.'/" class="partner-btn" tabindex="-1">
													<i class="fad fa-info-circle"></i>
												</a>
											</div>
										</div>
									</div>
								</article>
							</li>
						');
					}
				} else {
					echo 'ERROR: UNABLE TO COLLECT PARTNER DATA';
				}
			?>
		</div>
	</div>
</div>

<?
	$row=$sql=null;
?>