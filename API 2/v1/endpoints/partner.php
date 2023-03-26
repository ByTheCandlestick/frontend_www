<?
	function getPartner($data) {
		if (isset($data['id'])) {
			return getPartner($data['id']);
		} else {
			return array('error' => 'Partner ID not provided');
		}
	}

	function createPartner($data) {
		// TODO: Implement function
	}

	function updatePartner($data) {
		// TODO: Implement function
	}

	function deletePartner($data) {
		// TODO: Implement function
	}
?>