<?php
	// Require fpdf PHP library
	require_once(__ROOT__ . '/Vendor/fpdf/1.85/init.php');
	class PDF extends FPDF {
		function Header() {	// Page header
			$this->Image('../../../images/partners/candlestick/logo.png',10,6,30);
			$this->SetFont('Arial','B',15);
			$this->Cell(80);
			$this->Cell(30,10,'Title',1,0,'C');
			$this->Ln(20);
		}
		function Footer() {	// Page footer
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
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
							// Initialize
							$pdf = new PDF();
							$pdf->SetFont('Arial', 'B', 16);
							// Create first page
							$pdf->AddPage();
							// Add content

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