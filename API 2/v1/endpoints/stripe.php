<?
	function getStripe($data) {
		if (isset($data['id'])) {
			return getStripe($data['id']);
		} else {
			return array('error' => 'Stripe ID not provided');
		}
	}

	function createStripe($data) {
		// TODO: Implement function
	}

	function updateStripe($data) {
		// TODO: Implement function
	}

	function deleteStripe($data) {
		// TODO: Implement function
	}
?>