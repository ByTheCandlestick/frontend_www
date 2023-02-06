<?php
	class PartnerModel extends BaseModel {
        /** Create
         *  Creates a new partner
         *  @param int $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
		public function Create(string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections) {
			try {
				// Add line to Partner
				$this->Execute("INSERT INTO `Partners` (`Name`, `Description`, `Percentage discount`, `Voucher`, `Type`, `Category IDs`, `Collection IDs`, `Scheduled start`, `Scheduled end`, `Active`) VALUES ('$name', '$description', '$percentage', '$voucher', '$type', '$categories', '$collections', '$start', '$end', '$active')", 1);
				return true;
			} catch(Error $er) {
				return false;
			}
		}
        /** Update
         *  Updates a partner
         *  @param int $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
		public function Update(string $id, string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections) {
			try {
				// Update Partners line
				$this->Execute("UPDATE `Partners` SET `Name`='$name', `Description`='$description', `Voucher`='$voucher',`Type`='$type',`Category IDs`='$categories',`Collection IDs`='$collections',`Percentage discount`='$percentage',`Scheduled start`='$start',`Scheduled end`='$end',`Active`='$active' WHERE `ID`=$id", 1);
				return true;
			} catch(Error $er) {
				return false;
			}
		}
	}
?>