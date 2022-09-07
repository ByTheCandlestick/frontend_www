<?
	function getDirContents($dir, &$results = array()) {
		foreach (scandir($dir) as $key => $value) {
			$path = realpath(DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[] = $path;
			} else if ($value != "." && $value != "..") {
				getDirContents($path, $results);
				$results[] = $path;
			}
		}

		return $results;
	}

	print_r(getDirContents(__ROOT__));
?>