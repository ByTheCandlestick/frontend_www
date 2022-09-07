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
    top: 50%;
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
    color: white;
    z-index: 1;
    transition: top .5s ease;
    width: 50%;
    transform: translate(-50%, -50%);
}
.imageContainer:hover .title {
  top: 25%;
}
.imageContainer img {
  width: 100%;
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
					<div class="col-6 col-md-4 col-lg-3">
						<div class="imageContainer">
							<img src="%s" alt="" />
							<p class="title">%s</p>
							<div class="overlay"></div>
							<div class="button">
								<a href="#"> Modify </a>
							</div>
						</div>
					</div>
				', $image['location'], $image['alt']));
			}
		?>
	</div>
</section>