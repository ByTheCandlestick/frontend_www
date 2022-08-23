<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if($_POST['payload']) { // Only respond to POST requests from Github
			$payload = json_decode($_POST['payload'], true);
			define("GIT_PROT",		"https");
			define("GIT_USER",		"azurrr");
			define("GIT_PKEY",		"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");
			define("GIT_ADDR",		"github.com");
			define("COMPANY",		$payload['repository']['owner']['name']);
			define("REPO",			$payload['repository']['name']);
			define("BRANCH",		substr($payload['ref'], 11));
			define("REMOTE_LINK",	GIT_PROT."://".GIT_USER.":".GIT_PKEY."@". GIT_ADDR."/".COMPANY."/".REPO.".git");
			define("ROOT",			"/kunden/homepages/36/d908228976/htdocs");
			define("REPOSITORY",	ROOT."/".BRANCH."/".REPO);
			define("BRANCH_DIR",	ROOT."/".BRANCH);

			if(!file_exists(ROOT)) die("ERROR: ROOT does not exist.");
			if(!file_exists(BRANCH_DIR)) shell_exec("cd ".ROOT." && mkdir ".BRANCH);
			if(!file_exists(REPOSITORY)) {
				shell_exec("cd ".BRANCH_DIR." && git clone ".REMOTE_LINK);
				shell_exec("cd ".BRANCH_DIR." && git checkout -b ".BRANCH);
				shell_exec("cd ".REPOSITORY." && git remote add upstream ".REMOTE_LINK);
				die("Cloned. ".date(DateTime::ISO8601, strtotime('-2 hour')));
			} else {
				shell_exec("cd ".REPOSITORY." && git pull upstream ".BRANCH);
				die("Updated. ".date(DateTime::ISO8601, strtotime('-2 hour')));
			}
		}
	}
	//header("HTTP/1.0 404 Not Found");
	header("HTTP/1.0 200 Success");
	die();
?>