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
		background: -webkit-linear-gradient(45deg, rgba(0, 0, 0, 0.0980392) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.0980392) 75%, rgba(0, 0, 0, 0.0980392) 0), -webkit-linear-gradient(45deg, rgba(0, 0, 0, 0.0980392) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.0980392) 75%, rgba(0, 0, 0, 0.0980392) 0), white;
		background: -moz-linear-gradient(45deg, rgba(0, 0, 0, 0.0980392) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.0980392) 75%, rgba(0, 0, 0, 0.0980392) 0), -moz-linear-gradient(45deg, rgba(0, 0, 0, 0.0980392) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.0980392) 75%, rgba(0, 0, 0, 0.0980392) 0), white;
		background: linear-gradient(45deg, rgba(0, 0, 0, 0.0980392) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.0980392) 75%, rgba(0, 0, 0, 0.0980392) 0), linear-gradient(45deg, rgba(0, 0, 0, 0.0980392) 25%, transparent 25%, transparent 75%, rgba(0, 0, 0, 0.0980392) 75%, rgba(0, 0, 0, 0.0980392) 0), white;
		background-repeat: repeat, repeat;
		background-position: 0px 0, 5px 5px;
		-webkit-transform-origin: 0 0 0;
		transform-origin: 0 0 0;
		-webkit-background-origin: padding-box, padding-box;
		background-origin: padding-box, padding-box;
		-webkit-background-clip: border-box, border-box;
		background-clip: border-box, border-box;
		-webkit-background-size: 10px 10px, 10px 10px;
		background-size: 10px 10px, 10px 10px;
		-webkit-box-shadow: none;
		box-shadow: none;
		text-shadow: none;
		-webkit-transition: none;
		-moz-transition: none;
		-o-transition: none;
		transition: none;
		-webkit-transform: scaleX(1) scaleY(1) scaleZ(1);
		transform: scaleX(1) scaleY(1) scaleZ(1);
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
								<a href="javascript:images.modify.openModal(\'%s\', \'%s\');"> Modify </a>
							</div>
						</div>
					</div>
				', $image['Slug'], $image['Location'], $image['Name'], $image['Description'], $image['Alt'], $image['Active?'], $image['Location'], $image['Alt'], $image['Name'], $image['Slug'], $image['Location']));
			}
		?>
	</div>
</section>
<div class="modal" tabindex="-1" id="imageEditorModal">
	<div class="modal-dialog modal-fullscreen-sm-down modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit image</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="images.modify.closeModal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body row">
				<div class="col-12 col-md-8 bg-primary">
					<img class="cropper-image" src="" style="max-width: 100%;">
				</div>
				<div class="col-12 col-md-4 bg-secondary">
					<div class="form-floating mb-3" name="name">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Name</label>
					</div>
					<div class="form-floating mb-3" name="description">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Description</label>
					</div>
					<div class="form-floating mb-3" name="alt">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Alt</label>
					</div>
					<div class="form-floating mb-3" name="slug">
						<input type="text" class="form-control" id="floatingInput" placeholder="" value="">
						<label for="floatingInput">Slug</label>
					</div>
					<div class="form-check form-switch" name="misc">
						<input class="form-check-input" type="checkbox" value="1" id="flexCheckDisabled" name="active">
						<label class="form-check-label" for="flexCheckDisabled"> Active? </label>
					</div>
				</div>
				<script>
					var $image = $('img.cropper-image');

					$image.cropper({
					aspectRatio: 16 / 9,
					crop: function(event) {
						console.log(event.detail.x);
						console.log(event.detail.y);
						console.log(event.detail.width);
						console.log(event.detail.height);
						console.log(event.detail.rotate);
						console.log(event.detail.scaleX);
						console.log(event.detail.scaleY);
					}
					});

					var cropper = $image.data('cropper');
				</script>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onClick="images.modify.save();">Save</button>
			</div>
		</div>
	</div>
</div>