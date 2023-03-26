<?
	function getMail($data) {
		if (isset($data['id'])) {
			return getMail($data['id']);
		} else {
			return array('error' => 'Mail ID not provided');
		}
	}

	function createMail($data) {
		// TODO: Implement function
	}

	function updateMail($data) {
		// TODO: Implement function
	}

	function deleteMail($data) {
		// TODO: Implement function
	}
?>