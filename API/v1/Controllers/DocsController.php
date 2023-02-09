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

		public function GetStringHeight(int $fs) {
			return ceil($fs/3)+1;
		}
		function InvoiceTable($header, $w, $data, $posx, $posy, $drawCol = array(0, 0, 0), $textCol = array(0, 0, 0), $fontSize) {
			$this->SetDrawColor($drawCol[0], $drawCol[1], $drawCol[2]);
			$this->SetTextColor($textCol[0], $textCol[1], $textCol[2]);
			// Header
			$this->SetLineWidth(0.5);
			$this->SetXY($posx, $posy);
			$this->Cell($w[0],7,$header[0],'B',0,'L');
			$this->Cell($w[1],7,$header[1],'B',0,'C');
			$this->Cell($w[2],7,$header[2],'B',0,'R');
			$this->Cell($w[3],7,$header[3],'B',0,'R');
			$this->SetLineWidth(0.2);
			// Data
			$posy++;
			foreach($data as $row) {
				if($row[0] == "savingsRow") {
					$this->SetFont('Raleway', 'B', $fontSize);
					$this->SetXY($posx, $posy=$posy + 6);
					$this->Cell($w[0], 6, '', 'B', 0, 'L');
					$this->Cell($w[1], 6, '', 'B', 0, 'C');
					$this->Cell($w[2], 6, 'Savings:', 'B', 0, 'R');
					$this->Cell($w[3], 6, number_format(floatval($row[1]), 2), 'B', 0, 'R');
				} else if($row[0] == "totalRow") {
					$this->SetFont('Raleway', 'B', $fontSize);
					$this->SetXY($posx, $posy=$posy + 6);
					$this->Cell($w[0], 6, '');
					$this->Cell($w[1], 6, '');
					$this->Cell($w[2], 6, 'Total:', 0, 0, 'R');
					$this->Cell($w[3], 6, number_format(floatval($row[1]), 2), 0, 0, 'R');
				} else {
					$this->SetFont('Raleway', '', $fontSize);
					$this->SetXY($posx, $posy=$posy + 6);
					$this->Cell($w[0], 6, $row[0], 'B', 0, 'L');
					$this->Cell($w[1], 6, number_format(floatval($row[1])), 'B', 0, 'C');
					$this->Cell($w[2], 6, number_format(floatval($row[2]), 2), 'B', 0, 'R');
					$this->Cell($w[3], 6, number_format(floatval($row[3]), 2), 'B', 0, 'R');
				}
			}
			// Closing line
			$this->SetXY($posx, $posy=$posy + 6);
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
							$items = $mdl_docs->getItemInfo($invoice['Items']);
							$address = $mdl_docs->getUserAddress($invoice['Billing address']);
							$headers = array('Name', 'Quantity', 'Price ea', 'Subtotal');
							$widths = array(120, 20, 20, 30);
							$tableColour = array(51, 51, 51);
							$textColor = array(28, 92, 147);
							// Initialize
							$pdf = new PDF();
							$pdf->SetDisplayMode('default', 'two');
							$pdf->AliasNbPages();
							// Fonts
							$pdf->AddFont('Raleway', '', 'raleway.php', 1);
							$pdf->AddFont('Raleway', 'B', 'ralewayb.php', 1);
							$pdf->AddFont('Raleway', 'I', 'ralewayi.php', 1);
							$pdf->AddFont('Raleway', 'BI', 'ralewaybi.php', 1);
							$pdf->AddFont('RalewayThin', '', 'ralewayt.php', 1);
							$pdf->AddFont('RalewayThin', 'B', 'ralewaytb.php', 1);
							$pdf->AddFont('RalewayThin', 'I', 'ralewayti.php', 1);
							$pdf->AddFont('RalewayThin', 'BI', 'ralewaytbi.php', 1);
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
								$pdf->SetTextColor(28, 92, 147);
								// Invoice Date / ID
									$pdf->SetFont('Raleway', 'B', $pdf->fs_p);
									$pdf->SetXY($pdf->GetPageWidth()-($pdf->GetStringWidth($invoice['Invoice ID'])+10), 40);
									$pdf->Cell($pdf->GetStringWidth($invoice['Invoice ID']), $pdf->GetStringHeight($pdf->fs_p), $invoice['Invoice ID'], $pdf->dev_outline, 2, "R");
									$dt = new DateTime($invoice['Created']);
									$date = $dt->format('dS F Y');
									$pdf->SetFont('Raleway', '', $pdf->fs_h5);
									$pdf->SetXY($pdf->GetPageWidth()-($pdf->GetStringWidth($date)+10), 46);
									$pdf->Cell($pdf->GetStringWidth($date), $pdf->GetStringHeight($pdf->fs_h5), $date, $pdf->dev_outline, 2, "R");
								// Customer details

									$pdf->SetXY(10, 40);
									$pdf->SetFont('Raleway', 'B', $pdf->fs_p);
									$pdf->Cell($pdf->GetStringWidth($invoice['Name']), $pdf->GetStringHeight($pdf->fs_p), $invoice['Name'], $pdf->dev_outline, 2, "L");
									$pdf->SetFont('Raleway', '', $pdf->fs_h5);
									$pdf->Cell($pdf->GetStringWidth($address['number_name'].' '.$address['line_1']), $pdf->GetStringHeight($pdf->fs_h5), $address['number_name'].' '.$address['line_1'], $pdf->dev_outline, 2, "L");
									$pdf->Cell($pdf->GetStringWidth($address['line_2']), $pdf->GetStringHeight($pdf->fs_h5), $address['line_2'], $pdf->dev_outline, 2, "L");
									$pdf->Cell($pdf->GetStringWidth($address['town']), $pdf->GetStringHeight($pdf->fs_h5), $address['town'], $pdf->dev_outline, 2, "L");
									//$pdf->Cell($pdf->GetStringWidth($address['county']), $pdf->GetStringHeight($pdf->fs_h5), $address['county'], $pdf->dev_outline, 2, "L");
									//$pdf->Cell($pdf->GetStringWidth($address['country']), $pdf->GetStringHeight($pdf->fs_h5), $address['country'], $pdf->dev_outline, 2, "L");
									$pdf->Cell($pdf->GetStringWidth($address['postcode']), $pdf->GetStringHeight($pdf->fs_h5), $address['postcode'], $pdf->dev_outline, 2, "L");
									$pdf->Cell($pdf->GetStringWidth($invoice['Email']), $pdf->GetStringHeight($pdf->fs_h5), $invoice['Email'], $pdf->dev_outline, 2, "L");
									$pdf->Cell($pdf->GetStringWidth($invoice['Phone']), $pdf->GetStringHeight($pdf->fs_h5), $invoice['Phone'], $pdf->dev_outline, 2, "L");
								// invoice Table
									$pdf->InvoiceTable($headers, $widths, $items, 10, 80, $tableColour, $textColor, $this->fs_h6);
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