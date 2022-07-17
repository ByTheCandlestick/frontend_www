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
								<p class=\"card-text\">
									$l1,<br>
									$l2,<br>
									$l3,<br>
									$l4,<br>
									$l5,<br>
									$l6
								</p>
								<a href=\"#\" class=\"btn btn-primary-outline\">Edit</a>
							</div>
						</div>
					</div>
				");
			}
		?>
	</div>
		</section>