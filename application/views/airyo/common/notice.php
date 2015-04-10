<? if (@$notice) { ?>
	<div class="alert alert-<?=$notice['type']?>">
		<a class="close" data-dismiss="alert" href="#">&times;</a>
		<? if ($notice['type']=='success') { ?>
			<span class="glyphicon glyphicon-ok"></span>
		<? } ?>
		<?=$notice['text']?>
	</div>
<? } ?>