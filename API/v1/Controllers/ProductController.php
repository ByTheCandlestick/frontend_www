<?php
	class ProductController extends BaseController {
		/** "/Product/" Endpoint
		 *	@todo
		 *	@return JSON
		 */
		public function Product() {
			// Vars
				$mdl_product = new ProductModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_product_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					// Confirmations
						try {
							if(!isset($arr_product_info['title']))				Throw new Error('ERR-PRD-1');
							if(!isset($arr_product_info['collection']))			Throw new Error('ERR-PRD-2');
							if(!isset($arr_product_info['images']))				Throw new Error('ERR-PRD-3');
							if(!isset($arr_product_info['category']))			Throw new Error('ERR-PRD-4');
							if(!isset($arr_product_info['discontinued']))		Throw new Error('ERR-PRD-5');
							if(!isset($arr_product_info['active']))				Throw new Error('ERR-PRD-6');
							if(!isset($arr_product_info['currency']))			Throw new Error('ERR-PRD-7');
							if(!isset($arr_product_info['profit']))				Throw new Error('ERR-PRD-8');
							if(!isset($arr_product_info['retail']))				Throw new Error('ERR-PRD-9');
							if(!isset($arr_product_info['net']))				Throw new Error('ERR-PRD-10');
							if(!isset($arr_product_info['gross']))				Throw new Error('ERR-PRD-11');
							if(!isset($arr_product_info['margin']))				Throw new Error('ERR-PRD-12');
							if(!isset($arr_product_info['discounted']))			Throw new Error('ERR-PRD-13');
							if(!isset($arr_product_info['auto_calculate']))		Throw new Error('ERR-PRD-14');
							if(!isset($arr_product_info['discount_type']))		Throw new Error('ERR-PRD-15');
							if(!isset($arr_product_info['discount_amount']))	Throw new Error('ERR-PRD-16');
							if(!isset($arr_product_info['container']))			Throw new Error('ERR-PRD-17');
							if(!isset($arr_product_info['wick']))				Throw new Error('ERR-PRD-18');
							if(!isset($arr_product_info['wick_stand']))			Throw new Error('ERR-PRD-19');
							if(!isset($arr_product_info['material']))			Throw new Error('ERR-PRD-20');
							if(!isset($arr_product_info['fragrance']))			Throw new Error('ERR-PRD-21');
							if(!isset($arr_product_info['colour']))				Throw new Error('ERR-PRD-22');
							if(!isset($arr_product_info['packaging']))			Throw new Error('ERR-PRD-23');
							if(!isset($arr_product_info['shipping']))			Throw new Error('ERR-PRD-24');
							if(!isset($arr_product_info['made_by']))			Throw new Error('ERR-PRD-25');
							if(!isset($arr_product_info['description_long']))	Throw new Error('ERR-PRD-26');
							if(!isset($arr_product_info['description_short']))	Throw new Error('ERR-PRD-27');
							if(!isset($arr_product_info['slug']))				Throw new Error('ERR-PRD-28');
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validations
						try {
							if(!$mdl_product->validateTitle($arr_product_info['title']))			Throw new Error('ERR-PRD-29');
							if(!$mdl_product->validateCollection($arr_product_info['collection']))	Throw new Error('ERR-PRD-30');
							if(!$mdl_product->validateImages($arr_product_info['images']))			Throw new Error('ERR-PRD-31');
							if(!$mdl_product->validateCategory($arr_product_info['category']))		Throw new Error('ERR-PRD-32');
							if(!$mdl_product->validateCurrency($arr_product_info['currency']))		Throw new Error('ERR-PRD-33');
							if(!$mdl_product->validateContainer($arr_product_info['container']))	Throw new Error('ERR-PRD-34');
							if(!$mdl_product->validateWick($arr_product_info['wick']))				Throw new Error('ERR-PRD-35');
							if(!$mdl_product->validateWickStand($arr_product_info['wick_stand']))	Throw new Error('ERR-PRD-36');
							if(!$mdl_product->validateMaterial($arr_product_info['material']))		Throw new Error('ERR-PRD-37');
							if(!$mdl_product->validateFragrance($arr_product_info['fragrance']))	Throw new Error('ERR-PRD-38');
							if(!$mdl_product->validateColour($arr_product_info['colour']))			Throw new Error('ERR-PRD-39');
							if(!$mdl_product->validatePackaging($arr_product_info['packaging']))	Throw new Error('ERR-PRD-40');
							if(!$mdl_product->validateShipping($arr_product_info['shipping']))		Throw new Error('ERR-PRD-41');
							if(!$mdl_product->validateMadeBy($arr_product_info['made_by']))			Throw new Error('ERR-PRD-42');
							if(!$mdl_product->validateSlug($arr_product_info['slug']))				Throw new Error('ERR-PRD-43');
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit
						try {
							if($mdl_product->createProduct($sku = $mdl_product->createSKU(), $mdl_product->createUPC($sku, $arr_product_info), $arr_product_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								Throw new Error('ERR-PRD-44');
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Product/{ID}" Endpoint
		 *	@todo
		 *	@return JSON
		 */
		public function ProductByID($sku) {
			// Vars
				$mdl_product = new ProductModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_product_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Get product info
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Update propduct info
					// Confirmations
						try {
							if(!isset($arr_product_info['title']))				Throw new Error('ERR-PRD-1');
							if(!isset($arr_product_info['collection']))			Throw new Error('ERR-PRD-2');
							if(!isset($arr_product_info['images']))				Throw new Error('ERR-PRD-3');
							if(!isset($arr_product_info['category']))			Throw new Error('ERR-PRD-4');
							if(!isset($arr_product_info['discontinued']))		Throw new Error('ERR-PRD-5');
							if(!isset($arr_product_info['active']))				Throw new Error('ERR-PRD-6');
							if(!isset($arr_product_info['currency']))			Throw new Error('ERR-PRD-7');
							if(!isset($arr_product_info['profit']))				Throw new Error('ERR-PRD-8');
							if(!isset($arr_product_info['retail']))				Throw new Error('ERR-PRD-9');
							if(!isset($arr_product_info['net']))				Throw new Error('ERR-PRD-10');
							if(!isset($arr_product_info['gross']))				Throw new Error('ERR-PRD-11');
							if(!isset($arr_product_info['margin']))				Throw new Error('ERR-PRD-12');
							if(!isset($arr_product_info['discounted']))			Throw new Error('ERR-PRD-13');
							if(!isset($arr_product_info['auto_calculate']))		Throw new Error('ERR-PRD-14');
							if(!isset($arr_product_info['discount_type']))		Throw new Error('ERR-PRD-15');
							if(!isset($arr_product_info['discount_amount']))	Throw new Error('ERR-PRD-16');
							if(!isset($arr_product_info['container']))			Throw new Error('ERR-PRD-17');
							if(!isset($arr_product_info['wick']))				Throw new Error('ERR-PRD-18');
							if(!isset($arr_product_info['wick_stand']))			Throw new Error('ERR-PRD-19');
							if(!isset($arr_product_info['material']))			Throw new Error('ERR-PRD-20');
							if(!isset($arr_product_info['fragrance']))			Throw new Error('ERR-PRD-21');
							if(!isset($arr_product_info['colour']))				Throw new Error('ERR-PRD-22');
							if(!isset($arr_product_info['packaging']))			Throw new Error('ERR-PRD-23');
							if(!isset($arr_product_info['shipping']))			Throw new Error('ERR-PRD-24');
							if(!isset($arr_product_info['made_by']))			Throw new Error('ERR-PRD-25');
							if(!isset($arr_product_info['description_long']))	Throw new Error('ERR-PRD-26');
							if(!isset($arr_product_info['description_short']))	Throw new Error('ERR-PRD-27');
							if(!isset($arr_product_info['slug']))				Throw new Error('ERR-PRD-28');
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validations
						try {
							if(!$mdl_product->validateTitle($arr_product_info['title']))			Throw new Error('ERR-PRD-29');
							if(!$mdl_product->validateCollection($arr_product_info['collection']))	Throw new Error('ERR-PRD-30');
							if(!$mdl_product->validateImages($arr_product_info['images']))			Throw new Error('ERR-PRD-31');
							if(!$mdl_product->validateCategory($arr_product_info['category']))		Throw new Error('ERR-PRD-32');
							if(!$mdl_product->validateCurrency($arr_product_info['currency']))		Throw new Error('ERR-PRD-33');
							if(!$mdl_product->validateContainer($arr_product_info['container']))	Throw new Error('ERR-PRD-34');
							if(!$mdl_product->validateWick($arr_product_info['wick']))				Throw new Error('ERR-PRD-35');
							if(!$mdl_product->validateWickStand($arr_product_info['wick_stand']))	Throw new Error('ERR-PRD-36');
							if(!$mdl_product->validateMaterial($arr_product_info['material']))		Throw new Error('ERR-PRD-37');
							if(!$mdl_product->validateFragrance($arr_product_info['fragrance']))	Throw new Error('ERR-PRD-38');
							if(!$mdl_product->validateColour($arr_product_info['colour']))			Throw new Error('ERR-PRD-39');
							if(!$mdl_product->validatePackaging($arr_product_info['packaging']))	Throw new Error('ERR-PRD-40');
							if(!$mdl_product->validateShipping($arr_product_info['shipping']))		Throw new Error('ERR-PRD-41');
							if(!$mdl_product->validateMadeBy($arr_product_info['made_by']))			Throw new Error('ERR-PRD-42');
							if(!$mdl_product->validateSlug($arr_product_info['slug']))				Throw new Error('ERR-PRD-43');
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit
						try {
							if($mdl_product->updateProduct($sku, $arr_product_info)) {	// Success
								$str_response = json_encode(array('status'=>'success'));
							} else {		// Error submitting
								Throw new Error('ERR-PRD-44');
							}
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), "HTTP/1.1 500 Internal Server Error"));
						}
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Delete product
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
	}
?>