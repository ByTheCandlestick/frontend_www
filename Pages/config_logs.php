<?
	function getDirContents($dir, &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[] = 'PATH: '.$value;
			} else if ($value != "." && $value != "..") {
				getDirContents($path, $results);
				$results[] = 'FILE: '.$value;
			}
		}

		return $results;
	}
?>
<pre>
<?
	print_r(getDirContents('/'));
?>
</pre>