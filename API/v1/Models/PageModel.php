<?
	class PageModel extends BaseModel {
		/** CreatePage
		 * Updates a website page
		 * @final
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function CreatePage(array $info) {
				$this->Execute(sprintf("INSERT INTO `Website pages`(`page_url`, `page_name`, `subpage_url`, `page_title`, `style_ids`,`script_ids`, `domain_id`, `menu_item`, `menu_icon`, `menu_order`, `menu_url`, `Permission`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $info['page_url'], $info['name'], $info['subpage_url'], $info['title'], $info['style'], $info['script'], $info['domain_id'], $info['menu_item'], $info['menu_icon'], $info['menu_order'], $info['menu_url'], $info['permission']), 1);
				return print_r($this->Execute(sprintf("SELECT `Website pages` FROM `Website pages` WHERE `page_url`='%s' AND `page_name`='%s' AND `subpage_url`='%s' AND `page_title`='%s' AND `style_ids`='%s' AND `script_ids`='%s' AND `domain_id`='%s' AND `menu_item`='%s' AND `menu_icon`='%s' AND `menu_order`='%s' AND `menu_url`='%s' AND `Permission`='%s'", $info['page_url'], $info['name'], $info['subpage_url'], $info['title'], $info['style'], $info['script'], $info['domain_id'], $info['menu_item'], $info['menu_icon'], $info['menu_order'], $info['menu_url'], $info['permission']), 2));
			}
		/** UpdatePage
		 * Updates a website page
		 * @final
		 * @param string $sid - website ID
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdatePage(string $sid, array $info) {
				return $this->Execute(sprintf("UPDATE `Website pages` SET `page_url`='%s', `page_name`='%s', `subpage_url`='%s', `page_title`='%s', `style_ids`='%s',`script_ids`='%s',`domain_id`='%s', `menu_item`='%s', `menu_icon`='%s',`menu_order`='%s',`menu_url`='%s',`Permission`='%s' WHERE `ID`='%s'", $info['page_url'], $info['name'], $info['subpage_url'], $info['title'], $info['style'], $info['script'], $info['domain_id'], $info['menu_item'], $info['menu_icon'], $info['menu_order'], $info['menu_url'], $info['permission'], $sid), 1);
			}
		/** DeletePage
		 * Updates a website page
		 * @final
		 * @param string $sid - website ID
		 * @result boolean
		 */
			public function DeletePage(string $pid) {
				return $this->Execute(sprintf("DELETE FROM `Website pages` WHERE `ID`='%s'", $pid), 1);
			}
		//
		/** UpdateLayout
		 * Updates a website page
		 * @final
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdateLayout(string $pid, array $info) {
				return $this->Execute(sprintf("UPDATE `Website pages` SET `display_type`='%s', `section_ids`='%s', `page_file`='%s' WHERE `ID`='%s';", $info['display_type'], $info['sections'], $info['page'], $pid), 1);
			}
		//
	}
?>