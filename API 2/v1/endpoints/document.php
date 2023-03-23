<?php
	function getDocument($data) {
		if (isset($data['id'])) {
			return getDocument($data['id']);
		} else {
			return array('error' => 'Document ID not provided');
		}
	}

	function createDocument($data) {
		// TODO: Implement function
	}

	function updateDocument($data) {
		// TODO: Implement function
	}

	function deleteDocument($data) {
		// TODO: Implement function
	}
?>