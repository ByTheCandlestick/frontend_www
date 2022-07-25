<userdata user_id="" username="">
<section class="row container-fluid">
	<header class="row mb-4	">
		<h2 class="col-11">My account</h2>
		<div class="col">
			<button type="button" class="btn btn-outline-dark btn_logout">Log out</button>
		</div>
	</header>
	<div class="col-md-9">
		<div class="row">
			<h4 class="col-10 pb-1"> Order history </h4>
		</div>
		<hr>
		<?
			if($query = DB_Query(sprintf("SELECT * FROM `Transactions` WHERE `UID`=%d AND `Type`='Order' ORDER BY `Invoice ID` DESC LIMIT 6", $userdata['ID']))) {
				$orderHistory = array();
				while($row = mysqli_fetch_assoc($query)): array_push($orderHistory, $row); endwhile;
				$count = count($orderHistory);$more=false;
				if($count == 6): $count=$count-1;$more=true; endif;
				for($i=0; $i<$count; $i++):
					$invoice_date = $orderHistory[$i]['Created'];
					$id = $orderHistory[$i]['Invoice ID'];
					$invoice_number = $orderHistory[$i]['Invoice ID'];
					print("
						<div class=\"row border-bottom m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5\">
							<div class=\"row pb-2 pb-md-0\">
								<div class=\"col-9 col-md-8 align-items-center\">
									<div class=\"top-50 position-relative\" style=\"transform:translatey(-50%);\">
										<p>
											<a class=\"link-dark\" href=\"/My/Order/$invoice_number\">
												$invoice_number
											</a>
										</p>
										<p class=\"font-monospace text-muted\">
											Order date: $invoice_date
										</p>
									</div>
								</div>
							</div>
						</div>
					");
				endfor;
			}
			if($more) {
		?>
			<div class="row border-bottom m-3 p-3 / m-md-0 p-md-2 mx-md-5 px-md-5">
				<div class="row pb-2 pb-md-0">
					<div class="col-9 col-md-8 align-items-center">
						<div class="top-50 position-relative" style="transform:translatey(-50%);">
							<p>
								<a class="link-dark" href="/My/Orders">
									View all orders
								</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		<?
			}
		?>
	</div>
	<div class="col-md-3">
		<div class="row">
			<h4 class="col-10 pb-1"> Account details </h4>
			<div class="col">
				<button class="account_details-edit_btn btn btn-outline-dark" style="display: block;"><i class="fad fa-pencil"></i></button>
				<button class="account_details-save_btn btn btn-outline-dark" style="display: none;" ><i class="fad fa-save"></i></button>
			</div>
		</div>
		<hr>
		<div class="account_details" style="display: block;">
			<div class="row">
				<div class="form-floating p-1 col-6">
					<input type="firstname" class="form-control border-0 bg-white" id="floatingFirstnameInput" placeholder="firstname" value="<?print($userdata['First_name'])?>" autocomplete="firstname" style="margin-left: 1px;" disabled>
					<label for="floatingFirstnameInput">Firstname</label>
				</div>
				<div class="form-floating p-1 col-6">
					<input type="surname" class="form-control border-0 bg-white" id="floatingSurnameInput" placeholder="surname" value="<?print($userdata['Last_name'])?>" autocomplete="surname" style="margin-left: 1px;" disabled>
					<label for="floatingSurnameInput">Surname</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="email" class="form-control border-0 bg-white" id="floatingEmailInput" placeholder="email@address.com" value="<?print($userdata['Email'])?>" autocomplete="email" style="margin-left: 1px;" disabled>
					<label for="floatingEmailInput">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="username" class="form-control border-0 bg-white" id="floatingUsernameInput" placeholder="Username" value="<?print($userdata['Username'])?>" autocomplete="username" style="margin-left: 1px;" disabled>
					<label for="floatingUsernameInput">Username</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="username" class="form-control border-0 bg-white" id="floatingUsernameInput" placeholder="Password" value="••••••••" autocomplete="username" style="margin-left: 1px;" disabled>
					<label for="floatingUsernameInput">Password</label>
				</div>
			</div>
		</div>
		<div class="account_details-edit" style="display: none;">
			<div class="row">
				<div class="form-floating p-1 col-6">
					<input type="firstname" class="form-control account_details-firstname" id="floatingFirstnameInput" placeholder="firstname" value="<?print($userdata['First_name'])?>" autocomplete="firstname" orig="<?print($userdata['First_name'])?>">
					<label for="floatingFirstnameInput">Firstname</label>
				</div>
				<div class="form-floating p-1 col-6">
					<input type="surname" class="form-control account_details-surname" id="floatingSurnameInput" placeholder="surname" value="<?print($userdata['Last_name'])?>" autocomplete="surname" orig="<?print($userdata['Last_name'])?>">
					<label for="floatingSurnameInput">Surname</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="email" class="form-control account_details-email" id="floatingEmailInput" placeholder="email@address.com" value="<?print($userdata['Email'])?>" autocomplete="email" orig="<?print($userdata['Email'])?>">
					<label for="floatingEmailInput">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="username" class="form-control account_details-username" id="floatingUsernameInput" placeholder="Username" value="<?print($userdata['Username'])?>" autocomplete="username" orig="<?print($userdata['Username'])?>">
					<label for="floatingUsernameInput">Username</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="password" class="form-control account_details-password_old" id="floatingUsernameInput" placeholder="Old password" value="" autocomplete="username" orig="<?print($userdata['Password'])?>">
					<label for="floatingUsernameInput">Old password</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="password" class="form-control account_details-password_new" id="floatingUsernameInput" placeholder="New password" value="" autocomplete="username">
					<label for="floatingUsernameInput">New Password</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating p-1">
					<input type="password" class="form-control account_details-password_conf" id="floatingUsernameInput" placeholder="Confirm password" value="" autocomplete="username">
					<label for="floatingUsernameInput">Confirm password</label>
				</div>
			</div>
		</div>
		<hr>
		<p> <a href="/My/Cards"> Manage card details </a> </p>
		<p> <a href="/My/Addresses"> Manage address's </a> </p>
	</div>
</section>