<?php
	class ConfigModel extends BaseModel {
		/** createPermission
		 *  @return bool
		 */
			public function createPermission(string $name, string $default) {
				$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Created a new permission", "Permissions", $uid);
				return $this->Execute("ALTER TABLE `User permissions` ADD `$name` tinyint(1) NOT NULL DEFAULT '$default';", 1);
			}
		/** updatePermission
		 *  @return bool
		 */
            public function updatePermission(string $oldName, string $newName, string $default) {
				$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Updated a permission", "Permissions", $uid);
                return $this->Execute("ALTER TABLE `User permissions` CHANGE `$oldName` `$newName` tinyint(1) NOT NULL DEFAULT '$default';", 1);
            }
		/** updatePermission
		 *  @return bool
		 */
			public function deletePermission(string $name) {
				$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Deleted a permission", "Permissions", $uid);
				return $this->Execute("ALTER TABLE `User permissions` DROP `$name`;", 1);
			}
	}
?>