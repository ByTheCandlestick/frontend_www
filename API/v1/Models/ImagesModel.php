<?php
	class ImageModel extends BaseModel {
		/**
		 * 
		 */
		public function ReadFIle(string $title) {
			return $this->Execute("SELECT * FROM `Images` WHERE `Slug`='$title' AND `Active?`=1", 4)[0];
		}
	}
?>