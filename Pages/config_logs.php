<?
	function getDirContents(string $dir, bool $includeBase, string $remove="", &$results = array()) {
		if(!$includeBase && !isset($remove)) $remove=$dir;
		foreach (scandir($dir) as $key => $value) {
			$path = str_replace($remove, "", realpath($dir . DIRECTORY_SEPARATOR . $value));
			if (!is_dir($path)) {
				$results[]='FILE: '.$path;
			} else if ($value != "." && $value != "..") {
				$results[]='PATH: '.$path;
				getDirContents($path, $includeBase, $remove, $results);
			}
		}

		return $results;
	}
?>
<pre>
<?
	print_r(getDirContents(__ROOT__, false));
?>
</pre>