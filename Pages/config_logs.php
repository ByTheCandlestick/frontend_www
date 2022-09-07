<?
	function getDirContents(string $dir, bool $includeBase, string &$remove="", array &$results = array()) {
		if(!$includeBase && $remove!="") $remove=$dir;
		foreach (scandir($dir) as $key => $value) {
			$path = str_replace($remove, "", realpath($dir . DIRECTORY_SEPARATOR . $value));
			if (!is_dir($path) && strpos($value, '.log')) {
					$results[]= array(	'File' => $value,
										'Path' => $path);
				}
			} else if ($value != "." && $value != "..") {
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