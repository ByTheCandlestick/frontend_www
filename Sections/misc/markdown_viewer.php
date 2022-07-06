<?
	require_once(__ROOT__.'/Vendor/parsesdown.php');
	require_once(__ROOT__.'/Vendor/parsedownExtra.php');
	$Parsedown = new ParsedownExtra();
	if($secext != "") {
		if(file_exists(__ROOT__.'/assets/markdown/'.$secext.'.md')) {
			$file = file_get_contents(__ROOT__.'/assets/markdown/'.$secext.'.md');
		} else {
			$file = '# No file specified';
		}
	} else if(QS_SUBPAGE !== NULL) {
		if(file_exists(__ROOT__.'/assets/markdown/'.QS_SUBPAGE.'.md')) {
			$file = file_get_contents(__ROOT__.'/assets/markdown/'.QS_SUBPAGE.'.md');
		} else {
			$file = '# No file specified';
		}
	}
?>
<div class="container py-5">
	<?
		print($Parsedown->text($file));
	?>
</div>