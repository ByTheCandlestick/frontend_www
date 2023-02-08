<?php
	class DocsModel extends BaseModel {
		/** getOrderInfo
		 * 
		 */
			public function getOrderInfo(string $inv) {
				return $this->Execute(sprintf("SELECT * FROM `Transactions` WHERE `Type`='Order' AND `Invoice ID`='%s' LIMIT 1", $inv), 4)[0];
			}
		/** getItemInfo
		 * 
		 */
			public function getItemInfo() {

			}
	}
?>