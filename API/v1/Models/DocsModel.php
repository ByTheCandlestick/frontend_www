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
			public function getItemInfo(string $itemStr) {
				$i=0;
				foreach(explode(';', $itemStr) as $itemInfo){
					$item = explode(',', $itemInfo);
					$inf = $this->Execute(sprintf("SELECT `Title`, `RetailPrice` FROM `Product` WHERE `SKU`=%s", $item[0]), 3);
					$arr[$i] = array($inf[0], $inf[$item[1]], $inf[1], $inf[1]*$item[1]);
					$i++;
				}

				return $arr;
			}
	}
?>