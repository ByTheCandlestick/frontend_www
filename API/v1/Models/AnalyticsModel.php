<?
	class AnalyticsModel extends BaseModel {
        /** add
         *  Adds the item SKU and options to a users cart
         *  @param string $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
			public function add(string $uid, int $sku, int $qty, string $opt) {
				try {
					// UserID is real / active
					if(!$this->Execute("SELECT * FROM `User accounts` WHERE `UID`='$uid'", 1)) {
						throw new error('ERR-CRT-6');
					}
					// Product SKU is real / active
					if(!$this->Execute("SELECT * FROM `Product` WHERE `sku`='$sku'", 1)) {
						throw new error('ERR-CRT-7');
					}
					// Add line to cart
					$this->Execute("INSERT INTO `User carts` (`UID`, `SKU`, `Quantity`, `Options`) VALUES ('$uid', '$sku', '$qty', '$opt')", 1);
					
					return array(
						"status"=>"success",
					);
				} catch(Error $er) {
					return array(
						"status"=>$er->getMessage(),
					);
				}
			}
	}
?>