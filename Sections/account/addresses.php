<section>
	<div class="row p-4">
		<?
			$items = DB_Query(sprintf("SELECT * FROM `Users_address` WHERE `UID`=%s ORDER BY `ID` ASC", $userdata['ID']));
			foreach($items as $item) {
				$l1 = $item['number_name'].' '.$item['line_1'];
				$l2 = $item['line_2']; $l3 = $item['town'];
				$l4 = $item['county']; $l5 = $item['country'];
				$l6 = $item['postcode'];
				print("
					<div class=\"col-6 col-md-4 col-lg-3\">
						<div class=\"card\">
							<div class=\"card-body\">
								<h5 class=\"card-title\">Name:</h5>
								<p class=\"card-text\">
									$l1\n$l2\n$l3\n$l4\n$l5\n$l6
								</p>
								<a href=\"#\" class=\"btn btn-primary\">Go somewhere</a>
							</div>
						</div>
					</div>
				");
			}
		?>
	</div>
		</section>