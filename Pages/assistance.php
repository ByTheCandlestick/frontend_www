<style>
.assistanceNav {
	height: calc(100% - 141px);
}
.assistanceNav div {
	overflow-x: hidden;
	overflow-y: scroll;
	height: 100%;
}
.assistanceNav div:nth-child(1) {
	border-right: solid 1px rgba(0,0,0,0.4);
}
.assistanceNav div:nth-child(2) {
	border-right: solid 1px rgba(0,0,0,0.4);
	box-shadow: inset 7px 0px 9px -12px rgb(0 0 0);
}
.assistanceNav div:nth-child(3) {
	border-right: solid 1px rgba(0,0,0,0.4);
	box-shadow: inset 7px 0px 9px -12px rgb(0 0 0);
}
.assistanceNav div:nth-child(4) {
	box-shadow: inset 7px 0px 9px -12px rgb(0 0 0);
}
.assistanceNav div li {
	list-style-type: none;
}
</style>
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Assistance</h1>
			<p>What would you like help with?</p>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row assistanceNav">
		<div name="lv1" class="col-12 col-md-4 col-lg-4 col-xl-2"></div>
		<div name="lv2" class="col-12 col-md-4 col-lg-4 col-xl-2"></div>
		<div name="lv3" class="col-12 col-md-4 col-lg-4 col-xl-3"></div>
		<div name="lv4" class="col-12 col-md-12 col-lg-12 col-xl-5"></div>
	</div>
</section>