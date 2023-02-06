<?php
	class PartnerModel extends BaseModel {
        /** Create
         *  Creates a new partner
         *  @param string $name
         *  @param string $public
         *  @param string $desc_s
         *  @param string $desc_l
         *  @param string $logo
         *  @param string $link
         *  @param string $email
         *  @param string $phone
         *  @param string $slug
         *  @param string $active
         *  @return bool
         */
			public function Create(string $name, string $public, string $desc_s, string $desc_l, string $logo, string $link, string $email, string $phone, string $slug, string $active) {
				try {
					// Add line to Partner
					$this->Execute("INSERT INTO `Partner accounts` (`Name`, `Public`, `About short`, `About long`, `Logo image`, `Shop link`, `Email`, `Phone`, `Slug`, `Active`) VALUES ('$name', '$public', '$desc_s', '$desc_l', '$logo', '$link', '$email', '$phone', '$slug', '$active')", 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
        /** Update
         *  Updates a partner
         *  @param string $id
         *  @param string $name
         *  @param string $public
         *  @param string $desc_s
         *  @param string $desc_l
         *  @param string $logo
         *  @param string $link
         *  @param string $email
         *  @param string $phone
         *  @param string $slug
         *  @param string $active
         *  @return bool
         */
			public function Update(string $id, string $name, string $public, string $desc_s, string $desc_l, string $logo, string $link, string $email, string $phone, string $slug, string $active) {
				try {
					print($sql = "UPDATE `Partner accounts` SET `Name`='$name', `public`='$public', `About short`='$desc_s',`About long`='$desc_l',`Logo image`='$logo',`Shop link`='$link',`Email`='$email',`Phone`='$phone',`Slug`='$slug',`Active`='$active' WHERE `ID`=$id");
					// Update Partners line
					$this->Execute($sql, 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
        /** Delete
         *  Deletes a partner
         *  @param int $id
         *  @param string $opt
         *  @return
         */
			public function Update(string $id) {
				try {
					print($sql = "DELETE FROM  `Partner accounts` WHERE `ID`=$id");
					// Update Partners line
					$this->Execute($sql, 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
	}
?>