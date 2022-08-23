<?php
	class ImagesController extends BaseController {
		/** "/Images/Upload" Endpoint
		 *	@final Complete
		 *	@return JSON
		 */
		public function create(array $image_vars) {
			// Vars
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_user_info = $this->getQueryStringParams();
				$str_response = "";
				(isset($image_vars[0]) && $image_vars[0] !== "")? $i_width		= $image_vars[0] : $i_width			= 1000;
				(isset($image_vars[1]) && $image_vars[1] !== "")? $i_height		= $image_vars[1] : $i_height		= 500;
				(isset($image_vars[2]) && $image_vars[2] !== "")? $i_background	= $image_vars[2] : $i_background	= "344A4C";
				(isset($image_vars[3]) && $image_vars[3] !== "")? $i_text		= explode('&crlf;', $image_vars[3]) : $i_text = "$i_width x $i_height";
				(isset($image_vars[4]) && $image_vars[4] !== "")? $i_colour		= $image_vars[4] : $i_colour		= "FF860D";
				if(!isset($image_vars[0]) || $image_vars[0] == "") {
					$i_text	= array(
						"How to use this API script",
						"",
						"",
						" How to: /{int Width}/{int Height}/{str Background}/{str Text}/{str Colour}/",
						"",
						"Example: /    1000   /     500    /     87919E     /  Example /   ff860d   /"
					);
				}
				// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
					/**/if(strtoupper($requestMethod) == "GET"):	// (R)EAD		-- 🗹 --	Display images
						// Submit application
							try {
								$img = imagecreate($i_width, $i_height);
								// Background colour
									list($i_background_r, $i_background_g, $i_background_b) = sscanf($i_background, "%02x%02x%02x");
									$bg = imagecolorallocate($img, $i_background_r, $i_background_g, $i_background_b);
								// Foreground colour
									list($i_colour_r, $i_colour_g, $i_colour_b) = sscanf($i_colour, "%02x%02x%02x");
									$fg = imagecolorallocate($img, $i_colour_r, $i_colour_g, $i_colour_b);
								// Image Text
									if(is_array($i_text)) {
										$txt_offset = ($i_height / 2) - ((count($i_text) * 16) / 2);
										for($i=0; $i < count($i_text);$i++) {
											$img_txt_al_x = (($i_width / 2) - ((strlen($i_text[$i])*9) / 2));
											$img_txt_al_y = ($i * 16) + $txt_offset;
											imagestring( $img, 5, $img_txt_al_x, $img_txt_al_y, $i_text[$i], $fg );
										}
									} else {
										$img_txt_al_x = (($i_width / 2) - ((strlen($i_text)*9) / 2));
										$img_txt_al_y = (($i_height / 2) - 5);
										imagestring( $img, 5, $img_txt_al_x, $img_txt_al_y, $i_text, $fg );
									}
								ob_start();
								imagepng($img);
								$str_response = ob_get_contents();
							} catch(Error $er) {
								$this->throwError($er->getMessage(), "HTTP/1.1 404 Not Found");
							}
						//
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
						array("Content-Type: image/png","HTTP/1.1 200 OK")
					);
				// End of function
		}
		/** "/Images/Fetch" Endpoint
		 *	@todo
		 *	@return JSON
		 */
		public function fetch(array $image_vars) {
			$i_title = $image_vars[0];
			if(isset($image_vars[1])) {
				$i_format = $image_vars[1];
			}
			if(isset($image_vars[2])) {
				List($c_sizes, $c_align) = explode('_', $image_vars[2]);
				List($i_width, $i_height) = explode('x', $c_sizes);
				List($i_alignX, $i_alignY) = explode('-', $c_align);
			}
			// Vars
				$arr_user_info = $this->getQueryStringParams();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗷 --	Unknown
						$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Display images
					// Confirmations
						(isset($i_format))?				$change['format'] = true	: $change['format'] = false;
						(isset($i_width, $i_height))?	$change['size'] = true		: $change['size'] = false;
					// Submit
						$mdl_Image = new ImageModel();
						// Get file location
							$i = $mdl_Image->ReadFIle($i_title);
						// Resize the image
							if($change['size']) {
								// size
							}
						// Change the format of the image
							if($change['format']) {
								// format
							}
						// Submit request
						try {
							if($i_title !== null):
								// Get the image ctype
									$filename = basename($i['location']);
									$file_extension = strtolower(substr(strrchr($filename,"."),1));
									switch($file_extension) {
										case "webp":	$ctype="image/webp";	break;
										case "jxr":		$ctype="image/jxr";		break;
										case "png":		$ctype="image/png";		break;
										case "jpeg":	$ctype="image/jpeg";	break;
										case "jpg":		$ctype="image/jpeg";	break;
										case "gif":		$ctype="image/gif";		break;
										default:
									}
								// Get the image
								$str_response	= file_get_contents(__ROOT__.$i['location']);
								$arr_http		= array("Content-Type: ".$ctype,
														"Content-Length: " . filesize(__ROOT__.$i['location']),
														"HTTP/1.1 200 OK");
							else:
								throw new Error('No image selected');
							endif;
						} catch(Error $er) {
							$this->throwError($er->getMessage(), "HTTP/1.1 404 Not Found");
						}
					//
				elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					$arr_http
				);
			// End of function
		}
		/** "/Images/Upload" Endpoint
		 *	@todo
		 *	@return JSON
		 */
		public function Upload() {
			// Vars
				$mdl_Image = new ImageModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_user_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- ☐ --	Create new image
					// Confirmations
					// Validation
					// Submit application
					//
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