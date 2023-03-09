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
				$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Created a new partner", "Partners", $uid);
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
				$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Updated a Partner", "Partners", $uid);
				try {
					// Update Partners line
					$this->Execute("UPDATE `Partner accounts` SET `Name`='$name', `public`='$public', `About short`='$desc_s',`About long`='$desc_l',`Logo image`='$logo',`Shop link`='$link',`Email`='$email',`Phone`='$phone',`Slug`='$slug',`Active`='$active' WHERE `ID`=$id", 1);
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
			public function Delete(string $id) {
				try {
					$this->uploadAudit(__FUNCTION__, (new ReflectionFunction(__FUNCTION__))->getParameters(), "Deleted a partner", "Partners", $uid);
					// Update Partners line
					$this->Execute("DELETE FROM  `Partner accounts` WHERE `ID`=$id", 1);
					return true;
				} catch(Error $er) {
					return false;
				}
			}
	}
?>