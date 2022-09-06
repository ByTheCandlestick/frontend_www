<?
	$partners = [];
	$q = DB_Query("SELECT * FROM `Partner accounts` WHERE `Active`=1");
	while($partner = mysqli_fetch_assoc($q)) {
		$partners[$partner['ID']] = $partner;
	}
	$partner_image = __API__.'/Images/fetch/'.$partners[$product['made_by_ID']]['logo_url'];
	$partner_title = $partners[$product['made_by_ID']]['name'];
	$partner_shop_link = $partners[$product['made_by_ID']]['shop_link'];

	print_r("
		<div class=\"row\">
			<div class=\"offset-2 col-2 / offset-md-0 col-md-3\">
				<img class=\"mw-100 rounded-circle\" src=\"$partner_image\">
			</div>
			<div class=\"offset-0 col-6 / offset-md-0 col-md-9\">
				<p class=\"mb-0 text-muted\">
					Made by: 
				</p>
				<p class=\"fs-6\">
					<a href=\"$partner_shop_link\">
						$partner_title
					</a>
				</p>
			</div>
		</div>
	");
?>