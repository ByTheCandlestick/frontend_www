<?
	class CartModel extends BaseModel {
		/** checkUser
		 * 
		 */
			public function checkUser(int $uid) {
				return $this->Execute(sprintf("SELECT * FROM `User accounts` WHERE `ID`=%s", $uid), 5) > 0 ;
			}
		/** checkItem
		 * 
		 */
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
				print_r((new ReflectionFunctionAbstract(__FUNCTION__))->getParameters());
				try {
					$this->uploadAudit(__FUNCTION__, (new ReflectionFunctionAbstract(__FUNCTION__))->getParameters(), "Item added to users cart", "Cart", $uid);
				} catch(Exception $ex) {

				}
				// check if line already exists
				if($this->Execute(sprintf("SELECT * FROM `User carts` WHERE `UID`=%s AND `SKU`='%s' AND `Options`='%s'", $uid, $sku, $opt), 5) > 0) {
					// Get qty on existing line
					$new_qty = $this->Execute(sprintf("SELECT `Quantity` FROM `User carts` WHERE `UID`=%s AND `SKU`='%s' AND `Options`='%s'", $uid, $sku, $opt), 2)[0] + $qty;
					// Add quantities and update line
					return $this->Execute(sprintf("UPDATE `User carts` SET `Quantity`=%s WHERE `Options`='%s' AND `SKU`='%s'", $new_qty, $opt, $sku), 1);
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
			public function remove(int $uid, int $sku, string $opt, string $qty) {
				$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Items removed from users cart", "Cart", $uid);
				$new_qty = $this->Execute(sprintf("SELECT `Quantity` FROM `User carts` WHERE `UID`=%s AND `SKU`='%s' AND `Options`='%s'", $uid, $sku, $opt), 2)[0] - $qty;
				if($new_qty == 0) {
					return $this->Execute(sprintf("DELETE FROM `User carts` WHERE `UID`=%s AND `Options`='%s' AND `SKU`=%s", $uid, $opt, $sku), 1);
				} else {
					return $this->Execute(sprintf("UPDATE `User carts` SET `Quantity`=(`Quantity`-%s) WHERE `UID`=%s AND `Options`='%s' AND `SKU`=%s", $qty, $uid, $opt, $sku), 1);
				}
			}
	}
?>