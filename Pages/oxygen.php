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
					<a href="javascript:website.saveLayout(<?print(QS)?>);" class="btn btn-outline-primary m-1">
						<i class="fa fa-save"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<br>
	<!-- Section Type -->
	<div class="row" type="sections" style="display: <?($page['display_type']==1)?print("flex"):print("none")?>;">
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
		<div class="col-lg-3 h-100">
			<div class="row container">
				<?
					$query = DB_Query("SELECT * FROM `page_sections` ORDER BY `section_type`");
					$type = "";
					if(mysqli_num_rows($query) > 0) {
						while ($row = mysqli_fetch_array($query)) {
							$type == $row['section_type'] ? print('<h4> '.$row['section_type'].' </h4>') : print(null) ;
							print('<div class="col-12 col-md-5 element">'.$row['short_description'].'</div>');
							$type = $row['section_type'];
						}
					}
				?>
			</div>
		</div>
		<div class="col-lg-9 h-100" style="border: 2px solid var(--main-color);border-radius: 15px;">
			<?
				if($page['display_type']) {
					printSectionTemplates($page['section_ids']);
				} else {
					print("The website is set up to display a page rather than sections - Unable to edit the page.");
				}
			?>
		</div>
	</div>
	<!-- Page Type -->
	<div class="row" type="page" style="display: <?($page['display_type']==1)?print("none"):print("flex")?>;">
		<h5>Site info</h5>
		<div class="col-12 col-md-6 col-lg-3" name="name">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" id="floatingInput" placeholder="<? print(($domain['Name']=='')?'No name was set':'')?>" value="<? print(($domain['Name']=='')?'':$domain['Name'])?>">
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