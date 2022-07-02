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
	border-right: solid 1px var(--more-list-shadow);
}
.assistanceNav div:nth-child(2) {
	border-right: solid 1px var(--more-list-shadow);
	box-shadow: inset 7px 0px 9px -12px var(--main-color);
}
.assistanceNav div:nth-child(3) {
	border-right: solid 1px var(--more-list-shadow);
	box-shadow: inset 7px 0px 9px -12px var(--main-color);
}
.assistanceNav div:nth-child(4) {
	box-shadow: inset 7px 0px 9px -12px var(--main-color);
}
.assistanceNav div li {
	list-style-type: none;
    min-height: 30px;
	background: var(--more-list-bg);
    border-bottom: solid 1px var(--more-list-shadow);
}
.assistanceNav div li:hover {
	background: var(--more-list-bg-hover);
}
.assistanceNav div li.active {
	background: var(--more-list-bg-active);
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