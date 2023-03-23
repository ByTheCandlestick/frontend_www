<?php
	function getTask($data) {
		if (isset($data['id'])) {
			return getTask($data['id']);
		} else {
			return array('error' => 'Task ID not provided');
		}
	}

	function createTask($data) {
		// TODO: Implement function
	}

	function updateTask($data) {
		// TODO: Implement function
	}

	function deleteTask($data) {
		// TODO: Implement function
	}
?>