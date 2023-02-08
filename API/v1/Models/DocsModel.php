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
				return array(
					array('1','2','3','4'),
					array('5','6','7','8')
				);
			}
	}
?>