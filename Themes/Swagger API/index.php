<?
	if(QS_PAGE != "" && file_exists($dash = "./API/${QS_PAGE}/dashboard.php")) {
		if(QS_SUBPAGE != "") {
			// Include the base files
				require_once("./API/${QS_PAGE}/base/Bootstrap.php");
				require_once("./API/${QS_PAGE}/base/BaseController.php");
				require_once("./API/${QS_PAGE}/base/BaseModel.php");
			// API Functions
				require_once("./API/${QS_PAGE}/model/${QS_SUBPAGE}Model.php");
				require_once("./API/${QS_PAGE}/controller/${QS_SUBPAGE}Controller.php");
				require_once("./API/${QS_PAGE}/context/${QS_SUBPAGE}Context.php");
		} else {
			// Display the swagger api dashboard
				require_once($dash);
		}
	} else {
		print(file_exists($dash = "./API/${QS_PAGE}/dashboard.php"));
	}
?>