<?
	function getDirContents(string $dir, &$contains="", &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path) && strpos($value, '.log')) {
				$results[]= array('File' => $value,'Path' => $path);
			} else if ($value != "." && $value != "..") {
				getDirContents($path, $results);
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