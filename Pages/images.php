<style>
.container {
  position: relative;
  margin-top: 50px;
  width: 500px;
  height: 300px;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0);
  transition: background 0.5s ease;
}

.container:hover .overlay {
  display: block;
  background: rgba(0, 0, 0, .3);
}

img {
  position: absolute;
  width: 500px;
  height: 300px;
  left: 0;
}

.title {
  position: absolute;
  width: 500px;
  left: 0;
  top: 120px;
  font-weight: 700;
  font-size: 30px;
  text-align: center;
  text-transform: uppercase;
  color: white;
  z-index: 1;
  transition: top .5s ease;
}

.container:hover .title {
  top: 90px;
}

.button {
  position: absolute;
  width: 500px;
  left:0;
  top: 180px;
  text-align: center;
  opacity: 0;
  transition: opacity .35s ease;
}

.button a {
  width: 200px;
  padding: 12px 48px;
  text-align: center;
  color: white;
  border: solid 2px white;
  z-index: 1;
}

.container:hover .button {
  opacity: 1;
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
		<div class="col-6 col-md-4 col-lg-3">
			<div class="p-relative">
				<img src="https://images.unsplash.com/photo-1488628075628-e876f502d67a?dpr=1&auto=format&fit=crop&w=1500&h=1000&q=80&cs=tinysrgb&crop=&bg=" alt="" />
				<p class="title">card title</p>
				<div class="overlay"></div>
				<div class="button"><a href="#"> BUTTON </a></div>
			</div>
		</div>
	</div>
</section>