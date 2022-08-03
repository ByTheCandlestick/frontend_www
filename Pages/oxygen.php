<?
	if(QS_SUBPAGE != "") {
		$page = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `ID`=%s", QS_SUBPAGE)));
?>
	<section>
		<!-- Section Header -->
		<div class="row">
			<div class="col-12 col-md-6">
				<h1>Oxygen - '<?print($page['page_name'])?>'</h1>
			</div>
			<div class="col-12 col-md-6 text-md-end">
				<div class="row">
					<div class="col-12 d-flex justify-content-end align-items-center p-0">
						<div class="form-floating m-1">
							<div class="form-check form-switch">
								<input type="checkbox" class="btn-check" id="display_type" name="display_type" autocomplete="off" <?($page['display_type']==1)?print("checked"):print("")?>>
								<label class="btn btn-outline-primary" for="display_type"> <?($page['display_type']==1)?print("Sections"):print("Pages")?> </label>
							</div>
						</div>
						<a href="javascript:website.layout.update(<?print(QS_SUBPAGE)?>);" class="btn btn-outline-primary m-1">
							<i class="fa fa-save"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<br>
		<!-- Section Type -->
		<div class="row" type="sections" style="display: <?($page['display_type']==1)?print("flex"):print("none")?>;" data-original-sections="<?print($page['section_ids'])?>">
			<h2 class="text-danger text-center mb-5"> WORK IN PROGRESS, PLEASE DO NOT USE </h2>
			<style>
				.container {
					background: var(--app-container);
					border-radius: 15px;
					padding: unset;
				}
				.element {
					background: var(--section);
					border-radius: 15px;
					margin: 10px;
					padding: 10px;
				}
			</style>
			<div class="col-lg-3">
				<div class="accordion accordion-flush" id="SectionElements">
					<div class="accordion-item container row templateBuilderElements">
						<h2 class="accordion-header p-0" id="headingOne">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Columns" aria-expanded="true" aria-controls="Columns">
								Columns
							</button>
						</h2>
						<div id="Columns" class="accordion-collapse collapse col-12 col-md-5 element" aria-labelledby="headingOne" data-bs-parent="#SectionElements">
							<div class="accordion-body">
								2
							</div>
						</div>
						<div id="Columns" class="accordion-collapse collapse col-12 col-md-5 element" aria-labelledby="headingOne" data-bs-parent="#SectionElements">
							<div class="accordion-body">
								3
							</div>
						</div>
						<div id="Columns" class="accordion-collapse collapse col-12 col-md-5 element" aria-labelledby="headingOne" data-bs-parent="#SectionElements">
							<div class="accordion-body">
								4
							</div>
						</div>
					</div>
					<?
						$query = DB_Query("SELECT * FROM `page_sections` ORDER BY `section_type`");
						$type = null;
						if(mysqli_num_rows($query) > 0) {
							while($row = mysqli_fetch_array($query)) {
								$sections[$row['id']] = $row;
								if($type != $row['section_type']) print('
									<div class="accordion-item container row templateBuilderElements">
										<h2 class="accordion-header p-0" id="headingOne">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#'.$row['section_type'].'" aria-expanded="true" aria-controls="'.$row['section_type'].'">
												'.$row['section_type'].'
											</button>
										</h2>
								');
								print('
										<div id="'.$row['section_type'].'" class="accordion-collapse collapse col-12 col-md-5 element" aria-labelledby="headingOne" data-bs-parent="#SectionElements">
											<div class="accordion-body">
												'.$row['short_description'].'
											</div>
										</div>
								');
								if($type != $row['section_type']) print('
									</div>
								');
								$type = $row['section_type'];
							}
						}
					?>
				</div>
			</div>
			
			<div class="col-lg-9 h-100 templateBuilder" style="border: 2px solid var(--main-color);border-radius: 15px;">
				<?
					if($page['section_ids'] != "") {
						print('<div class="row">');
							$columns = explode("#", $page['section_ids']);
							$seccode = $secext = NULL;
							array_shift($columns);
							foreach($columns as $column) {
								[$width, $section_string] = explode(';', $column);
								print("<div class=\"col-md-$width container templateBuilderGrid\">");
									$templateSections = explode(',', $section_string);
									foreach($templateSections as $section) {
										[$seccode, $secext] = explode(':', $section);
										if($result = DB_Query("SELECT * FROM `page_sections` WHERE `id`='$seccode'")) {
											if(mysqli_num_rows($result) == 1) {
												$row = mysqli_fetch_array($result);
												print('
													<div class="element">
														<h5>
															'.$sections[$seccode]['short_description'].'
														</h5>
														<input type="text" value="'.$secext.'">
													</div>
												');
												unset($secext);
											}
										}
									}
								print("</div>");
							}
						print('</div>');
					} else {
						print("Drag an element from the left hand side to start building the website!");
					}
				?>
			</div>
		</div>
		<!-- Page Type -->
		<div class="row" type="page" style="display: <?($page['display_type']==1)?print("none"):print("flex")?>;">
			<div class="col-12 col-md-6 col-lg-3" name="name">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($page['page_file']=='')?'No page was set':'')?>" value="<? print(($page['page_file']=='')?'':$page['page_file'])?>">
					<label for="floatingInput">Page name</label>
				</div>
			</div>
		</div>
	</section>
	<script>
		dragula([
			document.querySelector('.templateBuilder'),
			document.querySelector('.templateBuilderGrid'),
			document.querySelector('.templateBuilderElements')
		], {
			isContainer: function (el) {
				return false;				// only elements in drake.containers will be taken into account
			},
			moves: function (el, source, handle, sibling) {
				return true;				// elements are always draggable by default
			},
			copy: function(el, source) {
				return source === document.querySelector('.templateBuilderElements')
			},
			accepts: function (el, target, source, sibling) {
				return target !== document.querySelector('.templateBuilderElements')
			},
			invalid: function (el, handle) {
				return false;				// don't prevent any drags from initiating by default
			},
			direction: 'vertical',			// Y axis is considered when determining where an element would be dropped
			copySortSource: false,			// elements in copy-source containers can be reordered
			revertOnSpill: true,			// spilling will put the element back where it was dragged from, if this is true
			removeOnSpill: false,			// spilling will `.remove` the element, if this is true
			mirrorContainer: document.body,	// set the element that gets mirror elements appended
			ignoreInputTextSelection: true,	// allows users to select input text, see details below
			slideFactorX: 0,				// allows users to select the amount of movement on the X axis before it is considered a drag instead of a click
			slideFactorY: 0,				// allows users to select the amount of movement on the Y axis before it is considered a drag instead of a click
		});

	</script>
<?
	} else {
?>
<script>
	window.location = "/";
</script>
<?
	}
?>