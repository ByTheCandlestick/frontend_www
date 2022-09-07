<?
	function getDirContents(string $dir, bool $includeBase, string $remove="", &$results = array()) {
		if(!$includeBase) $remove = $dir
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[]='FILE: '.$path;
			} else if ($value != "." && $value != "..") {
				$results[]='PATH: '.$path;
				getDirContents($path, true, $remove, $results);
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