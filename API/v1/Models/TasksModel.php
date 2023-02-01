<?php
	class TasksModel extends BaseModel {
		/**	resetTransactions
		 * 	sets a new base transaction for each day
		 */
			public function resetTransactions() {
				return $this->Execute("INSERT INTO `Transactions` (`Transaction ID`, `Type`, `Status`, `Subtotal`, `Processing fees`, `Tax`, `Deposit`, `Currency`) VALUES (CONCAT('Transactions Reset:- ',now()), 'DT-RESET', 'Succeeded', 0, 0, 0, 0, 'GBP');", 1);
			}
		/**	clearDudPages
		 * 	Clears any pages not assigned to a domain
		 */
			public function resetDudPages() {
				return $this->Execute("DELETE FROM `Website pages` WHERE `domain_id`='-1';", 1);
			}
		/** refundOldOrders
		 *  Refunds all orders of a certain age that hasnt been accepted.
		 */
			public function refundOldOrders() {
				
			}
	}
?>