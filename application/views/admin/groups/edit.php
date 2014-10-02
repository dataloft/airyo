<div class="container">
    <?php if ($message) : ?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <?php endif; ?>
    <h1 class="page-header">Группа<small> / редактирование</small></h1>
    <?php echo form_open("", 'name="edit" method="POST" class="form-horizontal"');?>
	    <div class="form-group <?php if (form_error('name')) echo 'has-error"'; ?>">
	        <label for="name" class="col-sm-2 control-label">Название группы</label>
		    <div class="col-sm-6">
	            <input type="text" class="form-control" id="name" name="name" value="<?=$group->name; ?>" placeholder="Название группы">
	        </div>
	    </div>
	    <div class="form-group <?php if (form_error('description')) echo 'has-error"'; ?>">
		    <label for="description" class="col-sm-2 control-label">Описание группы</label>
		    <div class="col-sm-6">
			    <input type="text" class="form-control" id="description" name="description" value="<?=$group->description; ?>" placeholder="Описание группы">
		    </div>
	    </div>
	    <?php if(!empty($id)) : ?>
		    <input type="hidden" name="id" value="<?=$id?>">
	    <?php else : ?>
		    <input type="hidden" name="action" value="add">
	    <?php endif; ?>
		<div class="pull-right">
			<?php if(!empty($id)) : ?>
				<button type="submit" class="btn btn-success">Сохранить</button>
				<a class="btn btn-danger" id="<?=$id?>" onclick="removeGroup('<?=$id; ?>');">Удалить</a>
			<?php else : ?>
				<button type="submit" class="btn btn-success">Добавить</button>
			<?php endif; ?>
			<a href="/admin/groups" class="btn btn-default">Отмена</a>
		</div>
	<?php echo form_close(); ?>
</div>
