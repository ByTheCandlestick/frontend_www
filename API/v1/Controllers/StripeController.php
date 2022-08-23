<?php
	class StripeController extends BaseController {
		/** "/Stripe/" Endpoint
		 *	@final
		 *	@return JSON
		 */
		public function SecurePayment() {
			// Vars
				$mdl_stripe = new StripeModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_stripe_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗹 --	Create a transaction
					if (!empty($arr_stripe_info['stripeToken'])) {
						// Retrieve stripe token and user info from the submitted form
							$fname		= $arr_stripe_info['firstname'];
							$lname		= $arr_stripe_info['lastname'];
							$postcode	= $arr_stripe_info['postcode'];
							$number		= $arr_stripe_info['number'];
							$address1	= $arr_stripe_info['address1'];
							$address2	= $arr_stripe_info['address2'];
							$town		= $arr_stripe_info['town'];
							$county		= $arr_stripe_info['county'];
							$country	= $arr_stripe_info['country'];
							$email		= $arr_stripe_info['email'];
							$phone		= $arr_stripe_info['phone'];
							$stripe_pubKey = $arr_stripe_info['STRIPE_PUBLISHABLE_KEY'];
							$currency	= $arr_stripe_info['currency'];
							$price		= $arr_stripe_info['price'];
							$uid		= $arr_stripe_info['uid'];
							$token		= $arr_stripe_info['stripeToken'];
							$items		= $arr_stripe_info['items'];
							$notes		= $arr_stripe_info['notes'];
		
							$description= 'The Candlestick order: '.$arr_stripe_info['items'];
							$payment_id	= $statusMsg = '';
							list($pounds, $pennies) = explode('.',$price);
							$pricePennies = $pounds.($pennies<10?'0'.$pennies:$pennies);
							$name = $fname . ' ' . $lname;
						// Require Stripe PHP library and set the API key 
							require_once(__ROOT__ . '/vendor/StripeSecure/init.php');
							$stripe = new \Stripe\StripeClient(STRIPE_API);
						// Select or create customer
							$customer = $mdl_stripe->searchCustomer($stripe, $email, $uid);
							if(!$customer) {
								// Customer does not exist, Create new.
								try {
									$customer = $mdl_stripe->createCustomer($stripe, $fname, $lname, $phone, $email, $uid, $address1, $address2, $town, $county, $postcode, $token);
								} catch (Exception $e) {
									$api_error = $e->getMessage();
								}
							}
						// Create and attempt the charge on the users card.
							if(empty($api_error) && $customer) {
								try {
									$charge = $mdl_stripe->createCharge($stripe, $customer, $pricePennies, $currency, $items);
								} catch (Exception $e) {
									$api_error = $e->getMessage();
								}
							} else {
								exit($this->sendOutput(
									Json_encode(array(
										'status' => 'error',
										'reason' => 'Unable to create customer account',
									)),
									array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
								));
							}
						// Retrieve payment details  and check if the payment was successful
							if (empty($api_error) && $charge) {
								$chargeJson = $charge->jsonSerialize();
							} else {
								exit($this->sendOutput(
									Json_encode(array(
										'status' => 'error',
										'reason' => 'Charge creation failed! Try a different card',
									)),
									array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
								));
							}
						// Confirm and upload the transaction info to the DB
							if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
								// Transaction details  
									$transactionID = $chargeJson['balance_transaction'];
									$paidAmount = $chargeJson['amount'];
									$paidCurrency = $chargeJson['currency'];
									$payment_status = $chargeJson['status'];
									$fees = $chargeJson['application_fee_amount'];
									$price_tax	= round(($price - $fees) * 0.2, 2);
								// Save address info
									$mdl_stripe->uploadAddress($uid, $number, $address1, $address2, $town, $county, $country, $postcode);
									$address_id = $mdl_stripe->getAddressID($uid, $number, $address1, $address2, $town, $county, $country, $postcode);
								// Save Order
									$inv_counts = $mdl_stripe->invoiceCount()+1;
									$invoice_number = 'INV';
									for($i=0; $i<(8-strlen($inv_counts));$i++) {
										$invoice_number .= '0';
									}
									$invoice_number .=$inv_counts;
									$mdl_stripe->uploadSalesOrder($invoice_number, $uid, $name, $email, $phone, $items, $notes, $shipping = 0, $address_id, $price, $price_tax, $paidAmount, $fees, $currency, $status = 1, $transactionID, $chargeJson['id'], $payment_status);
									$payment_id = $conn->insert_id;
								// Empty users cart
									if(!$mdl_stripe->emptyCart($uid)){
										exit($this->sendOutput( // Declined
											Json_encode(array(
												'status' => 'error',
												'reason' => 'Unable to empty the users cart!',
											)),
											array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
										));
									}
								// Check if payment was successful
									if ($payment_status == 'succeeded') {
										exit($this->sendOutput( // SUCCESS - Return invoice number
											Json_encode(array(
												'status' => 'success',
												'invoice' => $invoice_number
											)),
											array("Content-Type: application/json", "HTTP/1.1 200 OK")
										));
									} else {
										exit($this->sendOutput( // Declined
											Json_encode(array(
												'status' => 'error',
												'reason' => 'Your Payment was declined!',
											)),
											array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
										));
									}
							} else {
								exit($this->sendOutput(
									Json_encode(array(
										'status' => 'error',
										'reason' => 'Transaction failled!',
									)),
									array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
								));
							}
					} else {
						exit($this->sendOutput(
							Json_encode(array(
								'status' => 'error',
								'reason' => 'Error in the form submission!',
							)),
							array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
						));
					}
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Refund a transaction
					// Retrieve stripe token and user info from the submitted form 
						$amount = 
					// Require Stripe PHP library and set the API key 
						require_once(__ROOT__ . '/vendor/StripeSecure/init.php');
						$stripe = new \Stripe\StripeClient(STRIPE_API);
					// Create intent for the refund
						$paymentIntent = $stripe->paymentIntents->create([
							'amount' => $amount,
							'currency' => 'gbp',
							'payment_method_types' => ['card'],
						]);
					// Process the refund
						$stripe->refunds->create([
							'payment_intent' => $paymentIntent,
							'amount' => $amount
						]);
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:											// (O)THERS 	-- 🗷 --	Everything else
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				endif;
			// Send output
				$this->sendOutput(
					$str_response,
					array("Content-Type: application/json", "HTTP/1.1 200 OK")
				);
			// End of function
		}
		/** "/Stripe/Refund/" Endpoint
		 *	@final
		 *	@return JSON
		 */
		public function SecureRefund() {
			// Vars
				$mdl_stripe = new StripeModel();
				$requestMethod = $_SERVER['REQUEST_METHOD'];
				$arr_stripe_info = $this->getQueryStringParams();
				$str_response = "";
			// Functions									☐ Incomplete / 🗹 Complete / 🗷 VOID
				/**/if(strtoupper($requestMethod) == "PUT"):	// (C)REATE		-- 🗹 --	Create a refund
					// Retrieve stripe token and user info from the submitted form 
						$value		= $arr_stripe_info['value'];
						$ch_id		= $arr_stripe_info['ch_id'];
					// Require Stripe PHP library and set the API key 
						require_once(__ROOT__ . '/vendor/StripeSecure/init.php');
						$stripe = new \Stripe\StripeClient(STRIPE_API);
					// Check if the value is in pennies, If not convert to pennies
						if(preg_match("/[0-9]+[\.]{0}[0-9]{0}/", $value)) {
							str_replace('.', '', $value);
							$value = $value * 100;
						} else if(preg_match("/[0-9]+[\.]{1}[0-9]{1}/", $value)) {
							str_replace('.', '', $value);
							$value = $value * 10;
						}
					// Process the refund
						$refund = $stripe->refunds->create([
							'charge' => $ch_id,
							'amount' => $value,
						]);
					// Print refund info
						if($refund['status'] == "succeeded") {
							// Upload refund details to the database.
								$mdl_stripe->uploadRefund($refund['id'], $refund['amount'], $refund['currency'], $refund['balance_transaction'], $refund['charge'], $refund['status']);
							// Send output
							exit($this->sendOutput( // Successfully refunded
								Json_encode(array(
									'status' => 'success',
								)),
								array("Content-Type: application/json", "HTTP/1.1 200 OK")
							));
						} else {
							exit($this->sendOutput( // Declined
								Json_encode(array(
									'status' => 'error',
									'reason' => 'Unable to send refund to the user!',
								)),
								array("Content-Type: application/json", "HTTP/1.1 500 Internal server error")
							)); 
						}
					// EOF
				elseif(strtoupper($requestMethod) == "GET"):	// (R)READ		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "POST"):	// (U)UPDATE	-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				elseif(strtoupper($requestMethod) == "DELETE"):	// (D)ELETE		-- 🗷 --	Unknown
					$this->throwError("Unknown Request type for this function", "HTTP/1.1 404 Not Found");
				else:											// (O)THERS 	-- 🗷 --	Everything else
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