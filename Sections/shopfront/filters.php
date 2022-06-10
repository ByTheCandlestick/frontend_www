<div class="px-2 d-none d-md-block">
	<h5 class="pt-2 mb-4">Filters</h5>
	<div class="mb-4">
		<div class="md-form md-outline mt-0 d-flex justify-content-between align-items-center">
			<input type="text" id="search12" class="form-control mb-0" placeholder="Search..." spellcheck="false" data-ms-editor="true">
			<a href="#!" class="btn btn-flat btn-md px-3 waves-effect"><i class="fas fa-search fa-lg"></i></a>
		</div>
	</div>
	<?
		if(isset($secext) && $secext == 'products') {
			if($query = DB_Query("SELECT `made_by`, COUNT(`made_by`) AS Frequency FROM `products` WHERE `Active`=1 GROUP BY `made_by` ORDER BY COUNT(`made_by`) DESC")) {
				if(mysqli_num_rows($query) > 0) {
					print('
						<!-- Section: Partners -->
						<div class="mb-4">
							<h6 class="font-weight-bold mb-3">Partners</h6>
					');
					while($row = mysqli_fetch_array($query)) {
						$made_by = $row['made_by'];
						if($range_query = DB_Query("SELECT `Name` FROM `` WHERE `ID`=$made_by")) {
							$title = mysqli_fetch_array($range_query);
							print("
								<div class=\"form-check mb-1\">
									<input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"$title[0]Checkbox\">
									<label class=\"form-check-label\" for=\"$title[0]Checkbox\">
										$title[0]
									</label>
								</div>
							");
						}
					}
					print('
						</div>
					');
				}
			}
			if($query = DB_Query("SELECT `Category_ID`, COUNT(`Category_ID`) AS Frequency FROM `products` WHERE `Active`=1 GROUP BY `Category_ID` ORDER BY COUNT(`Category_ID`) DESC")) {
				if(mysqli_num_rows($query) > 0) {
					print('
						<!-- Section: Categories -->
						<div class="mb-4">
							<h6 class="font-weight-bold mb-3">Categories</h6>
					');
					while($row = mysqli_fetch_array($query)) {
						$category_id = $row['Category_ID'];
						if($range_query = DB_Query("SELECT `Name` FROM `products_categories` WHERE `ID`=$category_id")) {
							$title = mysqli_fetch_array($range_query);
							print("
								<div class=\"form-check mb-1\">
									<input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"$title[0]Checkbox\">
									<label class=\"form-check-label\" for=\"$title[0]Checkbox\">
										$title[0]
									</label>
								</div>
							");
						}
					}
					print('
						</div>
					');
				}
			}
			if($query = DB_Query("SELECT `Range_id`, COUNT(`Range_id`) AS Frequency FROM `products` WHERE `Active`=1 GROUP BY `Range_id` ORDER BY COUNT(`Range_id`) DESC")) {
				if(mysqli_num_rows($query) > 0) {
					print('
						<!-- Section: Ranges -->
						<div class="mb-4">
							<h6 class="font-weight-bold mb-3">Ranges</h6>
					');
					while($row = mysqli_fetch_array($query)) {
						$range_id = $row['Range_id'];
						if($range_query = DB_Query("SELECT `Name` FROM `products_collections` WHERE `ID`=$range_id")) {
							$title = mysqli_fetch_array($range_query);
							print("
								<div class=\"form-check mb-1\">
									<input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"$title[0]Checkbox\">
									<label class=\"form-check-label\" for=\"$title[0]Checkbox\">
										$title[0]
									</label>
								</div>
							");
						}
					}
					print('
						</div>
					');
				}
			}
		} else if(isset($secext) && $secext == 'partners') {
			if($query = DB_Query("SELECT `Category_ID`, COUNT(`Category_ID`) AS Frequency FROM `products` WHERE `Active`=1 GROUP BY `Category_ID` ORDER BY COUNT(`Category_ID`) DESC")) {
				if(mysqli_num_rows($query) > 0) {
					print('
						<!-- Section: Category -->
						<div class="mb-4">
							<h6 class="font-weight-bold mb-3">Categories</h6>
					');
					while($row = mysqli_fetch_assoc($query)) {
						$range_id = $row['Category_ID'];
						if($range_query = DB_Query("SELECT `Name` FROM `products_categories` WHERE `ID`=$range_id")) {
							$title = mysqli_fetch_array($range_query);
							print("
								<div class=\"form-check mb-1\">
									<input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"$title[0]Checkbox\">
									<label class=\"form-check-label\" for=\"$title[0]Checkbox\">
										$title[0]
									</label>
								</div>
							");
						}
					}
					print('
						</div>
					');
				}
			}
		} else if(isset($secext) && $secext == 'partner'){
			$part_name = $partner['name'];
			if($query = DB_Query("SELECT `Category_ID`, COUNT(`Category_ID`) AS Frequency FROM `products` WHERE `Active`=1 AND `made_by`='$part_name' GROUP BY `Category_ID` ORDER BY COUNT(`Category_ID`) DESC")) {
				if(mysqli_num_rows($query) > 0) {
					print('
						<!-- Section: Category -->
						<div class="mb-4">
							<h6 class="font-weight-bold mb-3">Categories</h6>
					');
					while($row = mysqli_fetch_assoc($query)) {
						$category_id = $row['Category_ID'];
						if($range_query = DB_Query("SELECT `Name` FROM `products_categories` WHERE `ID`=$category_id")) {
							$title = mysqli_fetch_array($range_query);
							print("
								<div class=\"form-check mb-1\">
									<input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"$title[0]Checkbox\">
									<label class=\"form-check-label\" for=\"$title[0]Checkbox\">
										$title[0]
									</label>
								</div>
							");
						}
					}
					print('
						</div>
					');
				}
			}
			if($query = DB_Query("SELECT `Range_ID`, COUNT(`Range_ID`) AS Frequency FROM `products` WHERE `active`=1 AND `made_by`='$part_name' GROUP BY `Range_ID` ORDER BY COUNT(`Range_ID`) DESC")) {
				if(mysqli_num_rows($query) > 0) {
					print('
						</div>
						<!-- Section: Ranges -->
						<div class="mb-4">
							<h6 class="font-weight-bold mb-3">Ranges</h6>
					');
					while($row = mysqli_fetch_assoc($query)) {
						$range_id = $row['Range_ID'];
						if($range_query = DB_Query("SELECT `Name` FROM `products_collections` WHERE `ID`=$range_id")) {
							$title = mysqli_fetch_array($range_query);
							print("
								<div class=\"form-check mb-1\">
									<input class=\"form-check-input\" type=\"checkbox\" value=\"\" id=\"$title[0]Checkbox\">
									<label class=\"form-check-label\" for=\"$title[0]Checkbox\">
										$title[0]
									</label>
								</div>
							");
						}
					}
					print('
						</div>
					');
				}
			}
		} else {
			echo 'unset';
		}
	?>
</div>