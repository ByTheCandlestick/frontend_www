<?php
	class ImageModel extends BaseModel {
		/**
		 * 
		 */
		public function ReadFIle(string $title) {
			return $this->Execute("SELECT * FROM `Images` WHERE `slug`='$title' AND `active`=1", 4)[0];
		}
	}
?>