<div class="row px-4 py-2 text-center">
	<h5>
		<?
			$text = $partner['About long'];
			$text = str_replace('/n', '</br>', $text);
			$text = str_replace('/r', '</br>', $text);
			print($text);
		?>
	</h5>
</div>