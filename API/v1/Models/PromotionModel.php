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
		public function Create(string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections) {
			try {
				// Add line to Promotion
				print $sql = "INSERT INTO `Promotions` (`Name`, `Description`, `Percentage discount`, `Voucher`, `Type`, `Category IDs`, `Collection IDs`, `Scheduled start`, `Scheduled end`, `Active`) VALUES ('$name', '$description', '$percentage', '$voucher', '$type', '$categories', '$collections', '$start', '$end', '$active')";
				$this->Execute($sql, 1);
				return true;
			} catch(Error $er) {
				return false;
			}
		}
	}
?>