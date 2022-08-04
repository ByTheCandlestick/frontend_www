<?
if(QS_SUBPAGE != "") {
	$page = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `ID`=%s", QS_SUBPAGE)));
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Oxygen - '<?print($page['page_name'])?>'</h1>
			<p class="text-danger"> WORK IN PROGRESS, PLEASE DO NOT USE </p>
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
					<!--<a href="javascript:website.layout.update(<?print(QS_SUBPAGE)?>);" class="btn btn-outline-primary m-1">-->
					<a href="javascript:save();" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Type -->
	<div class="row" type="sections" style="display: <?($page['display_type']==1)?print("flex"):print("none")?>;" data-original-sections="<?print($page['section_ids'])?>">
		<style>
			.templateBase {
				border: 2px solid var(--main-color);
				border-radius: 15px;
				padding: unset;
				overflow: hidden;
			}
			.accordion .templateElement,
			.accordion .templateElementGrid {
				width: calc(50% - 15px);
				background: var(--section);
				margin: 5px 0px 7px 10px;
				border-radius: 10px;
			}
			.templateBase .templateElementMenu:hover,
			.templateBase .templateElement:hover .templateElementMenu,
			.templateBase .templateElementGrid:hover .templateElementMenu {
				display: block;
				width: auto;
				height: auto;
				background: var(--link-color-hover);
				position: absolute;
				z-index: 999;
				left: 50%;
				top: 0;
				transform: translatex(-50%);
			}
			.templateBase .templateElement,
			.templateBase .templateElementGrid {
				width: 100%;
				background: var(--app-container);
			    border-bottom: dotted silver 2px;
			}

			.templateElementMenu,
			.accordion .templateElement input,
			.accordion .templateElementGrid .templateGrid {
				display: none;
			}
			.templateBase .templateElementGrid .templateGrid {
				min-height: 30px;
				margin-inline: auto;
			}
			.templateBase .templateElementGrid .templateGrid .dragulaContainer {
				outline: grey dotted thin;
				height: 100%;
				position: relative;
				background: var(--section);
			}

			.container {
				background: var(--app-container);
				border-radius: 15px;
				padding: unset;
			}
		</style>
		<div class="col-lg-3">
			<div class="accordion accordion-flush" id="SectionElements">
				<div class="accordion-item container row dragulaCopy templateElements cat-columns">
					<h2 class="accordion-header p-0 dragDisabled">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#columns" aria-controls="columns">
							<h5>Columns</h5>
						</button>
					</h2>
					<div id="columns" class="accordion-collapse collapse templateElement templateElementGrid" data-bs-parent="#SectionElements">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').remove()">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>2 columns</h6>
							<div class="templateGrid col-6" element-id="#6;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-6" element-id="#6;">
								<div class="dragulaContainer"></div>
							</div>
						</div>
					</div>
					<div id="columns" class="accordion-collapse collapse templateElement templateElementGrid" data-bs-parent="#SectionElements">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').remove()">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>3 columns</h6>
							<div class="templateGrid col-4" element-id="#4;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-4" element-id="#4;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-4" element-id="#4;">
								<div class="dragulaContainer"></div>
							</div>
						</div>
					</div>
					<div id="columns" class="accordion-collapse collapse templateElement templateElementGrid" data-bs-parent="#SectionElements">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').remove()">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>4 columns</h6>
							<div class="templateGrid col-3" element-id="#3;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-3" element-id="#3;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-3" element-id="#3;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-3" element-id="#3;">
								<div class="dragulaContainer"></div>
							</div>
						</div>
					</div>
					<div id="columns" class="accordion-collapse collapse templateElement templateElementGrid" data-bs-parent="#SectionElements">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').remove()">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>5 columns</h6>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-4" element-id="#4;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
						</div>
					</div>
					<div id="columns" class="accordion-collapse collapse templateElement templateElementGrid" data-bs-parent="#SectionElements">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').remove()">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>6 columns</h6>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-2" element-id="#2;">
								<div class="dragulaContainer"></div>
							</div>
						</div>
					</div>
					<? 
						$query = DB_Query("SELECT * FROM `page_sections` ORDER BY `section_type`");
						$type = null; $elementCategories = array();
						if(mysqli_num_rows($query) > 0) {
							while($row = mysqli_fetch_array($query)) {
								$sections[$row['id']] = $row;
								if($type != $row['section_type']) print('
									</div>
									<div class="accordion-item container row dragulaCopy templateElements cat-'.$row['section_type'].'">
										<h2 class="accordion-header p-0 dragDisabled">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#'.$row['section_type'].'" aria-controls="'.$row['section_type'].'">
												<h5>'.ucwords($row['section_type']).'</h5>
											</button>
										</h2>
								');
								print('
										<div id="'.$row['section_type'].'" class="accordion-collapse collapse templateElement" element-id="'.$row['id'].'" data-bs-parent="#SectionElements">
											<div class="accordion-body row position-relative">
												<div class="templateElementMenu">
													<a onclick="$(this).closest(\'.templateElement, .templateElementGrid\').remove()">
														<i class="fas fa-trash-alt"></i>
													</a>
												</div>
												<h6>'.$row['short_description'].'</h6>
												<input type="text" value="">
											</div>
										</div>
								');
								if($type != $row['section_type'] && $type != null) array_push($elementCategories, $type);
								$type = $row['section_type'];
							}
						}
					?>
				</div>
			</div>
		</div>
		
		<div class="col-lg-9 h-100 templateBase dragulaContainer"><?/*
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
		*/?></div>
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
		document.querySelector('.templateGrid'),
		document.querySelector('.templateBase'),
		document.querySelector('.dragulaContainer'),
		document.querySelector('.templateElements.cat-columns'),
		<?foreach($elementCategories as $elementCategory) {print("document.querySelector('.templateElements.cat-$elementCategory'),
		");}?>
	], {
		isContainer: function (el) {
			return false;
		},
		moves: function (el, source, handle, sibling) {
			return true;
		},
		copy: function(el, source) {
			$('.templateBase').find('.templateElement#'+$(el).attr('id')).removeAttr('id');
			return el.parentNode.classList.contains('dragulaCopy');
		},
		accepts: function (el, target, source, sibling) {
			return target.classList.contains('dragulaContainer');
		},
		invalid: function (el, handle) {
			return el.classList.contains('dragulaDisabled');
		},
		direction: 'vertical',
		copySortSource: false,
		revertOnSpill: true,
		removeOnSpill: false,
		mirrorContainer: document.body,
		ignoreInputTextSelection: true,
		slideFactorX: 0,
		slideFactorY: 0,
	});
	//////////
	elementIds = [];
	function save() {
		$('.templateBase').children().each(function() {
			if($(this).hasClass('templateElementGrid')) {
				console.log('Columns');
			} else {
				console.log($(this).attr('element-id'))
			}
		})
	}
	//////////
	function simpleSave(elements) {
		elementIds = [];
		elements.each(function() {
			if($(this).find('input') > 0 && $(this).find('input').val() != '') {
				elementIds.push($(this).attr('element-id')+':'+$(this).find('input').val());
			} else {
				elementIds.push($(this).attr('element-id'));
			}
		})
		console.log(elementIds.join(','));
	}
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