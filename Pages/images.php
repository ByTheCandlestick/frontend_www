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
					<img id="cropperImage" src="images/partners/fizzlux/logo.jpeg">
				</div>
				<div class="col-12 col-md-4 bg-secondary">

				</div>
				<script>
					$(document).ready(function() {
						var image = document.getElementById('cropperImage');
						var cropper = new Cropper(image, {
							// The view mode of the cropper
							viewMode: 0, // 0, 1, 2, 3
							// The dragging mode of the cropper
							dragMode: DRAG_MODE_CROP, // 'crop', 'move' or 'none'
							// The initial aspect ratio of the crop box
							initialAspectRatio: NaN,
							// The aspect ratio of the crop box
							aspectRatio: NaN,
							// An object with the previous cropping result data
							data: null,
							// A selector for adding extra containers to preview
							preview: '',
							// Re-render the cropper when resize the window
							responsive: true,
							// Restore the cropped area after resize the window
							restore: true,
							// Check if the current image is a cross-origin image
							checkCrossOrigin: true,
							// Check the current image's Exif Orientation information
							checkOrientation: true,
							// Show the black modal
							modal: true,
							// Show the dashed lines for guiding
							guides: true,
							// Show the center indicator for guiding
							center: true,
							// Show the white modal to highlight the crop box
							highlight: true,
							// Show the grid background
							background: true,
							// Enable to crop the image automatically when initialize
							autoCrop: true,
							// Define the percentage of automatic cropping area when initializes
							autoCropArea: 0.8,
							// Enable to move the image
							movable: true,
							// Enable to rotate the image
							rotatable: true,
							// Enable to scale the image
							scalable: true,
							// Enable to zoom the image
							zoomable: true,
							// Enable to zoom the image by dragging touch
							zoomOnTouch: true,
							// Enable to zoom the image by wheeling mouse
							zoomOnWheel: true,
							// Define zoom ratio when zoom the image by wheeling mouse
							wheelZoomRatio: 0.1,
							// Enable to move the crop box
							cropBoxMovable: true,
							// Enable to resize the crop box
							cropBoxResizable: true,
							// Toggle drag mode between "crop" and "move" when click twice on the cropper
							toggleDragModeOnDblclick: true,
							// Size limitation
							minCanvasWidth: 0,
							minCanvasHeight: 0,
							minCropBoxWidth: 0,
							minCropBoxHeight: 0,
							minContainerWidth: 200,
							minContainerHeight: 100,
							// Shortcuts of events
							ready: null,
							cropstart: null,
							cropmove: null,
							cropend: null,
							crop: null,
							zoom: null
						});
					});
				</script>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onClick="images.modify.save();">Save</button>
			</div>
		</div>
	</div>
</div>