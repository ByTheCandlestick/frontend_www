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
		public function Create(string $name, string $public, string $desc_s, string $desc_l, string $logo, string $link, string $email, string $phone, string $slug, string $active) {
			try {
				// Add line to Partner
				$this->Execute("INSERT INTO `Partner accounts` (`Name`, `Public`, `About short`, `About long`, `Logo image`, `Shop link`, `Email`, `Phone`, `Slug`, `Active`)
										VALUES ('$name', '$public', '$desc_s', '$desc_l', '$logo', '$link', '$email', '$phone', '$slug', '$active')", 1);
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