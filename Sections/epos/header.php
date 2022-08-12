<div class="row header">
	<div class="col-3 left">
		User info
	</div>
	<div class="col-6 middle">
		<h5 class="m-0">Candlestick xPOS v<span class="systemVersion">0.1</span></h5>
		<p> All Systems: <span class="systemsStatus">Operational</span></p>
	</div>
	<div class="col-3 right">
		<p>
			<span class="date">00/00/0000</span>
			<span class="time">00:00</span>
		</p>
	</div>
</div>
<script>
	$( document ).ready(function(){
		var interval = setInterval(function(){
			var date = new Date();
			var d = date.getDate();
			var day = (d < 10) ? "0" + d : d;
			var m = date.getMonth() + 1;
			var month = (m < 10) ? "0" + m : m;
			var year = date.getFullYear();
			$('.date').html(day + '/' + month + '/' + year);
			var h = date.getHours();
			var hour = (h < 10) ? "0" + h : h;
			var m = date.getMinutes();
			var minute = (m < 10) ? "0" + m : m;
			$('.time').html(hour + ':' + minute);
		}, 500);
	});
</script>