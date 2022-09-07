<?
	function getDirContents(string $dir, bool $includeBase, &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[]='FILE: '.$path;
			} else if ($value != "." && $value != "..") {
				$results[]='PATH: '.$path;
				getDirContents($path, true, $results);
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