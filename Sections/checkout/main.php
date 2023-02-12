<form id="paymentFrm" class="row" action="" method="POST">
	<div class="col-lg-5">
		<div class="mb-3 px-3 px-lg-3 col-lg-10">
			<h2>Billing Address</h2>
			<?if (DB_Query(sprintf("SELECT * FROM `User addresses` WHERE `uid`='%s'", $userdate['ID']))) { ?>
				<div class="row billing-address">
					<div class="form-floating py-1">
						<select id="select-address" class="form-select py-2" onclick="$(this).removeClass('is-invalid')">
							<option value="-1" selected>Please select an address</option>
							<option value="0"> + New address</option>
						<?
							$items = DB_Query(sprintf("SELECT * FROM `User addresses` WHERE `UID`=%s ORDER BY `ID` ASC", $userdata['ID']));
							foreach($items as $item) {
								$value = $item['id'];
								if($item['Name'] != '') {
									$name = $item['Name'];
								} else {
									$name = $item['number_name'].' '.$item['line_1'].', '.$item['town'];
								}
								print(sprintf('
									<option value="%s">%s</option>
								', $value, $name));
							}
						?>
						</select>
					</div>
				</div>

				<div class="row newAddress-billing d-none">
					<div class="row">
						<div class="form-floating  m-3 pe-2 col-12 col-lg-6">
							<input type="text" name="firstname" class="form-control" id="floatingInput-FName" autocomplete="given-name" required>
							<label for="floatingInput-FName">Firstname *</label>
						</div>
						<div class="form-floating  m-3 ps-2 col-12 col-lg-6">
							<input type="text" name="lastname" class="form-control" id="floatingInput-LName" autocomplete="family-name" required>
							<label for="floatingInput-LName">Lastname *</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 pe-2 col-12 col-lg-7">
							<input type="text" name="number" class="form-control" id="floatingInput-number" autocomplete="" required>
							<label for="floatingInput-number">House number / name *</label>
						</div>
						<div class="form-floating mb-3 ps-2 col-12 col-lg-5">
							<input type="text" name="postcode" class="form-control" id="floatingInput-postcode" autocomplete="postal-code" required>
							<label for="floatingInput-postcode">Postcode *</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-0 col-12">
							<input type="text" name="address1" class="form-control" id="floatingInput-Addr1" disabled required>
							<label for="floatingInput-Addr">Street name</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 pe-2 col-12 col-lg-6">
							<input type="text" name="address2" class="form-control" id="floatingInput-Addr2" disabled >
							<label for="floatingInput-Addr2">District</label>
						</div>
						<div class="form-floating mb-3 ps-2 col-12 col-lg-6">
							<input type="text" name="town" class="form-control" id="floatingInput-town" disabled required>
							<label for="floatingInput-town">Town</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 pe-2 col-12 col-lg-6">
							<input type="text" name="county" class="form-control" id="floatingInput-county" disabled required>
							<label for="floatingInput-county">County</label>
						</div>
						<div class="form-floating mb-3 ps-2 col-12 col-lg-6">
							<input type="text" name="country" class="form-control" id="floatingInput-country" disabled required>
							<label for="floatingInput-country">Country</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-0 col-12">
							<input type="text" name="phone" class="form-control" id="floatingInput-phone" autocomplete="tel" required>
							<label for="floatingInput-phone">Primary contact number *</label>
						</div>
					</div>
				</div>
			<?} else { ?>
				<div class="row billing-address d-none">
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12 col-lg-6">
							<input type="text" name="firstname" class="form-control" id="floatingInput-FName" autocomplete="given-name" required>
							<label for="floatingInput-FName">Firstname *</label>
						</div>
						<div class="form-floating mb-3 px-2 col-12 col-lg-6">
							<input type="text" name="lastname" class="form-control" id="floatingInput-LName" autocomplete="family-name" required>
							<label for="floatingInput-LName">Lastname *</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12 col-lg-7">
							<input type="text" name="number" class="form-control" id="floatingInput-number" autocomplete="" required>
							<label for="floatingInput-number">House number / name *</label>
						</div>
						<div class="form-floating mb-3 px-2 col-12 col-lg-5">
							<input type="text" name="postcode" class="form-control" id="floatingInput-postcode" autocomplete="postal-code" required>
							<label for="floatingInput-postcode">Postcode *</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12">
							<input type="text" name="address1" class="form-control" id="floatingInput-Addr1" disabled required>
							<label for="floatingInput-Addr">Street name</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12 col-lg-6">
							<input type="text" name="address2" class="form-control" id="floatingInput-Addr2" disabled >
							<label for="floatingInput-Addr2">District</label>
						</div>
						<div class="form-floating mb-3 px-2 col-6">
							<input type="text" name="town" class="form-control" id="floatingInput-town" disabled required>
							<label for="floatingInput-town">Town</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-6">
							<input type="text" name="county" class="form-control" id="floatingInput-county" disabled required>
							<label for="floatingInput-county">County</label>
						</div>
						<div class="form-floating mb-3 px-2 col-6">
							<input type="text" name="country" class="form-control" id="floatingInput-country" disabled required>
							<label for="floatingInput-country">Country</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12">
							<input type="text" name="phone" class="form-control" id="floatingInput-phone" autocomplete="tel" required>
							<label for="floatingInput-phone">Primary contact number *</label>
						</div>
					</div>
				</div>
			<?} ?>
			<h2>Shipping Address</h2>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" value="" id="same_billing_delivery" checked>
				<label class="form-check-label" for="same_billing_delivery">Delivery address is the same as billing address</label>
			</div>
			<?if (DB_Query(sprintf("SELECT * FROM `User addresses` WHERE `uid`='%s'", $userdate['ID']))) { ?>
				<div class="row shipping-address d-none">
					<div class="form-floating py-1">
						<select id="select-address" class="form-select py-2" onclick="$(this).removeClass('is-invalid')">
							<option value="-1" selected>Please select an address</option>
							<option value="0"> + New address</option>
						<?
							$items = DB_Query(sprintf("SELECT * FROM `User addresses` WHERE `UID`=%s ORDER BY `ID` ASC", $userdata['ID']));
							foreach($items as $item) {
								$value = $item['ID'];
								if($item['Name'] != '') {
									$name = $item['Name'];
								} else {
									$name = $item['number_name'].' '.$item['line_1'].', '.$item['town'];
								}
								print(sprintf('
									<option value="%s">%s</option>
								', $value, $name));
							}
						?>
						</select>
					</div>

					<div class="row newAddress-shipping d-none">
						<div class="row">
							<div class="form-floating mb-3 px-2 col-12 col-lg-6">
								<input type="text" name="firstname" class="form-control" id="floatingInput-FName" autocomplete="given-name" required>
								<label for="floatingInput-FName">Firstname *</label>
							</div>
							<div class="form-floating mb-3 px-2 col-12 col-lg-6">
								<input type="text" name="lastname" class="form-control" id="floatingInput-LName" autocomplete="family-name" required>
								<label for="floatingInput-LName">Lastname *</label>
							</div>
						</div>
						<div class="row">
							<div class="form-floating mb-3 px-2 col-12 col-lg-7">
								<input type="text" name="number" class="form-control" id="floatingInput-number" autocomplete="" required>
								<label for="floatingInput-number">House number / name *</label>
							</div>
							<div class="form-floating mb-3 px-2 col-12 col-lg-5">
								<input type="text" name="postcode" class="form-control" id="floatingInput-postcode" autocomplete="postal-code" required>
								<label for="floatingInput-postcode">Postcode *</label>
							</div>
						</div>
						<div class="row">
							<div class="form-floating mb-3 px-2 col-12">
								<input type="text" name="address1" class="form-control" id="floatingInput-Addr1" disabled required>
								<label for="floatingInput-Addr">Street name</label>
							</div>
						</div>
						<div class="row">
							<div class="form-floating mb-3 px-2 col-12 col-lg-6">
								<input type="text" name="address2" class="form-control" id="floatingInput-Addr2" disabled >
								<label for="floatingInput-Addr2">District</label>
							</div>
							<div class="form-floating mb-3 px-2 col-6">
								<input type="text" name="town" class="form-control" id="floatingInput-town" disabled required>
								<label for="floatingInput-town">Town</label>
							</div>
						</div>
						<div class="row">
							<div class="form-floating mb-3 px-2 col-6">
								<input type="text" name="county" class="form-control" id="floatingInput-county" disabled required>
								<label for="floatingInput-county">County</label>
							</div>
							<div class="form-floating mb-3 px-2 col-6">
								<input type="text" name="country" class="form-control" id="floatingInput-country" disabled required>
								<label for="floatingInput-country">Country</label>
							</div>
						</div>
						<div class="row">
							<div class="form-floating mb-3 px-2 col-12">
								<input type="text" name="phone" class="form-control" id="floatingInput-phone" autocomplete="tel" required>
								<label for="floatingInput-phone">Primary contact number *</label>
							</div>
						</div>
					</div>
				</div>
			<?} else { ?>
				<div class="row shipping-address d-none">
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12 col-lg-6">
							<input type="text" name="firstname" class="form-control" id="floatingInput-FName" autocomplete="given-name" required>
							<label for="floatingInput-FName">Firstname *</label>
						</div>
						<div class="form-floating mb-3 px-2 col-12 col-lg-6">
							<input type="text" name="lastname" class="form-control" id="floatingInput-LName" autocomplete="family-name" required>
							<label for="floatingInput-LName">Lastname *</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12 col-lg-7">
							<input type="text" name="number" class="form-control" id="floatingInput-number" autocomplete="" required>
							<label for="floatingInput-number">House number / name *</label>
						</div>
						<div class="form-floating mb-3 px-2 col-12 col-lg-5">
							<input type="text" name="postcode" class="form-control" id="floatingInput-postcode" autocomplete="postal-code" required>
							<label for="floatingInput-postcode">Postcode *</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12">
							<input type="text" name="address1" class="form-control" id="floatingInput-Addr1" disabled required>
							<label for="floatingInput-Addr">Street name</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12 col-lg-6">
							<input type="text" name="address2" class="form-control" id="floatingInput-Addr2" disabled >
							<label for="floatingInput-Addr2">District</label>
						</div>
						<div class="form-floating mb-3 px-2 col-6">
							<input type="text" name="town" class="form-control" id="floatingInput-town" disabled required>
							<label for="floatingInput-town">Town</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-6">
							<input type="text" name="county" class="form-control" id="floatingInput-county" disabled required>
							<label for="floatingInput-county">County</label>
						</div>
						<div class="form-floating mb-3 px-2 col-6">
							<input type="text" name="country" class="form-control" id="floatingInput-country" disabled required>
							<label for="floatingInput-country">Country</label>
						</div>
					</div>
					<div class="row">
						<div class="form-floating mb-3 px-2 col-12">
							<input type="text" name="phone" class="form-control" id="floatingInput-phone" autocomplete="tel" required>
							<label for="floatingInput-phone">Primary contact number *</label>
						</div>
					</div>
				</div>
			<?} ?>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="mb-3 col-lg-8 offset-lg-2">
			<div class="card-container">
				<div class="mGrid">
					<div class="total">
						<p>total</p>
						<p><?=($cart_item_curr . $cart_total) ?></p>
					</div>
					<div class="detail">
						<button type="submit" class="paymentSubmit btn btn-outline-dark">
							<i class="fas fa-circle-notch fa-spin" style="display: none;"></i>
							<span id="button-text">Pay now</span>
						</button>
					</div>
					<p id="paymentResponse"></p>
				</div>
				<!-- Small Side Card detail-->
				<div class="subContainer">
					<!-- svg Logo-->
					<div class="visaCont">
						<svg class="visa" enable-background="new 0 0 291.764 291.764" version="1.1" viewbox="5 70 290 200" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
							<path class="svgcolor" d="m119.26 100.23l-14.643 91.122h23.405l14.634-91.122h-23.396zm70.598 37.118c-8.179-4.039-13.193-6.765-13.193-10.896 0.1-3.756 4.24-7.604 13.485-7.604 7.604-0.191 13.193 1.596 17.433 3.374l2.124 0.948 3.182-19.065c-4.623-1.787-11.953-3.756-21.007-3.756-23.113 0-39.388 12.017-39.489 29.204-0.191 12.683 11.652 19.721 20.515 23.943 9.054 4.331 12.136 7.139 12.136 10.987-0.1 5.908-7.321 8.634-14.059 8.634-9.336 0-14.351-1.404-21.964-4.696l-3.082-1.404-3.273 19.813c5.498 2.444 15.609 4.595 26.104 4.705 24.563 0 40.546-11.835 40.747-30.152 0.08-10.048-6.165-17.744-19.659-24.035zm83.034-36.836h-18.108c-5.58 0-9.82 1.605-12.236 7.331l-34.766 83.509h24.563l6.765-18.08h27.481l3.51 18.153h21.664l-18.873-90.913zm-26.97 54.514c0.474 0.046 9.428-29.514 9.428-29.514l7.13 29.514h-16.558zm-160.86-54.796l-22.931 61.909-2.498-12.209c-4.24-14.087-17.533-29.395-32.368-36.999l20.998 78.33h24.764l36.799-91.021h-24.764v-0.01z" fill="#FFF"></path>
							<path class="svgtipcolor" d="m51.916 111.98c-1.787-6.948-7.486-11.634-15.226-11.734h-36.316l-0.374 1.686c28.329 6.984 52.107 28.474 59.821 48.688l-7.905-38.64z" fill="#EFC75E"></path>
						</svg>
					</div>
					<div type="text" id="card_number" class="number" autocomplete="cc-number" required ></div>
					<div type="text" id="card_expiry" class="expiry" autocomplete="cc-exp" required ></div>
					<div type="text" id="card_cvc" class="ccv" autocomplete="cc-csc" required ></div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="STRIPE_PUBLISHABLE_KEY" value="<?=(STRIPE_API[0]); ?>">
	<input type="hidden" name="currency" value="<?=($currency) ?>">
	<input type="hidden" name="price" value="<?=($cart_total) ?>">
	<input type="hidden" name="uid" value="<?=($userdata['ID']) ?>">
	<input type="hidden" name="email" value="<?=($userdata['Email']) ?>">
</form>