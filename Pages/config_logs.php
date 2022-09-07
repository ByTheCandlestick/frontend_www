<?
	function getDirContents($dir, &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[] = 'PATH: '.$path;
			} else if ($value != "." && $value != "..") {
				getDirContents($path, $results);
				$results[] = 'FILE: '.$path;
			}
		}

		return $results;
	}
?>
<pre>
<?
	print_r(getDirContents(__ROOT__));
?>
</pre>