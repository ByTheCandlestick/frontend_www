<?php
	class ConfigModel extends BaseModel {
		/** createPermission
		 *  @return bool
		 */
			public function createPermission(string $name, string $default) {
				return $this->Execute("ALTER TABLE `Users_permissions` ADD `$name` tinyint(1) NOT NULL DEFAULT '$default';", 1);
			}
		/** updatePermission
		 *  @return bool
		 */
            public function updatePermission(string $oldName, string $newName, string $default) {
                return $this->Execute("ALTER TABLE `Users_permissions` CHANGE `$oldName` `$newName` tinyint(1) NOT NULL DEFAULT '$default';", 1);
            }
	}
?>