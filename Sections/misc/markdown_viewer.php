<?
	require_once(ROOT.'/classes/parsesdown.php');
	require_once(ROOT.'/classes/parsedownExtra.php');
	$Parsedown = new ParsedownExtra();
	if($secext != "") {
		if(file_exists(ROOT.'/assets/markdown/'.$secext.'.md')) {
			$file = file_get_contents(ROOT.'/assets/markdown/'.$secext.'.md');
		} else {
			$file = '# No file specified';
		}
	} else if(QS_SUBPAGE !== NULL) {
		if(file_exists(ROOT.'/assets/markdown/'.QS_SUBPAGE.'.md')) {
			$file = file_get_contents(ROOT.'/assets/markdown/'.QS_SUBPAGE.'.md');
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