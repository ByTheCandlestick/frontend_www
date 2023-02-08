<?php
	// Require fpdf PHP library
	require_once(__ROOT__ . '/Vendor/fpdf/1.85/init.php');
	class PDF Extends FPDF {
		public $dev_outline = 1;
		public $fs_h1 = 32;
		public $fs_h2 = 24;
		public $fs_h3 = 20.8;
		public $fs_h4 = 16;
		public $fs_h5 = 12.8;
		public $fs_h6 = 11.2;
		public $fs_p = 16;

		public function GetStringHeight(int $fs) {
			return $fs / 3;
		}
	}
	class DocsController extends BaseController {
		/** "/Docs/Invoice/" Endpoint - Get list of Products
		 *	
		 *	@return JSON
		 */
		public function Invoice() {
			// Vars
				$mdl_docs = new DocsModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_docs_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE	-- 🗹 --	Unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "GET"):	// (R)EAD	-- 🗷 --	Get the users invoice
					// Confirmations
						try{

						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Validation
						try{
							// Nothing to validate
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					// Submit application
						try{
							// Vars
							$al_left = 5;
							$tx_company = "The Candlestick";
							$tx_website = "www.thecandlestick.co.uk";
							$tx_elems = [
								"Candles",
								"Wax melts",
								"Soaps",
								"Scrubs",
								"Bath Bombs"
							];

							// Initialize
							$pdf = new PDF();
							$pdf->AddFont('Raleway', '', 'Raleway-Regular.php', 1);

							$pdf->AliasNbPages();
							// Create first page
							$pdf->AddPage();
							// Add content
								// Logo
								$pdf->Image(__ROOT__.'/images/partners/candlestick/logo.png', 10, 5, 20);
								// Company Name
								$str = $tx_company;
								$wid = $pdf->GetStringWidth($str);
								$al_right = $pdf->GetPageWidth()-($wid+5);
								$pdf->SetXY($al_right, 10);
								$pdf->SetFont('Raleway', '', $pdf->fs_h1);
								$pdf->SetTextColor(28, 92, 147);
								$pdf->Cell($wid, $pdf->GetStringHeight($pdf->fs_h1), $str, $pdf->dev_outline, 0, "C");
								$str=$wid=$al_right='';
								/*
								// Website
								$str = $tx_website;
								$al_right = $pdf->GetPageWidth() - $pdf->GetStringWidth($str);
								$pdf->SetXY($al_right, 30);
								$pdf->SetFont('Raleway', '', $pdf->fs_h6);
								$pdf->SetTextColor(255, 127, 0);
								$pdf->Cell($pdf->GetStringWidth($str), $pdf->GetStringHeight($pdf->fs_h6), $str, $pdf->dev_outline, 0, "C");
								$str=$al_right='';
								// Sale items
								$str = $tx_elems_str = join(" | ", $tx_elems);
								$al_right = $pdf->GetPageWidth()-($pdf->GetStringWidth($str)+5);
								$pdf->SetXY($al_right, 30);
								$pdf->SetFont('Raleway', '', $pdf->fs_h6);
								$c = count($tx_elems);
								for($i=0; $i<$c; $i++) {
									$pdf->SetTextColor(255, 127, 0);
									$pdf->Cell($pdf->GetStringWidth($tx_elems[$i]), $pdf->GetStringHeight($pdf->fs_h6), $tx_elems[$i], $pdf->dev_outline, 0, "C");
									if($i != ($c-1)) {
										$pdf->SetTextColor(28, 92, 147);
										$pdf->Cell($pdf->GetStringWidth(" | "), $pdf->GetStringHeight($pdf->fs_h6), " | ", $pdf->dev_outline, 0, "C");
									}
								}
								$str=$al_right='';
								*/
								//
							// Output document
							$pdf->Output();
						} catch(Error $er) {
							exit($this->throwError($er->getMessage(), $er->getLine(), $er->getFile(), $er->getTrace(), "HTTP/1.1 500 Internal Server Error"));
						}
					//
				elseif(strtoupper($requestMethod) == "POST"):	// (U)PDATE	-- 🗷 --	Unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE	-- 🗷 --	Unsupported
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:
					$this->throwError("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
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