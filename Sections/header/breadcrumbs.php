<div class="functionalities overflow-hidden">
	<ul id="breadcrumb" class="breadcrumb">
		<li></li>
		<li><a href="/"><i class="fad fa-home"></i></a></li>
		<?
			if(QS_PAGE!=null) print(sprintf("<li><a href=\"/%s\">%s</a></li>", QS_PAGE, QS_PAGE));
			if(QS_SUBPAGE!=null) print(sprintf("<li><a href=\"/%s/%s\">%s</a></li>", QS_PAGE, QS_SUBPAGE, QS_SUBPAGE));
			if(QS!=null) print(sprintf("<li><a href=\"/%s/%s/%s\">%s</a></li>", QS_PAGE, QS_SUBPAGE, QS, QS));
		?>
	</ul>
</div>