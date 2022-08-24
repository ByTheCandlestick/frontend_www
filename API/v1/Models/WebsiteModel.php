<?
	class WebsiteModel extends BaseModel {
		/** CreateWebsite
		 * Create a website page
		 * @final
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function CreateWebsite(array $info) {
				return $this->Execute(sprintf("INSERT INTO `Websites`(`Domain`, `Name`, `Page_type`, `Maintenance`) VALUES('%s', '%s', '%s', '%s')", $info['domain'], $info['name'], $info['page_type'], $info['maintenance']), 1);
			}
		/** UpdateWebsite
		 * Updates a website page
		 * @final
		 * @param string $sid - website ID
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdateWebsite(string $sid, array $info) {
				return $this->Execute(sprintf("UPDATE `Websites` SET `Name`='%s', `Domain`='%s', `Page_type`='%s', `Maintenance`='%s', `Meta_title`='%s', `meta_keywords`='%s', `meta_description`='%s', `meta_colour`='%s', `Title`='%s', `Slogan`='%s', `Email`='%s', `Phone`='%s', `Colour_primary`='%s', `Colour_secondary`='%s', `Logo`='%s', `Favicon`='%s' WHERE `ID`='%s'", $info['name'], $info['domain'], $info['page_type'], $info['maintenance'], $info['meta_title'], $info['meta_keywords'], $info['meta_description'], $info['meta_colour'], $info['title'], $info['slogan'], $info['email'], $info['phone'], $info['primary_colour'], $info['secondary_colour'], $info['logo'], $info['favicon'], $sid), 1);
			}
		/** DeleteWebsite
		 * @final
		 * Updates a website page
		 * @param string $sid - website ID
		 * @result boolean
		 */
			public function DeleteWebsite(string $sid) {
				return $this->Execute(sprintf("DELETE FROM `Websites` WHERE `ID`='%s'", $sid), 1);
			}
		//
		/** CreateStyle
		 * @final
		 * Create a website page style
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function CreateStyle(array $info) {
				return $this->Execute(sprintf("INSERT INTO `page_styles`(`Name`, `Location`, `Importance`, `Preload`, `Active`) VALUES('%s', '%s', '%s', '%s', '%s')", $info['name'], $info['location'], $info['importance'], $info['preload'], $info['active']), 1);
			}
		/** UpdateStyle
		 * @final
		 * Updates a website page style
		 * @param string $id - style ID
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdateStyle(string $id, array $info) {
				return $this->Execute(sprintf("UPDATE `page_styles` SET `Name`='%s', `Location`='%s', `Importance`='%s', `Preload`='%s', `Active`='%s' WHERE `ID`='%s'", $info['name'], $info['location'], $info['importance'], $info['preload'], $info['active'], $id), 1);
			}
		/** DeleteStyle
		 * @final
		 * Deletes a website page style
		 * @param string $id - style ID
		 * @result boolean
		 */
			public function DeleteStyle(string $id) {
				return $this->Execute(sprintf("DELETE FROM `page_styles` WHERE `ID`='%s'", $id), 1);
			}
		//
		/** CreateScript
		 * @final
		 * Create a website page script
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function CreateScript(array $info) {
				return $this->Execute(sprintf("INSERT INTO `Websites scripts`(`Name`, `Location`, `Importance`, `Active`) VALUES('%s', '%s', '%s', '%s')", $info['name'], $info['location'], $info['importance'], $info['active']), 1);
			}
		/** UpdateScript
		 * @final
		 * Updates a website page script
		 * @param string $id - script ID
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdateScript(string $id, array $info) {
				return $this->Execute(sprintf("UPDATE `Websites scripts` SET `Name`='%s', `Location`='%s', `Importance`='%s', `Active`='%s' WHERE `ID`='%s'", $info['name'], $info['location'], $info['importance'], $info['active'], $id), 1);
			}
		/** DeleteScript
		 * @final
		 * Deletes a website page script
		 * @param string $id - script ID
		 * @result boolean
		 */
			public function DeleteScript(string $id) {
				return $this->Execute(sprintf("DELETE FROM `Websites scripts` WHERE `ID`='%s'", $id), 1);
			}
		//
		/** CreateTheme
		 * @todo
		 * Create a website theme
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function CreateTheme(array $info) {
				return $this->Execute(sprintf("INSERT INTO `page_types`(`Name`, `Description`, `Location`, `Active`) VALUES('%s', '%s', '%s', '%s')", $info['name'], $info['description'], $info['location'], $info['active']), 1);
			}
		/** UpdateTheme
		 * @todo
		 * Updates a website theme
		 * @param string $id - script ID
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdateTheme(string $id, array $info) {
				return $this->Execute(sprintf("UPDATE `page_types` SET `Name`='%s', `Description`='%s', `Location`='%s', `Active`='%s' WHERE `ID`='%s'", $info['name'], $info['description'], $info['location'], $info['active'], $id), 1);
			}
		/** DeleteTheme
		 * @todo
		 * Delete a website theme
		 * @param string $id - script ID
		 * @result boolean
		 */
			public function DeleteTheme(string $id) {
				return $this->Execute(sprintf("DELETE FROM `page_types` WHERE `ID`='%s'", $id), 1);
			}
		//
	}
?>