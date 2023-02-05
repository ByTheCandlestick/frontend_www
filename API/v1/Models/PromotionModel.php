<?php
	class PromotionModel extends BaseModel {
        /** Create
         *  Creates a new promotion
         *  @param int $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
		public function Create(string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description) {
			try {
				// Add line to Promotion
				$this->Execute("INSERT INTO `Promotions` (`Name`, `Description`, `Percentage discount`, `Voucher`, `Type`, `Scheduled start`, `Sceduled end`, `Active`) VALUES ('$name', '$description', '$percentage', '$voucher', '$type', '$start', '$end', '$active')", 1);
				return true;
			} catch(Error $er) {
				return false;
			}
		}
	}
?>