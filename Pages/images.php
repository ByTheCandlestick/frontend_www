<?
    $images = array();
	$images_per_page = 100;
?><?
	$total_images = mysqli_fetch_row(DB_Query("SELECT COUNT(*) FROM `Images`"))[0];
	$offset = (QS_SUBPAGE !== null)?(intval(QS_SUBPAGE)-1)*$images_per_page :0;
    $q = DB_Query("SELECT * FROM `Images` ORDER BY `ID` ASC LIMIT $images_per_page OFFSET $offset");
	while($image = mysqli_fetch_assoc($q)) { array_push($images, $image); }
?>
<style>
	.imageContainer {
		position: relative;
	}
	.imageContainer .overlay {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0);
		transition: background 0.5s ease;
	}
	.imageContainer:hover .overlay {
		display: block;
		background: rgba(0, 0, 0, .3);
	}
	.imageContainer .button {
		position: absolute;
		top: 75%;
		opacity: 0;
		transition: opacity .35s ease;
		left: 50%;
		transform: translate(-50%, -50%);
	}
	.imageContainer .button a {
		width: 200px;
		padding: 12px 48px;
		text-align: center;
		color: white;
		border: solid 2px white;
		z-index: 1;
	}
	.imageContainer:hover .button {
		opacity: 1;
	}
	.imageContainer .title {
		position: absolute;
		left: 50%;
		top: 50%;
		font-weight: 700;
		font-size: 17px;
		text-align: center;
		text-transform: uppercase;
		text-shadow: 0px 0px 10px black;
		color: white;
		z-index: 1;
		transition: top .5s ease;
		width: 70%;
		transform: translate(-50%, -50%);
	}
	.imageContainer:hover .title {
		top: 25%;
	}
	.imageContainer img {
		width: 100%;
	}
	img#cropperImage {
		height: 50vh;
		transform: translatex(calc(-50%));
		margin-left: 50%;
	}
</style>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Images</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="row">
				<div class="col-12 d-flex justify-content-end align-items-center p-0">
					<a href="javascript:images.upload();" class="btn btn-outline-primary m-1">
						<i class="fa fa-upload"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row">
		<?
			foreach($images as $image) {
				print(sprintf('
					<div class="col-10 offset-1 col-md-3 offset-md-0 col-lg-2">
						<div class="imageContainer" data-slug="%s" data-location="%s" data-name="%s" data-description="%s" data-alt="%s" data-active="%s">
							<img src="%s" alt="%s" />
							<p class="title">%s</p>
							<div class="overlay"></div>
							<div class="button">
								<a href="javascript:images.modify.openModal(\'%s\');"> Modify </a>
							</div>
						</div>
					</div>
				', $image['Slug'], $image['Location'], $image['Name'], $image['Description'], $image['Alt'], $image['Active?'], $image['Location'], $image['Alt'], $image['Name'], $image['Slug']));
			}
		?>
	</div>
</section>
<div class="modal" tabindex="-1" id="imageEditorModal">
	<div class="modal-dialog modal-fullscreen-sm-down modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit image</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body row">
				<div class="col-12 col-md-8 bg-primary">
					<div id="image-editor">
						<canvas></canvas>
					</div>
				</div>
				<div class="col-12 col-md-4 bg-secondary">

				</div>
				<script>
					var imageEditor = new tui.component.ImageEditor('#image-editor canvas', {
						cssMaxWidth: 1000,
						cssMaxHeight: 1000,
					});
					function loadImage() {
						imageEditor.loadImageFromURL('img/sampleImage.jpg', 'My sample image');
					}
				</script>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onClick="images.modify.save();">Save</button>
			</div>
		</div>
	</div>
</div>