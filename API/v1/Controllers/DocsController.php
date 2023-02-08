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
							$pdf->tx_company_strlen('default', 'two');
							$pdf->AliasNbPages();
							// Create first page
							$pdf->AddPage();
							// Add content
								// Logo
								$pdf->Image(__ROOT__.'/images/partners/candlestick/logo.png', 10, 5, 20);
								// Company Name
								$tx_company_strlen = $pdf->GetStringWidth($pdf->tx_company);
								$left = $pdf->GetPageWidth()-($tx_company_strlen+5);
								$pdf->SetXY($left, 10);
								$pdf->SetFont('Raleway', '', $pdf->fs_h1);
								$pdf->SetTextColor(28, 92, 147);
								$pdf->Cell($tx_company_strlen, $pdf->GetStringHeight($pdf->fs_h1), $tx_company, $pdf->dev_outline, 1, "R");
								// Website
								$pdf->SetXY(5, 25);
								$pdf->SetFont('Raleway', '', $pdf->fs_h6);
								$pdf->SetTextColor(255, 127, 0);
								$pdf->Cell(($pdf->GetPageWidth()-10)/2, $pdf->GetStringHeight($pdf->fs_h1), $tx_website, $pdf->dev_outline, 0, "L");
								// Sale items
								$tx_elems_strlen = $pdf->GetStringWidth($tx_elems_str = join(" | ", $tx_elems));
								$left = $pdf->GetPageWidth()-($tx_elems_strlen+5);
								$pdf->SetXY($left, 25);
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