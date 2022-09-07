<?
	function getDirContents(string $dir, bool $includeBase, &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				($includeBase)? $results[]='FILE: '.$path: $results[]='FILE: '.$value;
			} else if ($value != "." && $value != "..") {
				($includeBase)? $results[]='PATH: '.$path: $results[]='PATH: '.$value;
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