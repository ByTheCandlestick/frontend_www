<?
	function getProduct($data) {
		if (isset($data['id'])) {
			return getProduct($data['id']);
		} else {
			return array('error' => 'Product ID not provided');
		}
	}

	function createProduct($data) {
		// TODO: Implement function
	}

	function updateProduct($data) {
		// TODO: Implement function
	}

	function deleteProduct($data) {
		// TODO: Implement function
	}
?>