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
    <label class="input-group-text" for="LogSelect">Logs</label>
  </div>
  <select class="" id="LogSelect">
    <option selected>Choose...</option>
	<?
		print_r($logs = getDirContents(__ROOT__, '.log'));
		foreach($logs as $log) {
			$f=$log['File'];	$p=$log['Path'];
			print_r("<option value=\"$p\">$f</option>");
		}
	?>
  </select>
</div>