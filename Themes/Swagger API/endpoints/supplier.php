<?php
	function getSupplier($data) {
		if (isset($data['id'])) {
			return getSupplier($data['id']);
		} else {
			return array('error' => 'Supplier ID not provided');
		}
	}

	function createSupplier($data) {
		// TODO: Implement function
	}

	function updateSupplier($data) {
		// TODO: Implement function
	}

	function deleteSupplier($data) {
		// TODO: Implement function
	}
?>