<div class="row px-4 py-2">
	<h5>
		<?
			if(isset($extention)) {
				$type = $extention[0];
				if($query = DB_Query("SELECT `text` FROM `texts` WHERE `name`='$type' AND `type`='about' AND `active`=1")) {
					$text = mysqli_fetch_row($query)[0];
					$text = str_replace('\n', '</br></br>', $text);
					$text = str_replace('\r', '</br>', $text);
					print($text);
				}
			} else {
				print('No text set');
			} 
		?>
	</h5>
</div>