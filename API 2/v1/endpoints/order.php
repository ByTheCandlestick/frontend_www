<?
	function getOrder($data) {
		if (isset($data['id'])) {
			return getOrder($data['id']);
		} else {
			return array('error' => 'Order ID not provided');
		}
	}

	function createOrder($data) {
		// TODO: Implement function
	}

	function updateOrder($data) {
		// TODO: Implement function
	}

	function deleteOrder($data) {
		// TODO: Implement function
	}
?>