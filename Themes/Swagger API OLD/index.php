<?
	if(QS_PAGE!="index") {
		// Include the base files
		require_once('./API/'.QS_PAGE.'/Base/Bootstrap.php');
		require_once('./API/'.QS_PAGE.'/Base/BaseController.php');
		require_once('./API/'.QS_PAGE.'/Base/BaseModel.php');
		if($uri[1]!="") {
			// API Functions
			require_once("./API/$uri[0]/Models/$uri[1]Model.php");
			require_once("./API/$uri[0]/Controllers/$uri[1]Controller.php");
			require_once("./API/$uri[0]/Core/$uri[1]Context.php");
		} else {
			print('There was an issue with your request. There was also an issue with getting the backup page. Please contact the system admin to repair.');
		}
	} else {
		$return = array(
			"Status" => "error",
			"Description" => "Please choose a version from the list below.",
			"Versions" => array(),
		);
		$fh = opendir("./API");
		while(($entry = readdir($fh)) !== false) {
			if($entry != "." && $entry != "..") {
				array_push($return['Versions'], '/'.$entry.'/');
			}
		}
		fclose($fh);
		print(json_encode($return));
	}
?>