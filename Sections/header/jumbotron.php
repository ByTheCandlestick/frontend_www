<?
	if($result = DB_Query(sprintf('SELECT * FROM `Sections  carousel` WHERE `Title`=\'%s\'', $secext))){
		if(mysqli_num_rows($result) > 0) {
			$jumbotron = mysqli_fetch_assoc($result);
			$btn_1 = ($jumbotron['button_1_enabled'])?'<a href="'.$jumbotron['button_1_link'].'" class="btn-get-started animate__animated animate__fadeInUp">'.$jumbotron['button_1_text'].'</a>':'';
			$btn_2 = ($jumbotron['button_1_enabled'])?'<a href="'.$jumbotron['button_2_link'].'" class="btn btn-secondary animate__animated animate__fadeInUp">'.$jumbotron['button_2_text'].'</a>':'';
			$image = $jumbotron['image'];
			$title = $jumbotron['title'];
			$description = $jumbotron['subtitle'];
?>
	<section id="heroJumbotron">
		<div class="Jumbotron-container">
			<div id="Jumbotron">
				<!-- :: JUMBOTRON :: -->
						<?
							print('
								<div class="jumbotron-item" style="background-image: url(\''.__API__.'/Images/fetch/'. $image .'/jpeg/\'), url(\''.__API__.'/Images/fetch/'. $image .'/jpg/\'), url(\''.__API__.'/Images/fetch/'. $image .'/png/\'), url(\''.__API__.'/Images/fetch/'. $image .'/jpx/\'), url(\''.__API__.'/Images/fetch/'. $image .'/webp/\')">
									<div class="jumbotron-container">
										<div class="jumbotron-content container">
											<h2 class="animate__animated animate__fadeInDown">'.$title.'</h2>
											<p class="animate__animated animate__fadeInUp">'.$description.'</p>
											'.$btn_1.'
											'.$btn_2.'
										</div>
									</div>
								</div>
							');
						?>
			</div>
		</div>
	</section>
<?
		} else{
			echo "No records matching your query were found.";
		}
	}
?>