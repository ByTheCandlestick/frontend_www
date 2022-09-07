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
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Options</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01">
    <option selected>Choose...</option>
	<?
		$logs = getDirContents(__ROOT__, '.log');
		foreach($logs as $log) {
			print_r("<option selected value=\"$log[1]\">$log[0]</option>");
		}
	?>
  </select>
</div>