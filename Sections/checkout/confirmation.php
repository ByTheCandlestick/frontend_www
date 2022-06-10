<?
	if($query = DB_Query(sprintf("SELECT * FROM `Users_cart` WHERE `UID`=%u AND `active`=1", $userdata['ID']))) {
		$cart_items = array();
		while($row = mysqli_fetch_row($query)) {
			array_push($cart_items, $row);
		}
	} else {
		$cart_items = null;
	}
	if($cart_items != null) {
?>
	<div class="row m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5">
		<div class="pb-3 col-12 / col-md-6">
			<div class="form-floating">
				<textarea class="form-control" placeholder="Leave any extra info for your order" id="OrderNotes" style="height: 100px"></textarea>
				<label for="OrderNotes">Order notes</label>
			</div>
		</div>
		<div class="pb-3 offset-0 col-12 / offset-md-2 col-md-4">
			<div class="row">
				<div class="col-6 text-center">
					<h4>Subtotal</h4>
				</div>
				<div class="col-6 text-center">
					<p class="h4"><?print_r($cart_item_curr.$cart_total); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<p>discount codes are calculated at checkout.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-6 text-center">
					<a class="btn btn-outline-secondary" href="javascript:cart.update();" role="button">Update cart</a>
				</div>
				<div class="col-6 text-center">
					<a class="btn btn-secondary" href="/Cart/Checkout" role="button">Checkout</a>
				</div>
			</div>
		</div>
	</div>
<?
	} else { }
?>