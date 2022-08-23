<?php
	class CartModel extends BaseModel {
        /** add
         *  Adds the item SKU and options to a users cart
         *  @param int $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
		public function add(int $uid, int $sku, int $qty, string $opt) {
			try {
				// UserID is real / active
				if(!$this->Execute("SELECT * FROM `Users` WHERE `UID`='$uid'", 1)) {
					throw new error('ERR-CRT-6');
				}
				// Product SKU is real / active
				if(!$this->Execute("SELECT * FROM `products` WHERE `sku`='$sku'", 1)) {
					throw new error('ERR-CRT-7');
				}
				// Add line to cart
				$this->Execute("INSERT INTO `Users_cart` (`UID`, `SKU`, `Quantity`, `Options`) VALUES ('$uid', '$sku', '$qty', '$opt')", 1);
				
				return array(
					"status"=>"success",
				);
			} catch(Error $er) {
				return array(
					"status"=>$er->getMessage(),
				);
			}
		}
		/** remove
		 * Removed an item completely from the users cart
		 * @todo All
		 * @param int uid
		 * @param int sku
		 * @param string opt
		 * @param int qty
		 * @return
		 */
		public function remove(int $uid, int $sku, string $opt, int $qty) {

		}
	}
?>