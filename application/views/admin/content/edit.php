<div class="container">
    <? if ($message) {?>
	<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
	<? } ?>
    <h1 class="page-header">Наполнение<small> / страницы</small></h1>
    <?php echo form_open_multipart("", 'name="edit" method="POST"');?>
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
                    if (!empty($page[$param['field_name']]))
                    {
        ?>
                        <input type="hidden" class="form-control" name="<?=$param['field_name']?>_hidden" value="<?=$page[$param['field_name']]?>" >
                        <img src="/<?=$page[$param['field_name']]?>">
                        <input type="checkbox" name="<?=$param['field_name']?>_delete" value="1"> Удалить файл
        <?
                    }

                }

                else
                {

        ?>
                    <input type="<?=$param['type']?>" class="form-control" name="<?=$param['field_name']?>" value="<?=$page[$param['field_name']]; ?>" >
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
            <textarea name="content"  class="form-control" placeholder=""><?php echo $page['content']; ?></textarea>
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
            <label for="type" class="control-label">Тип записи</label>
            <select class="form-control" name="type">
                <? foreach ($type_list as $item) { ?>
                    <option value="<?=$item->id?>" <? if ($page['type']==$item->id) echo 'selected'; ?>><?=$item->type?></option>
                <?}?>
            </select>
        </div>
        <div class="form-group <?php if (form_error('title')) echo 'has-error"'; ?>">
            <label for="title" class="control-label">SEO Title</label>
            <input type="text" class="form-control" id="title" value="<? echo $page['title']; ?>" name="title" placeholder="">
        </div>
        <div class="form-group <?php if (form_error('meta_description')) echo 'has-error"'; ?>">
            <label for="meta_description" class="control-label">Meta Description</label>
            <input type="text" class="form-control" id="meta_description" value="<? echo $page['meta_description']; ?>" name="meta_description" placeholder="">
        </div>
        <div class="form-group <?php if (form_error('meta_keywords')) echo 'has-error"'; ?>">
            <label for="meta_keywords" class="control-label">Meta Keywords</label>
            <input type="text" class="form-control" id="meta_keywords" value="<? echo $page['meta_keywords']; ?>" name="meta_keywords" placeholder="">
        </div>
        <div class="checkbox">
            <label>  <input type="checkbox" id="enabled"  value="1" name="enabled" <? if ($page['enabled']) echo 'checked'; ?> > Enabled</label>
        </div>
        <? if (!empty($id)) {?> <input type="hidden" name="id" value="<?=$id?>"><?} else {?><input type="hidden" name="action" value="add"><?}?>
		<button type="submit" class="btn btn-success" style="float: left;">Сохранить</button>

    <?php echo form_close();?>
    <? if (!empty($id)) {?><button type="submit" class="btn btn-warning btn-sm" style="float: right;" id="<?=$id?>" onclick="trash('<?=$id?>');">Удалить</button><?}?>
</div>

<script type="text/javascript"><!--
    function trash (id) {
        //var li = $('#'+id).parent();
        //var tr = td.parent();
        if (confirm('Удалить запись?')) {
            $.ajax({
                type: 'post',
                url: '/admin/content/delete',
                dataType: 'json',
                data: {id:id},
                complete: function() {

                },
                success: function(data, status) {
                    if (data.error) {
                        alert('Удалить запись не удалось');
                    }
                    if (data.success) {
                        location.replace('/admin/content');
                    }

                },
                error: function (data,status, error)
                {
                    alert(error);
                }
            });
        }
    }

    //--></script>
