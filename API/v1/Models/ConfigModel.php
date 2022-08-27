<?php
	class ConfigModel extends BaseModel {
		/** UpdatePermission
		 *  @return bool
		 */
            public function UpdatePermission(string $oldName, string $newName, string $type, string $nullable, string $default) {
                return $this->Execute("ALTER TABLE `Users_permissions` CHANGE `$oldName` `$newName` $type ". (($nullable=="0")? "NOT NULL" : "NULL" ) ." DEFAULT '$default';", 1);
            }
	}
?>