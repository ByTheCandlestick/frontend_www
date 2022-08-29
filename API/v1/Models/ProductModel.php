<?php
	class ProductModel extends BaseModel {
		/** validateTitle
		 * 
		 * 
		 */
			public function validateTitle(string $title) {
				if(strlen($title) <= 5) return false;
				return true;
			}
		/** validateCollection
		 * 
		 * 
		 */
			public function validateCollection($coll_ID) {
				if($this->Execute("SELECT COUNT(*) FROM `products_collections` WHERE `ID`=".$coll_ID, 3)[0] != 1) return false;
				return true;
			}
		/** validateCategory
		 * 
		 * 
		 */
			public function validateImages($images) {
				foreach(explode(',', $images) as $image) {
					if($this->Execute("SELECT COUNT(*) FROM `Images` WHERE `slug`='".$image."'", 3)[0] != 1) return false;
				}
				return true;
			}
		/** validateCategory
		 * 
		 * 
		 */
			public function validateCategory($cat_ID) {
				if($this->Execute("SELECT COUNT(*) FROM `products_categories` WHERE `ID`=".$cat_ID, 3)[0] != 1) return false;
				return true;
			}
		/** validateCurrency
		 * 
		 * 
		 */
			public function validateCurrency() {
				return true;
			}
		/** validateContainer
		 * 
		 * 
		 */
			public function validateContainer($cont) {
				if($this->Execute("SELECT COUNT(*) FROM `products_containers` WHERE `ID`=".$cont, 3)[0] != 1) return false;
				return true;
			}
		/** validateWick
		 * 
		 * 
		 */
			public function validateWick($wick) {
				if($this->Execute("SELECT COUNT(*) FROM `products_wicks` WHERE `ID`=".$wick, 3)[0] != 1) return false;
				return true;
			}
		/** validateWickStand
		 * 
		 * 
		 */
			public function validateWickStand($stand) {
				if($this->Execute("SELECT COUNT(*) FROM `products_wickstands` WHERE `ID`=".$stand, 3)[0] != 1) return false;
				return true;
			}
		/** validateMaterial
		 * 
		 * 
		 */
			public function validateMaterial($material) {
				if($this->Execute("SELECT COUNT(*) FROM `products_materials` WHERE `ID`=".$material, 3)[0] != 1) return false;
				return true;
			}
		/** validateFragrance
		 * 
		 * 
		 */
			public function validateFragrance($fragrance) {
				if($this->Execute("SELECT COUNT(*) FROM `products_fragrances` WHERE `ID`=".$fragrance, 3)[0] != 1) return false;
				return true;
			}
		/** validateColour
		 * 
		 * 
		 */
			public function validateColour($colour) {
				if($this->Execute("SELECT COUNT(*) FROM `products_colours` WHERE `ID`=".$colour, 3)[0] != 1) return false;
				return true;
			}
		/** validatePackaging
		 * 
		 * 
		 */
			public function validatePackaging($packaging) {
				if($this->Execute("SELECT COUNT(*) FROM `products_packagings` WHERE `ID`=".$packaging, 3)[0] != 1) return false;
				return true;
			}
		/** validateShipping
		 * 
		 * 
		 */
			public function validateShipping($shipping) {
				if($this->Execute("SELECT COUNT(*) FROM `products_shippings` WHERE `ID`=".$shipping, 3)[0] != 1) return false;
				return true;
			}
		/** validateMadeBy
		 * 
		 * 
		 */
			public function validateMadeBy($made_by) {
				if($this->Execute("SELECT COUNT(*) FROM `partners` WHERE `ID`=".$made_by, 3)[0] != 1) return false;
				return true;
			}
		/** validateSlug
		 * 
		 * 
		 */
			public function validateSlug($slug) {
				if(strlen($slug) <= 5) return false;
				return true;
			}
		/** updateProduct
		 * 
		 * 
		 */
			public function updateProduct(string $sku, array $info) {
				return $this->Execute(sprintf("
				UPDATE
					`products`
				SET
					`Discontinued`=%s,
					`Active`=%s,
					`Title`='%s',
					`Images`='%s',
					`Collection_ID`=%s,
					`Category_ID`=%s,
					`Currency`='%s',
					`GrossProfit`=%s,
					`RetailPrice`=%s,
					`NetPrice`=%s,
					`GrossPrice`=%s,
					`ProfitMargin`=%s,
					`Discount`=%s,
					`DiscountType`=%s,
					`DiscountAmount`=%s,
					`Container_ID`=%s,
					`Wick_ID`=%s,
					`WickStand_ID`=%s,
					`Material_ID`=%s,
					`Fragrance_ID`=%s,
					`Colour_ID`=%s,
					`Packaging_ID`=%s,
					`Shipping_ID`=%s,
					`DescriptionShort`='%s',
					`DescriptionLong`='%s',
					`Slug`='%s',
					`made_by_ID`=%s
				WHERE
					`SKU`=%s",
					$info['discontinued'],
					$info['active'],
					$info['title'],
					$info['images'],
					$info['collection'],
					$info['category'],
					$info['currency'],
					$info['profit'],
					$info['retail'],
					$info['net'],
					$info['gross'],
					$info['markup'],
					$info['discounted'],
					$info['discount_type'],
					$info['discount_amount'],
					$info['container'],
					$info['wick'],
					$info['wick_stand'],
					$info['material'],
					$info['fragrance'],
					$info['colour'],
					$info['packaging'],
					$info['shipping'],
					$info['description_short'],
					$info['description_long'],
					$info['slug'],
					$info['made_by'],
					$sku
				), 1);
			}
		/** createUPC
		 * 
		 *	@return string
		 */
			public function createUPC(string $sku) {
				$numberSystem = 7;
				$manufacturer = $this->Execute(sprintf("SELECT `Reference` FROM `partners` WHERE `ID`='%s'", $info['made_by']), 3)['Reference'];
				$productCode = $this->Execute("SELECT `SKU` FROM `products` ORDER BY SKU DESC LIMIT 1", 3)['SKU'];
				$i=1;
				foreach(str_split($numberSystem.$manufacturer.$productCode) as $int) {
					if($i % 2 == 0) {
						$even += $int;
					} else {
						$odd += $int;
					}
					$i++;
				}
				print(($odd*3)+$even);
				return $numberSystem . $manufacturer . $productCode . $checkCode;
			}
		/** createUPC
		 * 
		 *	@return string
		 */
			public function createSKU() {
				if($this->Execute($q = "SELECT `SKU` FROM `products` ORDER BY SKU DESC LIMIT 1", 5)>0) {
					return $this->Execute($q = "SELECT `SKU` FROM `products` ORDER BY SKU DESC LIMIT 1", 5)['SKU'] + 1;
				} else {
					return 10001;
				}
			}
		/** createProduct
		 * 
		 * 
		 */
			public function createProduct(string $sku, array $info) {
				$this->Execute(sprintf("INSERT INTO `products`(`SKU`, `Discontinued`, `Active`, `Title`, `Images`, `Collection_ID`, `Category_ID`, `Currency`, `GrossProfit`, `RetailPrice`, `NetPrice`, `GrossPrice`, `ProfitMargin`, `Discount`, `DiscountType`, `DiscountAmount`, `Container_ID`, `Wick_ID`, `WickStand_ID`, `Material_ID`, `Fragrance_ID`, `Colour_ID`, `Packaging_ID`, `Shipping_ID`, `DescriptionShort`, `DescriptionLong`, `Slug`, `made_by_ID` ) VALUES ( '%s', %s, %s, '%s', '%s', %s, %s, '%s', %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, '%s', '%s', '%s', %s )",
					$sku,
					$info['discontinued'],
					$info['active'],
					$info['title'],
					$info['images'],
					$info['collection'],
					$info['category'],
					$info['currency'],
					$info['profit'],
					$info['retail'],
					$info['net'],
					$info['gross'],
					$info['markup'],
					$info['discounted'],
					$info['discount_type'],
					$info['discount_amount'],
					$info['container'],
					$info['wick'],
					$info['wick_stand'],
					$info['material'],
					$info['fragrance'],
					$info['colour'],
					$info['packaging'],
					$info['shipping'],
					$info['description_short'],
					$info['description_long'],
					$info['slug'],
					$info['made_by']
				), 1);
				print($q);
			}
	}
?>