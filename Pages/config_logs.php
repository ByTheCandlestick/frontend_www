<?
	foreach(scandir(__ROOT__) as $file) {
		if (!is_dir(__ROOT__."/$file")) {
			echo $file.'</br>';
		}
	}
?>