<?
if(QS_SUBPAGE != "") {
	$page = mysqli_fetch_assoc(DB_Query(sprintf("SELECT * FROM `page_layouts` WHERE `ID`=%s", QS_SUBPAGE)));
?>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-8">
			<h1>Oxygen - '<?print($page['page_name'])?>'</h1>
		</div>
		<div class="col-12 col-md-4 text-md-end">
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
	<!-- Section Type -->
	<div class="row sections" type="sections" style="display: <?($page['display_type']==1)?print("flex"):print("none")?>;" data-original-sections="<?print($page['section_ids'])?>">
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
				right: 0;
				top: -1rem;
			}
			.templateBase .templateElement,
			.templateBase .templateElementGrid {
				width: 100%;
				background: var(--app-container);
				padding: 1rem 1.25rem;
			}
			.templateBase .templateElement input {
				border: unset;
				border-bottom: 1px dashed grey;
				border-radius: unset;
			}

			.templateElementMenu,
			.accordion .templateElement input,
			.accordion .templateElementGrid .templateGrid,
			.templateBase .templateElementGrid > div > h6 {
				display: none;
			}
			.templateBase .templateElementGrid .templateGrid {
				min-height: 30px;
				margin-inline: auto;
				margin-top: 1rem;
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
			.nouirange {
				height: 10px;
			}
		</style>
		<div class="col-lg-3">
			<div class="accordion accordion-flush" id="SectionElements">
				<div class="accordion-item container row dragulaCopy templateElements cat-columns">
					<h2 class="accordion-header p-0 dragulaDisabled">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#columns" aria-controls="columns">
							<h5>Columns</h5>
						</button>
					</h2>
					<div id="columns" class="accordion-collapse collapse templateElementGrid" data-bs-parent="#SectionElements" element-id="$2|">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').fadeOut(300, function(){$(this).fadeOut(300, function(){$(this).remove();});})">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>2 columns</h6>
							<div class="nouirange range-2"></div>
							<div class="templateGrid col-6" element-id="#6;">
								<div class="dragulaContainer"></div>
							</div>
							<div class="templateGrid col-6" element-id="#6;">
								<div class="dragulaContainer"></div>
							</div>
						</div>
					</div>
					<div id="columns" class="accordion-collapse collapse templateElementGrid" data-bs-parent="#SectionElements" element-id="$3|">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').fadeOut(300, function(){$(this).remove();})">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>3 columns</h6>
							<div class="nouirange range-3"></div>
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
					<div id="columns" class="accordion-collapse collapse templateElementGrid" data-bs-parent="#SectionElements" element-id="$4|">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').fadeOut(300, function(){$(this).remove();})">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>4 columns</h6>
							<div class="nouirange range-4"></div>
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
					<div id="columns" class="accordion-collapse collapse templateElementGrid" data-bs-parent="#SectionElements" element-id="$5|">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').fadeOut(300, function(){$(this).remove();})">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>5 columns</h6>
							<div class="nouirange range-5"></div>
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
					<div id="columns" class="accordion-collapse collapse templateElementGrid" data-bs-parent="#SectionElements" element-id="$6|">
						<div class="accordion-body row position-relative">
							<div class="templateElementMenu">
								<a onclick="$(this).closest('.templateElement, .templateElementGrid').fadeOut(300, function(){$(this).remove();})">
									<i class="fas fa-trash-alt"></i>
								</a>
							</div>
							<h6>6 columns</h6>
							<div class="nouirange range-6"></div>
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
						$type = null; $elementCategories = array('columns');
						if(mysqli_num_rows($query) > 0) {
							while($row = mysqli_fetch_array($query)) {
								$sections[$row['id']] = $row;
								if($type != $row['section_type']) print('
									</div>
									<div class="accordion-item container row dragulaCopy templateElements cat-'.$row['section_type'].'">
										<h2 class="accordion-header p-0 dragulaDisabled">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#'.$row['section_type'].'" aria-controls="'.$row['section_type'].'">
												<h5>'.ucwords($row['section_type']).'</h5>
											</button>
										</h2>
								');
								print('
										<div id="'.$row['section_type'].'" class="accordion-collapse collapse templateElement" element-id="'.$row['id'].'" data-bs-parent="#SectionElements">
											<div class="accordion-body row position-relative">
												<div class="templateElementMenu">
													<a onclick="$(this).closest(\'.templateElement, .templateElementGrid\').fadeOut(300, function(){$(this).remove();})">
														<i class="fas fa-trash-alt"></i>
													</a>
												</div>
												<h6>'.$row['short_description'].'</h6>
												<input type="text" value="" placeholder="'.$row['extention_hint'].'">
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
		<div class="col-lg-9 templateBase dragulaContainer"></div>
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
	$(document).ready(() => {
		website.layout.initializeOxygen();
		dragula(
			[
				document.querySelector('.templateGrid'),
				document.querySelector('.templateBase'),
				document.querySelector('.dragulaContainer'),
				<?foreach($elementCategories as $elementCategory) {print("document.querySelector('.templateElements.cat-$elementCategory'),
				");}?>
			], {
				isContainer: function (el) {
					return $(el).hasClass('dragulaContainer');
				},
				moves: function (el, source, handle, sibling) {
					return true;
				},
				copy: function(el, source) {
					return el.parentNode.classList.contains('dragulaCopy');
				},
				accepts: function (el, target, source, sibling) {
					return true;
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
			}
		).on('drop', function(el, target, source, sibling) {
			$(el).removeClass('accordion-collapse collapse show').removeAttr('data-bs-parent id').children().each(function() {
				$(this).removeClass('accordion-body');
			});
		});
		elements = null;
		elements = document.querySelectorAll('.range-5');
		elemenents.each(function() {
			noUiSlider.create(this, {
				start: [2, 4, 8, 10],
				connect: [false, false, false, false, false],
				range: {
					'min': [0],
					'max': [12]
				}
			});
		})
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