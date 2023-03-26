<?
	class ImageModel extends BaseModel {
		/**
		 * 
		 */
		public function ReadFIle(string $slug) {
			return $this->Execute("SELECT * FROM `Images` WHERE `Slug`='$slug' AND `Active?`=1", 4)[0];
		}
	}
?>