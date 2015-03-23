<? $this->load->view('airyo/common/header')?>

<div class="container">
    <? if ($message) {?>
        <div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
    <? } ?>
    <h1 class="page-header">Меню</h1>
    
    <ul class="breadcrumb">
		<li>
        <a href="../../menu/<?=$menu_group?>"><?=$bc_menu[$menu_group]['name']?></a>
        </li>
		<li><? echo $menu->name; ?></li>
	</ul>
    
    <?php echo form_open("", 'name="edit" method="POST"');?>
    <div class="form-group <?php if (form_error('name')) echo 'has-error"'; ?>">
        <label for="name" class="control-label">Название пункта меню</label>
        <input type="text" class="form-control" id="name" name="name" value="<? echo $menu->name; ?>" placeholder="" >
    </div>
    <div class="form-group <?php if (form_error('url')) echo 'has-error"'; ?>">
        <label for="url" class="control-label">Ссылка</label>

        <input type="text" class="form-control" id="url" name="url" value="<? echo $menu->url; ?>" placeholder="" >
    </div>
    <div class="form-group <?php if (form_error('level_menu')) echo 'has-error"'; ?>">
        <label for="level_menu" class="control-label">Родительский раздел</label>
        <select class="form-control" name="level_menu">
            <option value="0"></option>
          <?
          echo $lvl_menu;
          ?>
        </select>

    </div>
    <div class="checkbox">
            <label>  <input type="checkbox" id="enabled"  value="1" name="enabled" <? if (@$menu->enabled == 1) echo 'checked="checked"'; ?> > Enabled</label>
        </div>
    <?
     if (!empty($id)) {?> <input type="hidden" name="id" value="<?=$id?>"><?} else {?><input type="hidden" name="action" value="add"><?}?>
    <button type="submit" class="btn btn-success" style="float: left;"><?= $this->lang->line('save')?></button>
    <?php echo form_close();?>
    <? if (!empty($id)) {?>
    	<a href="#" style="float: right;" onclick="trash('<?=$id?>');">Удалить пункт</a>
    <?}?>
</div>

<script type="text/javascript">

    function trash (id) {
        //var li = $('#'+id).parent();
        //var tr = td.parent();
        if (confirm('Удалить запись?')) {
            $.ajax({
                type: 'post',
                url: '/airyo/menu/delete',
                dataType: 'json',
                data: {id:id},
                complete: function() {
                    $("#pos_save").removeAttr("disable");
                },
                success: function(data, status) {
                    if (data.error) {
                        alert('Удалить запись не удалось');
                    }
                    if (data.success) {
                        location.replace('/airyo/menu');
                        /* alert('Удалить запись удалось');
                         //change the background color to red before removing
                         li.css("background-color","#FF3700");
                         li.fadeOut(400, function(){
                         li.remove();*/
                        //  });

                    }

                },
                error: function (data,status, error)
                {
                    alert(error);
                }
            });
        }
    }

</script>

<? $this->load->view('airyo/common/footer')?>