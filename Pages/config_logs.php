<?
	function getDirContents(string $dir, string $contains="", array &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path) && strpos($value, $contains)) {
				$results[]= array('File' => $value,'Path' => $path);
			} else if ($value != "." && $value != "..") {
				getDirContents($path, $contains, $results);
			}
		}
		return $results;
	}
?>
<pre>
	<?
		print_r(getDirContents(__ROOT__, '.log'));
	?>
</pre>