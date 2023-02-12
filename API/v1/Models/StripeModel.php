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
			public function createCharge($stripe, $customer, $pricePennies, $currency, $items) {
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
				$this->Execute(print(sprintf("INSERT INTO `Transactions` (`Transaction ID`, `Type`, `Status`, `Invoice ID`, `Charge ID`, `Subtotal`, `Processing Fees`, `Tax`, `Deposit`, `Currency`, `Notes`, `UID`, `Name`, `Email`, `Phone`, `Items`, `Ship to`, `Shipping by`, `Billing address`, `Card network`, `Last 4`, `Expires month`, `Expires year`, `Modified`, `Created`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' '%s' '%s', '%s', now(), now())", $txn, 'Order', $paymentStatus, $invoice_number, $chg, $price, $fees, (round(($paidAmount - $fees)*0.2, 2)), $paidAmount, $currency, $notes, $uid, $name, $email, $phone, $items, '', $shipping, $network, $address_id, $last4, $exp_M, $exp_Y)), 1);
			}
		/** uploadAddress
		 * 
		 * 
		 */
			public function uploadAddress($uid, $number, $address1, $address2, $town, $county, $country, $postcode) {
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
			public function uploadRefund($id, $amount, $currency, $bal_txn, $ch_id, $status) {
				$val = $amount / 100;
				$this->Execute("INSERT INTO
									`Transactions`
										(`Transaction ID`, `Type`, `Status`, `Invoice ID`, `Charge ID`, `Refund ID`, `Subtotal`, `Deposit`, `Currency`, `Modified`, `Created`)
									VALUES
										('$bal_txn', 'Refund', '$status', 'TBD-Invoice', '$ch_id', '$id', '$val', '$val', '$currency', now(), now())", 1);
			}
		/**readRefund
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