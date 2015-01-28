<div class="container">
    <? if ($message) {?>
	<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
	<? } ?>
    <h1 class="page-header">Страницы</h1>
    
    <ul class="breadcrumb">
		<li><a href="/admin/pages/">Страницы</a></li>
		<li>Новая страница</li>
	</ul>
    
    <?php echo form_open_multipart("", 'name="edit" id="pages" method="POST"');?>
        <div class="form-group <?php if (form_error('template')) echo 'has-error"'; ?>">
            <label for="template" class="control-label">Шаблон записи</label>
            <select class="form-control" id="tpl" name="template">
                <? foreach ($template_list as $i => $item) { ?>
                    <option value="<?=$i?>" <? if ($page['template'] == $i) echo 'selected'; ?>><?=$item['name']?></option>
                <?}?>
            </select>
        </div>
    <?
    if (!empty($fields))
    {
    foreach ($fields as $param)
    {
    ?>
    <div class="form-group <?php if (form_error($param['field_name'])) echo 'has-error"'; ?>">
        <label for="<?=$param['field_name']?>" class="control-label"><?=$param['label']?></label>
        <?
        if ($param['type'] == 'textarea')
        {
            ?>
            <textarea name="<?=$param['field_name']?>" <? if (!empty($param['attributes'])) echo $param['attributes'];?> class="form-control" placeholder=""><?=$page[$param['field_name']]; ?></textarea>
        <?
        }
        elseif($param['type'] == 'file')
        {

            ?>
            <input type="<?=$param['type']?>" class="form-control" name="<?=$param['field_name']?>" >
            <?
        }

        else
        {

            ?>
            <input type="<?=$param['type']?>" class="form-control" name="<?=$param['field_name']?>" value="<?=$page[$param['field_name']]; ?>" <? if (!empty($param['attributes'])) echo $param['attributes'];?>>
        <?
        }

        ?>
    </div>
    <?
    }
    }
    else
    {
        ?>
        <div class="form-group <?php if (form_error('content')) echo 'has-error"'; ?>">
            <label for="description" class="control-label">Html-код страницы</label>
            <textarea rows="20" id="content" name="content" class="form-control" placeholder=""><? echo $page['content']; ?></textarea>
        </div>
    <?}?>

		<div class="form-group <?php if (form_error('h1')) echo 'has-error"'; ?>">
			<label for="h1" class="control-label">Название</label>
			<input type="text" class="form-control" id="h1" name="h1" value="<? echo htmlspecialchars($page['h1']); ?>" placeholder="" >
		</div>
		<div class="form-group <?php if (form_error('alias')) echo 'has-error"'; ?>">
			<label for="alias" class="control-label">Адрес</label>
            <input type="text" class="form-control" id="alias" name="alias" value="<? echo $page['alias']; ?>" placeholder="" >
		</div>
        <div class="form-group <?php if (form_error('type')) echo 'has-error"'; ?>">
            <input type="hidden" name="type" value="<?=$page['type'];?>">
        </div>
        <div class="checkbox">
            <label>  <input type="checkbox" id="enabled"  value="1" name="enabled" <? if ($page['enabled']) echo 'checked'; ?> > Enabled</label>
        </div>
        <input type="hidden" name="change" id="change" value="0">
        <? if (!empty($id)) {?> <input type="hidden" name="id" value="<?=$id?>"><?} else {?><input type="hidden" name="action" value="add"><?}?>
		<button type="submit" class="btn btn-success" style="float: left;">Сохранить</button>

    <?php echo form_close();?>
    
</div>
