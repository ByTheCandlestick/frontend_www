<?php
	class OrdersModel extends BaseModel {
		/** updateStatus
		 * 
		 * @todo All
		 * @param string $s
		 * @return bool	
		 */
			public function updateStatus(string $s, string $i, string $uid) {
				$this->uploadAudit(__FUNCTION__, array($s, $i), "Changes status of order", "Orders", $uid);
				return $this->Execute(sprintf("UPDATE `Transactions` SET `Shipping status`='%s' WHERE `Invoice ID`='%s' AND `Type`='Order'", $s, $i), 1);
			}
	}
?>