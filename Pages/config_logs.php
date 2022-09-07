
<section>
	<!-- Section Header -->
	<div class="row">
		<div class="col-12 col-md-6">
			<h1>Logs</h1>
		</div>
		<div class="col-12 col-md-6 text-md-end">
			<div class="input-group" name="logSelector">
				<div class="input-group-prepend">
					<label class="input-group-text" for="LogSelect">Logs</label>
				</div>
				<select id="LogSelect">
					<option >Choose...</option>
					<?
						foreach(getDirContents(__ROOT__, '.log') as $log) {
							printf('<option value="%s">%s</option>', $log['Path'], $log['File']);
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<hr>
	<!-- Section Body -->
	<div class="row overflow-scroll">
		<div name="logData"></div>
	</div>
</section>
<script>
	var logSelector = $('div[name=logSelector]').find('select');
	logSelector.change(() => {
		$.get(logSelector.find("option:selected").val(), function(data) {
			$('div[name=logData]').text(data.replace(/\n/g, "<br />"));
		}, 'text');
	});
</script>