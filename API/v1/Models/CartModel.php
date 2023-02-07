<?php
	class CartModel extends BaseModel {
		public function checkUser(int $uid) {
			return $this->Execute(sprintf("SELECT * FROM `User accounts` WHERE `ID`=%s", $uid), 5) > 0 ;
		}
		public function checkItem(int $sku) {
			return $this->Execute(sprintf("SELECT * FROM `Product` WHERE `SKU`='%s'", $sku), 5) > 0;
		}
        /** add
         *  Adds the item SKU and options to a users cart
         *  @param int $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
		public function add(int $uid, int $sku, int $qty, string $opt) {
			// check if line already exists,
			if($this->Execute(sprintf("SELECT * FROM `User carts` WHERE `UID`=%s AND `SKU`='%s' AND `Options`='%s'", $uid, $sku, $opt), 5) > 0) {
				// Get qty on existing line
				print_r($this->Execute(sprintf("SELECT * FROM `User carts` WHERE `UID`=%s AND `SKU`='%s' AND `Options`='%s'", $uid, $sku, $opt), 2));
				// Add quantities and update line
			} else {
				// Create a new line
				return $this->Execute("INSERT INTO `User carts` (`UID`, `SKU`, `Quantity`, `Options`) VALUES ('$uid', '$sku', '$qty', '$opt')", 1);
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