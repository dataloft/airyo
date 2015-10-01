<? if (@$notice) { ?>
	<div class="alert alert-<?=$notice['type']?>">
		<a class="close" data-dismiss="alert" href="#">&times;</a>
		<p>
			<? if ($notice['type']=='success') { ?>
				<span class="glyphicon glyphicon-ok"></span>
			<? } ?>
			<?= $notice['text']?>
		</p>
		<?= validation_errors(); ?>
	</div>
<? } ?>