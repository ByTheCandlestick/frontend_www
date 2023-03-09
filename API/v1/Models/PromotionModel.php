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
			public function Create(string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections, string $uid) {
				try {
					// Add line to Promotion
					$this->uploadAudit(__FUNCTION__, array($name, $percentage, $start, $end, $voucher, $active, $type, $description, $categories, $collections), "Created a promotion", "Promotions", $uid);
					$this->Execute("INSERT INTO `Promotions` (`Name`, `Description`, `Percentage discount`, `Voucher`, `Type`, `Category IDs`, `Collection IDs`, `Scheduled start`, `Scheduled end`, `Active`) VALUES ('$name', '$description', '$percentage', '$voucher', '$type', '$categories', '$collections', '$start', '$end', '$active')", 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
        /** Update
         *  Updates a promotion
         *  @param int $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
			public function Update(string $id, string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections, string $uid) {
				try {
					// Update Promotion line
					$this->uploadAudit(__FUNCTION__, array($id, $name, $percentage, $start, $end, $voucher, $active, $type, $description, $categories, $collections), "Updated a promotion", "Promotions", $uid);
					$this->Execute("UPDATE `Promotions` SET `Name`='$name', `Description`='$description', `Voucher`='$voucher',`Type`='$type',`Category IDs`='$categories',`Collection IDs`='$collections',`Percentage discount`='$percentage',`Scheduled start`='$start',`Scheduled end`='$end',`Active`='$active' WHERE `ID`=$id", 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
	}
?>