<?
	class TasksModel extends BaseModel {
		/**	resetTransactions
		 * 	sets a new base transaction for each day
		 */
			public function resetTransactions() {
				$this->uploadAudit(__FUNCTION__, array(), "Reset transactions", "Tasks");
				return $this->Execute("INSERT INTO `Transactions` (`Transaction ID`, `Type`, `Status`, `Subtotal`, `Processing fees`, `Tax`, `Deposit`, `Currency`) VALUES (CONCAT('Transactions Reset:- ',now()), 'DT-RESET', 'Succeeded', 0, 0, 0, 0, 'GBP');", 1);
			}
		/**	clearDudPages
		 * 	Clears any pages not assigned to a domain
		 */
			public function resetDudPages() {
				$this->uploadAudit(__FUNCTION__, array(), "Removed all unallocated pages", "Tasks");
				return $this->Execute("DELETE FROM `Website pages` WHERE `domain_id`='-1';", 1);
			}
		/** refundOldOrders
		 *  Refunds all orders of a certain age that hasnt been accepted.
		 */
			public function refundOldOrders() {
				$cnt = 0;
				$this->uploadAudit(__FUNCTION__, array(), "Refunded all old orders: ".$cnt, "Website");
				
			}
	}
?>