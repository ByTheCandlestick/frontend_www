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
				<div class="accordion-item container row">
					<?
						$query = DB_Query("SELECT * FROM `page_sections` ORDER BY `section_type`");
						$type = null;
						if(mysqli_num_rows($query) > 0) {
							while ($row = mysqli_fetch_array($query)) {
								$sections[$row['id']] = $row;
								if($type != null && $type != $row['section_type']) {
									print('
										</div>
										<div class="accordion-item container row">
											<h2 class="accordion-header p-0" id="headingOne">
												<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#'.$row['section_type'].'" aria-expanded="true" aria-controls="'.$row['section_type'].'">
													'.$row['section_type'].'
												</button>
											</h2>
									');
								}
								print('
									<div id="'.$row['section_type'].'" class="accordion-collapse collapse col-12 col-md-5 element" aria-labelledby="headingOne" data-bs-parent="#SectionElements">
										<div class="accordion-body">
											'.$row['id'].'
											'.$row['short_description'].'
										</div>
									</div>');
								$type = $row['section_type'];
							}
						}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-9 h-100" style="border: 2px solid var(--main-color);border-radius: 15px;">
			<?
				printSectionTemplates($sections, $page['section_ids']);
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
<?
	} else {
?>
<script>
	window.location = "/";
</script>
<?
	}
?>