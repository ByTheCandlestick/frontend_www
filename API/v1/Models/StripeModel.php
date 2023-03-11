<?
	class StripeModel extends BaseModel {
		/** searchCustomer
		 * 
		 * 
		 */
			public function searchCustomer($stripe, $email, $uid) {
				$cust = $stripe->customers->search([
					'query' => "email:'$email' AND metadata['UID']:'$uid'",
					'limit' => 1,
				])['data'][0];
				if($cust) {
					return $cust;
				} else {
					return false;
				}
			}
		/** createCustomer
		 * 
		 * 
		 */
			public function createCustomer($stripe, $fname, $lname, $phone, $email, $uid, $address1, $address2, $town, $county, $postcode, $token) {
				$vars = array(array('stripe', $stripe), array('fname', $fname), array('phone', $phone), array('email', $email), array('uid', $uid), array('address1', $address1), array('address2', $address2), array('town', $town), array('county', $county), array('postcode', $postcode), array('token', $token), array());
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new customer", "Orders", $uid);
				return $stripe->customers->create([
					'name' => $fname . ' ' . $lname,
					'phone' => $phone,
					'email' => $email,
					'metadata'=> [
						'UID' => $uid,
					],
					'address' => [
						'line1' => $address1,
						'line2' => $address2,
						'city' => $town,
						'state' => $county,
						'postal_code' => $postcode,
					],
					'source' => $token,
				]);
			}
		/** createCharge
		 * 
		 * 
		 */
			public function createCharge($stripe, $customer, $pricePennies, $currency, $items, $uid) {
				$vars = array(array('stripe', $stripe), array('customer', $customer), array('pricePennies', $pricePennies), array('currency', $currency), array('items', $items), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new charge", "Orders", $uid);
				return $stripe->charges->create([
					'customer' => $customer->id,
					'amount' => $pricePennies,
					'currency' => $currency,
					'description' => $items
				]);
			}
		/** uploadSalesOrder
		 * 
		 * 
		 */
			public function uploadSalesOrder($invoice_number, $uid, $name, $email, $phone, $items, $notes, $shipping, $address_id, $price, $paidAmount, $fees, $currency, $status, $txn, $chg, $paymentStatus, $network, $last4, $exp_M, $exp_Y) {
				$paidAmount = $paidAmount / 100;
				$vars = array(array('invoice_number', $invoice_number), array('uid', $uid), array('name', $name), array('email', $email), array('phone', $phone), array('items', $items), array('notes', $notes), array('shipping', $shipping), array('address_id', $address_id), array('price', $price), array('paidAmount', $paidAmount), array('fees', $fees), array('currency', $currency), array('status', $status), array('txn', $txn), array('chg', $chg), array('paymentStatus', $paymentStatus), array('network', $network), array('last4', $last4), array('exp_M', $exp_M), array('exp_Y', $exp_Y));
				$this->uploadAudit(__FUNCTION__, $vars, "Uploaded Sales Order", "Orders", $uid);
				$this->Execute(sprintf("INSERT INTO `Transactions` (`Transaction ID`, `Type`, `Status`, `Invoice ID`, `Charge ID`, `Subtotal`, `Processing Fees`, `Tax`, `Deposit`, `Currency`, `Notes`, `UID`, `Name`, `Email`, `Phone`, `Items`, `Ship to`, `Shipping by`, `Billing address`, `Estimated delivery date`, `Card network`, `Last 4`, `Expires month`, `Expires year`, `Modified`, `Created`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', now(), now())", $txn, 'Order', $paymentStatus, $invoice_number, $chg, $price, $fees, (round(($paidAmount - $fees)*0.2, 2)), $paidAmount, $currency, $notes, $uid, $name, $email, $phone, $items, '', $shipping, $address_id, date("d/m/Y", strtotime("+10 days")), $network, $last4, $exp_M, $exp_Y), 1);
			}
		/** uploadAddress
		 * 
		 * 
		 */
			public function uploadAddress($uid, $number, $address1, $address2, $town, $county, $country, $postcode) {
				$vars = array(array('uid', $uid), array('number', $number), array('address1', $address1), array('address2', $address2), array('town', $town), array('county', $county), array('country', $country), array('postcode', $postcode));
				$this->uploadAudit(__FUNCTION__, $vars, "Upload customer address", "Orders", $uid);
				if($this->Execute(sprintf("SELECT COUNT(*) FROM `User addresses` WHERE `uid`=%s AND `number_name`='%s' AND `line_1`='%s' AND `line_2`='%s' AND `town`='%s' AND `county`='%s' AND `country`='%s' AND `postcode`='%s'", $uid, $number, $address1, $address2, $town, $county, $country, $postcode), 2)[0] == 0) {
					return $this->Execute(sprintf("INSERT INTO `User addresses`(`uid`, `number_name`, `line_1`, `line_2`, `town`, `county`, `country`, `postcode`) VALUES( %s, '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $uid, $number, $address1, $address2, $town, $county, $country, $postcode), 1);
				}
			}
		/** getAddressID
		 * 
		 * 
		 */
			public function getAddressID($uid, $number, $address1, $address2, $town, $county, $country, $postcode) {
				return $this->Execute("	SELECT 	`id`
										FROM 	`User addresses`
										WHERE	`uid`=$uid AND
												`number_name`='$number' AND
												`line_1`='$address1' AND
												`line_2`='$address2' AND
												`town`='$town' AND
												`county`='$county' AND
												`country`='$country' AND
												`postcode`='$postcode'", 2)[0];
			}
		/** invoiceCount
		 * 
		 * 
		 */
			public function invoiceCount() {
				return $this->Execute("SELECT count(*) FROM `Transactions` WHERE `Type`='Order'", 2)[0];
			}
		/** emptyCart
		 * 
		 * 
		 */
			public function emptyCart($uid) {
				return $this->Execute("DELETE FROM `User carts` WHERE `uid`=$uid", 1);
			}
		/** uploadRefund
		 * 
		 * 
		 */
			public function uploadRefund($id, $pricePennies, $currency, $bal_txn, $ch_id, $status, $uid) {
				$pricePennies = $pricePennies / 100;
				$vars = array(array('id', $id), array('amount', $pricePennies), array('currency', $currency), array('bal_txn', $bal_txn), array('ch_id', $ch_id), array('status', $status), array('uid', $uid));
				$this->uploadAudit(__FUNCTION__, $vars, "Created a new Refund", "Refunds", $uid);
				$this->Execute("INSERT INTO
									`Transactions`
										(`Transaction ID`, `Type`, `Status`, `Invoice ID`, `Charge ID`, `Refund ID`, `Subtotal`, `Deposit`, `Currency`, `Modified`, `Created`)
									VALUES
										('$bal_txn', 'Refund', '$status', 'TBD-Invoice', '$ch_id', '$id', '$pricePennies', '$pricePennies', '$currency', now(), now())", 1);
			}
		/** readRefund
		 * 
		 * 
		 */
		/** updateRefund
		 * 
		 * 
		 */
		/** cancelRefund
		 * 
		 * 
		 */
	}
?>