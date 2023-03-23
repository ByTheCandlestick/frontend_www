<?php
	function getUser($data) {
		if (isset($data['id'])) {
			return getUser($data['id']);
		} else {
			return array('error' => 'User ID not provided');
		}
	}

	function createUser($data) {
		// TODO: Implement function
	}

	function updateUser($data) {
		// TODO: Implement function
	}

	function deleteUser($data) {
		// TODO: Implement function
	}
?>