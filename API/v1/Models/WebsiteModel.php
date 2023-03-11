<?
	class WebsiteModel extends BaseModel {
		/**	CreateWebsite
		 *	Create a website page
		 *	@final
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function CreateWebsite(array $info, int $uid) {
				$vars = array(array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new Website/Domain", "Website", $info['uid']);
				return $this->Execute(sprintf("INSERT INTO `Website domains`(`Name`, `Domain`, `Page_type`, `Maintenance`, `Meta_title`, `meta_keywords`, `meta_description`, `meta_colour`, `Title`, `Slogan`, `Email`, `Phone`, `Colour_primary`, `Colour_secondary`, `Default styles`, `Default scripts`, `Logo`, `Favicon`, `Permission`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $info['name'], $info['domain'], $info['page_type'], $info['maintenance'], $info['meta_title'], $info['meta_keywords'], $info['meta_description'], $info['meta_colour'], $info['title'], $info['slogan'], $info['email'], $info['phone'], $info['primary_colour'], $info['secondary_colour'], $info['styles'], $info['scripts'], $info['logo'], $info['favicon'], $info['permission']), 1);
			}
		/**	UpdateWebsite
		 *	Updates a website page
		 *	@final
		 *	@param string $sid - website ID
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function UpdateWebsite(string $sid, array $info, int $uid) {
				$vars = array(array('sid', $sid), array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Updated a Website/Domain", "Website", $info['uid']);
				return $this->Execute(sprintf("UPDATE `Website domains` SET `Name`='%s', `Domain`='%s', `Page_type`='%s', `Maintenance`='%s', `Meta_title`='%s', `meta_keywords`='%s', `meta_description`='%s', `meta_colour`='%s', `Title`='%s', `Slogan`='%s', `Email`='%s', `Phone`='%s', `Colour_primary`='%s', `Colour_secondary`='%s', `Default styles`='%s', `Default scripts`='%s', `Logo`='%s', `Favicon`='%s', `Permission`='%s' WHERE `ID`='%s'", $info['name'], $info['domain'], $info['page_type'], $info['maintenance'], $info['meta_title'], $info['meta_keywords'], $info['meta_description'], $info['meta_colour'], $info['title'], $info['slogan'], $info['email'], $info['phone'], $info['primary_colour'], $info['secondary_colour'], $info['styles'], $info['scripts'], $info['logo'], $info['favicon'], $info['permission'], $sid), 1);
			}
		/** DeleteWebsite
		 *	@final
		 *	Updates a website page
		 *	@param string $sid - website ID
		 *	@result boolean
		 */
			public function DeleteWebsite(string $sid, int $uid) {
				$vars = array(array('sid', $sid), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Deleted a Website/Domain", "Website", "");
				return $this->Execute(sprintf("DELETE FROM `Website domains` WHERE `ID`='%s'", $sid), 1);
			}
		//
		/**	CreateStyle
		 *	@final
		 *	Create a website page style
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function CreateStyle(array $info, int $uid) {
				$vars = array(array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new CSS style link", "CSS", $info['uid']);
				return $this->Execute(sprintf("INSERT INTO `Website styles`(`Name`, `Location`, `Importance`, `Preload`, `Active`) VALUES('%s', '%s', '%s', '%s', '%s')", $info['name'], $info['location'], $info['importance'], $info['preload'], $info['active']), 1);
			}
		/**	UpdateStyle
		 *	@final
		 *	Updates a website page style
		 *	@param string $id - style ID
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function UpdateStyle(string $id, array $info, int $uid) {
				$vars = array(array('id', $id), array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Updated a CSS style link", "CSS", $info['uid']);
				return $this->Execute(sprintf("UPDATE `Website styles` SET `Name`='%s', `Location`='%s', `Importance`='%s', `Preload`='%s', `Active`='%s' WHERE `ID`='%s'", $info['name'], $info['location'], $info['importance'], $info['preload'], $info['active'], $id), 1);
			}
		/**	DeleteStyle
		 *	@final
		 *	Deletes a website page style
		 *	@param string $id - style ID
		 *	@result boolean
		 */
			public function DeleteStyle(string $id, int $uid) {
				$vars = array(array('id', $id), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Deleted a CSS style link", "CSS", "");
				return $this->Execute(sprintf("DELETE FROM `Website styles` WHERE `ID`='%s'", $id), 1);
			}
		//
		/**	CreateScript
		 *	@final
		 *	Create a website page script
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function CreateScript(array $info, int $uid) {
				$vars = array(array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new JS script link", "JS", $info['uid']);
				return $this->Execute(sprintf("INSERT INTO `Website scripts`(`Name`, `Location`, `Importance`, `Active`) VALUES('%s', '%s', '%s', '%s')", $info['name'], $info['location'], $info['importance'], $info['active']), 1);
			}
		/**	UpdateScript
		 *	@final
		 *	Updates a website page script
		 *	@param string $id - script ID
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function UpdateScript(string $id, array $info, int $uid) {
				$vars = array(array('id', $id), array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Updated a JS script link", "JS", $info['uid']);
				return $this->Execute(sprintf("UPDATE `Website scripts` SET `Name`='%s', `Location`='%s', `Importance`='%s', `Active`='%s' WHERE `ID`='%s'", $info['name'], $info['location'], $info['importance'], $info['active'], $id), 1);
			}
		/**	DeleteScript
		 *	@final
		 *	Deletes a website page script
		 *	@param string $id - script ID
		 *	@result boolean
		 */
			public function DeleteScript(string $id, int $uid) {
				$vars = array(array('id', $id), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Deleted a JS script link", "JS", "");
				return $this->Execute(sprintf("DELETE FROM `Website scripts` WHERE `ID`='%s'", $id), 1);
			}
		//
		/**	CreateTheme
		 *	@todo
		 *	Create a website theme
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function CreateTheme(array $info, int $uid) {
				$vars = array(array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new Theme", "Theme", $info['uid']);
				return $this->Execute(sprintf("INSERT INTO `Website themes`(`Name`, `Description`, `Location`, `Active`) VALUES('%s', '%s', '%s', '%s')", $info['name'], $info['description'], $info['location'], $info['active']), 1);
			}
		/**	UpdateTheme
		 *	@todo
		 *	Updates a website theme
		 *	@param string $id - script ID
		 *	@param array $info - All of the info for the update
		 *	@result boolean
		 */
			public function UpdateTheme(string $id, array $info, int $uid) {
				$vars = array(array('id', $id), array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Updated a Theme", "Theme", $info['uid']);
				return $this->Execute(sprintf("UPDATE `Website themes` SET `Name`='%s', `Description`='%s', `Location`='%s', `Active`='%s' WHERE `ID`='%s'", $info['name'], $info['description'], $info['location'], $info['active'], $id), 1);
			}
		/**	DeleteTheme
		 *	@todo
		 *	Delete a website theme
		 *	@param string $id - script ID
		 *	@result boolean
		 */
			public function DeleteTheme(string $id, int $uid) {
				$vars = array(array('id', $id), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Deleted a Theme", "Theme", "");
				return $this->Execute(sprintf("DELETE FROM `Website themes` WHERE `ID`='%s'", $id), 1);
			}
		//
	}
?>