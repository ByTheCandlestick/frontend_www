<?php
	// Require fpdf PHP library
	require_once(__ROOT__ . '/Vendor/fpdf/1.85/init.php');
	class PDF Extends FPDF {
		public $dev_outline = 0;
		public $fs_h1 = 32;
		public $fs_h2 = 24;
		public $fs_h3 = 20.8;
		public $fs_h4 = 16;
		public $fs_h5 = 12.8;
		public $fs_h6 = 11.2;
		public $fs_p = 16;

		public function __construct() {
			/*
				$this->AddFont('Raleway', 'B', 'Raleway-Bold.php');
				$this->AddFont('Raleway', 'I', 'Raleway-Italics.php');
				$this->AddFont('Raleway', 'BI', 'Raleway-Bold-Italic.php');
				$this->AddFont('Raleway-Thin', '', 'Raleway-Thin.php');
				$this->AddFont('Raleway-Thin', 'B', 'Raleway-Thin-Bold.php');
				$this->AddFont('Raleway-Thin', 'I', 'Raleway-Thin-Italic.php');
				$this->AddFont('Raleway-Thin', 'BI', 'Raleway-Thin-Bold-Italic.php');
			*/
		}
		public function GetStringHeight(int $fs) {
			return $fs / 3;
		}
		function InvoiceTable($header, $w, $data, $posx, $posy, $drawCol = array(0, 0, 0), $textCol = array(0, 0, 0)) {
			$this->SetFont('Raleway', '');
			$this->SetDrawColor($drawCol[0], $drawCol[1], $drawCol[2]);
			$this->SetTextColor($textCol[0], $textCol[1], $textCol[2]);
			// Header
			$this->SetLineWidth(0.5);
			$this->SetXY($posx, $posy);
			$this->Cell($w[0],7,$header[0],'B',0,'L');
			$this->Cell($w[1],7,$header[1],'B',0,'C');
			$this->Cell($w[2],7,$header[2],'B',0,'R');
			$this->Cell($w[3],7,$header[3],'B',0,'R');
			$this->SetLineWidth(0.25);
			// Data
			$posy++;
			foreach($data as $row) {
				if($row[0] == "totalRow") {
					$this->SetFont('Raleway', 'B');
					$this->SetXY($posx, $posy=$posy + 6);
					$this->Cell($w[0], 6, $row[0], 'B', 0, 'L');
					$this->Cell($w[1], 6, $row[1], 'B', 0, 'C');
					$this->Cell($w[2], 6, $row[2], 'B', 0, 'R');
					$this->Cell($w[3], 6, $row[3], 'B', 0, 'R');
				} else {
					$this->SetFont('Raleway', '');
					$this->SetXY($posx, $posy=$posy + 6);
					$this->Cell($w[0], 6, '', 'B', 0, 'L');
					$this->Cell($w[1], 6, '', 'B', 0, 'C');
					$this->Cell($w[2], 6, 'Totals', 'B', 0, 'R');
					$this->Cell($w[3], 6, $row[1], 'B', 0, 'R');
				}
			}
			// Closing line
			$this->SetXY($posx, $posy=$posy + 6);
			$this->Cell(array_sum($w),0,'','T');
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
							if(!isset($arr_docs_info['inv']) || $arr_docs_info['inv']=="") throw new Error("ERR-DCS-1");
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

							$invoice = $mdl_docs->getOrderInfo($arr_docs_info['inv']);
							$headers = array('Name', 'Quantity', 'Price ea', 'Subtotal');
							$widths = array(130, 20, 20, 30);
							$items = $mdl_docs->getItemInfo($invoice['Items']);
							$tableColour = array(28, 92, 147);
							$textColor = array(28, 92, 147);
							//
							// Initialize
							$pdf = new PDF();
							
							$pdf->AddFont('Raleway', '');

							$pdf->SetDisplayMode('default', 'two');
							$pdf->AliasNbPages();
							// Create first page
							$pdf->AddPage();
							// Header
								// Logo
									$pdf->Image(__ROOT__.'/images/partners/candlestick/logo.png', 10, 5, 20);
								// Company Name
									$pdf->SetTextColor(28, 92, 147);
									$pdf->SetFont('Raleway', '', $pdf->fs_h1);
									$pdf->SetXY($pdf->GetPageWidth()-($pdf->GetStringWidth($tx_company)+5), 13);
									$pdf->Cell($pdf->GetStringWidth($tx_company), $pdf->GetStringHeight($pdf->fs_h1), $tx_company, $pdf->dev_outline, 0, "C");
								// Website
									$pdf->SetTextColor(255, 127, 0);
									$pdf->SetFont('Raleway', '', $pdf->fs_h6);
									$pdf->SetXY(5, 30);
									$pdf->Cell($pdf->GetStringWidth($tx_website), $pdf->GetStringHeight($pdf->fs_h6), $tx_website, $pdf->dev_outline, 0, "C");
								// Customer details
								// Items
									$pdf->SetFont('Raleway', '', $pdf->fs_h6);
									$pdf->SetXY($pdf->GetPageWidth()-($pdf->GetStringWidth($tx_elems_str = join(" | ", $tx_elems))+5), 30);
									$c = count($tx_elems);
									for($i=0; $i<$c; $i++) {
										$pdf->SetTextColor(255, 127, 0);
										$pdf->Cell($pdf->GetStringWidth($tx_elems[$i]), $pdf->GetStringHeight($pdf->fs_h6), $tx_elems[$i], $pdf->dev_outline, 0, "C");
										if($i != ($c-1)) {
											$pdf->SetTextColor(28, 92, 147);
											$pdf->Cell($pdf->GetStringWidth(" | "), $pdf->GetStringHeight($pdf->fs_h6), " | ", $pdf->dev_outline, 0, "C");
										}
									}
								// Divider
									$pdf->Line(5, 35, $pdf->GetPageWidth()-5, 35);
							// Content
								// Invoice ID
								// Invoice Date
								// invoice Table
									$pdf->InvoiceTable($headers, $widths, $items,5, 50, $tableColour, $textColor);
							// Footer
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