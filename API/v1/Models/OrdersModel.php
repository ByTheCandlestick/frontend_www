<?php
	class OrdersModel extends BaseModel {
		/** updateStatus
		 * 
		 * @todo All
		 * @param string $s
		 * @return bool	
		 */
			public function updateStatus(string $s, string $i) {
				return $this->Execute(sprintf("UPDATE `Website pages` SET `Shipping status`='%s' WHERE `Invoice ID`='%s'", $s, $i), 1);
			}
	}
?>