<?php
	function getWebsite($data) {
		if (isset($data['id'])) {
			return getWebsite($data['id']);
		} else {
			return array('error' => 'Website ID not provided');
		}
	}

	function createWebsite($data) {
		// TODO: Implement function
	}

	function updateWebsite($data) {
		// TODO: Implement function
	}

	function deleteWebsite($data) {
		// TODO: Implement function
	}
?>