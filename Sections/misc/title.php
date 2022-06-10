<div class="row px-4 py-2">
	<h1>
		<?
			if(isset($secext)) {
				if(strpos($secext, '!') === 0) {
					$secext = substr($secext, 1); # Remove the Exclamation mark
					print($secext);
				} elseif($query = DB_Query("SELECT * FROM `shop_texts` where `name`='$secext' AND `type`='title' AND `active`=1")) {
					$row = mysqli_fetch_row($query);
					print($row[0]);
				}
			}
		?>
	</h1>
</div>