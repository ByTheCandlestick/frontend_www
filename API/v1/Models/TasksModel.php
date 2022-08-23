<?php
	class TasksModel extends BaseModel {
		/**
		 * 
		 */
		public function resetTransactions() {
			return $this->Execute("INSERT INTO `Transactions` (`Transaction ID`, `Type`, `Status`, `Subtotal`, `Processing fees`, `Tax`, `Deposit`, `Currency`) VALUES (CONCAT('Transactions Reset:- ',now()), 'DT-RESET', 'Succeeded', 0, 0, 0, 0, 'GBP');", 1);
		}
	}
?>