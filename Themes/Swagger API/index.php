<?
	if(QS != "" && file_exists($dash = "./API/${QS}/dashboard.php")) {
		if(QS_PAGE != "") {
			// Include the base files
				require_once("./API/${QS}/base/Bootstrap.php");
				require_once("./API/${QS}/base/BaseController.php");
				require_once("./API/${QS}/base/BaseModel.php");
			// API Functions
				require_once("./API/${QS}/model/${QS_PAGE}Model.php");
				require_once("./API/${QS}/controller/${QS_PAGE}Controller.php");
				require_once("./API/${QS}/context/${QS_PAGE}Context.php");
		} else {
			// Display the swagger api dashboard
				require_once($dash);
		}
	} else {
		header("Location: /Error/404/")
	}
?>