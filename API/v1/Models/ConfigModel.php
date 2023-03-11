<?php
	class ConfigModel extends BaseModel {
		/** createPermission
		 *  @return bool
		 */
			public function createPermission(string $name, string $default, string $uid) {
				$this->uploadAudit(__FUNCTION__, array($name, $default), "Created a new permission", "Permissions", $uid);
				return $this->Execute("ALTER TABLE `User permissions` ADD `$name` tinyint(1) NOT NULL DEFAULT '$default';", 1);
			}
		/** updatePermission
		 *  @return bool
		 */
            public function updatePermission(string $oldName, string $newName, string $default, string $uid) {
				$vars = array(array('oldName', $oldName), array('newName', $newName), array('default', $default), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Updated a permission", "Permissions", $uid);
                return $this->Execute("ALTER TABLE `User permissions` CHANGE `$oldName` `$newName` tinyint(1) NOT NULL DEFAULT '$default';", 1);
            }
		/** updatePermission
		 *  @return bool
		 */
			public function deletePermission(string $name, string $uid) {
				$vars = array(array('name', $name), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Deleted a permission", "Permissions", $uid);
				return $this->Execute("ALTER TABLE `User permissions` DROP `$name`;", 1);
			}
	}
?>