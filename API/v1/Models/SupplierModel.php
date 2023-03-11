<?
	class SupplierModel extends BaseModel {
		/** CreateSupplier
		 * Creates a new supplier
		 * @final
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function CreateSupplier(array $info, string $uid) {
				$vals = array(array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vals, "Updated a supplier", "Suppliers", $uid);
				return $this->Execute(sprintf("INSERT INTO `Suppliers`(`Reference`, `Name`, `Email`, `Phone`, `Opening Hours`) VALUES ('%s', '%s', '%s', '%s', '%s')", $info['reference'], $info['name'], $info['email'], $info['phone'], $info['hours']), 1);
			}
		/** UpdateSupplier
		 * Updates a supplier
		 * @final
		 * @param string $sid - Supplier ID
		 * @param array $info - All of the info for the update
		 * @result boolean
		 */
			public function UpdateSupplier(string $sid, array $info, string $uid) {
				$vals = array(array('sid', $sid), array('info', $info), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vals, "Updated a supplier", "Suppliers", $uid);
				return $this->Execute(sprintf("UPDATE `Suppliers` SET `Reference`='%s', `Name`='%s', `Email`='%s', `Phone`='%s', `Opening Hours`='%s' WHERE `ID`='%s'", $info['reference'], $info['name'], $info['email'], $info['phone'], $info['hours'], $sid), 1);
			}
		/** DeleteSupplier
		 * Updates a supplier
		 * @final
		 * @param string $sid - Supplier ID
		 * @result boolean
		 */
			public function DeleteSupplier(string $sid, string $uid) {
				$vals = array(array('sid', $sid), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vals, "Updated a supplier", "Suppliers", $uid);
				return $this->Execute(sprintf("DELETE FROM `Suppliers` WHERE `ID`='%s'", $sid), 1);
			}
		//
	}
?>