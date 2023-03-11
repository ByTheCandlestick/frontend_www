<?php
	class OrdersModel extends BaseModel {
		/** updateStatus
		 * 
		 * @todo All
		 * @param string $s
		 * @return bool	
		 */
			public function updateStatus(string $status, string $invoice, string $uid) {
				$vars = array(array('status', $status), array('invoice', $invoice), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Changes status of order -> ".$status, "Orders", $uid);
				return $this->Execute(sprintf("UPDATE `Transactions` SET `Shipping status`='%s' WHERE `Invoice ID`='%s' AND `Type`='Order'", $status, $invoice), 1);
			}
	}
?>