<div class="container">
    <? if ($message) {?>
	<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
	<? } ?>
    <h1 class="page-header">Счетчики</h1>
    <?php echo form_open("", 'name="edit" method="POST"');?>
		
		<div class="form-group <?php if (form_error('counters')) echo 'has-error"'; ?>">
            <label for="counters" class="control-label">Код счетчиков</label>
			<textarea rows="20" id="counters" name="counters" class="form-control" placeholder=""></textarea>
		</div>
		<div class="form-group <?php if (form_error('domains')) echo 'has-error"'; ?>">
			<label for="domains" class="control-label">Домены на которых будет выводиться код счетчиков</label>
			<input type="text" class="form-control" id="domains" name="domains" value="" placeholder="" >
		</div>
		<div class="form-group <?php if (form_error('ip_restrict')) echo 'has-error"'; ?>">
			<label for="ip_restrict" class="control-label">Ограничение для IP</label>
            <input type="text" class="form-control" id="ip_restrict" name="alias" value="" placeholder="" >
		</div>
              
		<button type="submit" class="btn btn-success" style="float: left;">Сохранить</button>

    <?php echo form_close();?>
</div>