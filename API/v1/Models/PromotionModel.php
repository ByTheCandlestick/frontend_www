<?php
	class PromotionModel extends BaseModel {
        /** Create
         *  Creates a new promotion
         *  @param string $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
			public function Create(string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections, string $uid) {
				try {
					// Add line to Promotion
					$vars = array(array('name', $name), array('percentage', $percentage), array('start', $start), array('end', $end), array('voucher', $voucher), array('active', $active), array('type', $type), array('description', $description), array('categories', $categories), array('collections', $collections), array('uid', $uid));
					$this->uploadAudit(__FUNCTION__, $vars, "Created a promotion", "Promotions", $uid);
					$this->Execute("INSERT INTO `Promotions` (`Name`, `Description`, `Percentage discount`, `Voucher`, `Type`, `Category IDs`, `Collection IDs`, `Scheduled start`, `Scheduled end`, `Active`) VALUES ('$name', '$description', '$percentage', '$voucher', '$type', '$categories', '$collections', '$start', '$end', '$active')", 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
        /** Update
         *  Updates a promotion
         *  @param string $uid
         *  @param int $sku
         *  @param int $qty
         *  @param string $opt
         *  @return
         */
			public function Update(string $id, string $name, string $percentage, string $start, string $end, string $voucher, string $active, string $type, string $description, string $categories, string $collections, string $uid) {
				try {
					// Update Promotion line
					$vars = array(array('id', $id), array('name', $name), array('percentage', $percentage), array('start', $start), array('end', $end), array('voucher', $voucher), array('active', $active), array('type', $type), array('description', $description), array('categories', $categories), array('collections', $collections), array('uid', $uid));
					$this->uploadAudit(__FUNCTION__, $vars, "Updated a promotion", "Promotions", $uid);
					$this->Execute("UPDATE `Promotions` SET `Name`='$name', `Description`='$description', `Voucher`='$voucher',`Type`='$type',`Category IDs`='$categories',`Collection IDs`='$collections',`Percentage discount`='$percentage',`Scheduled start`='$start',`Scheduled end`='$end',`Active`='$active' WHERE `ID`=$id", 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
	}
?>