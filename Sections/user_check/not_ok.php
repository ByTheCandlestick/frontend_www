<?
	if(!$user_ok) {
		if(isset($_POST['rdir'])) {
			Redirect($_POST['rdir']);
		} else {
			Redirect('/');
		}
	}
?>