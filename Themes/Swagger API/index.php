<?
	if(QS_PAGE != "" && file_exists($dash = './API/'.QS_PAGE.'/dashboard.php')) {
		if(QS_SUBPAGE != "") {
			// Include the base files
				require_once('./API/'.QS_PAGE.'/Base/Bootstrap.php');
				require_once('./API/'.QS_PAGE.'/Base/BaseController.php');
				require_once('./API/'.QS_PAGE.'/Base/BaseModel.php');
				print_r($uri);
			// API Functions
				require_once("./API/$uri[0]/Models/$uri[1]Model.php");
				require_once("./API/$uri[0]/Controllers/$uri[1]Controller.php");
				require_once("./API/$uri[0]/Contexts/$uri[1]Context.php");
		} else {
			// Display the swagger api dashboard
				require_once($dash);
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
		echo json_encode($return);
	}
?>