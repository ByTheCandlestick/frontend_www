<?
	function getCart($data) {
		if (isset($data['id'])) {
			return getCart($data['id']);
		} else {
			return array('error' => 'Cart ID not provided');
		}
	}

	function createCart($data) {
		// TODO: Implement function
	}

	function updateCart($data) {
		// TODO: Implement function
	}

	function deleteCart($data) {
		// TODO: Implement function
	}
?>