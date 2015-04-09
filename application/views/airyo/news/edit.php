<? $this->load->view('airyo/common/header')?>

<div class="container">

    <? if ($message) {?>
	<div class="alert alert-<?=$message['type']?>"> <a class="close" data-dismiss="alert" href="#">&times;</a> <? if ($message['type']=='success') {?><span class="glyphicon glyphicon-ok"></span><?}?> <?=$message['text']?></div>
	<? } ?>
	
    <h1 class="page-header"><?= $this->lang->line('module_title_news')?></h1>
    
    <ul class="breadcrumb">
		<li><a href="/airyo/pages/"><?= $this->lang->line('module_title_news')?></a></li>
		<li><? echo $page['title']; ?></li>
	</ul>
    
    <?php echo form_open_multipart("", 'name="edit" method="POST"');?>

    	<div class="form-group">
			<input type="file" class="form-control" name="img">
		<?
		if (!empty($page['img']))
		{ ?>
		    <input type="hidden" class="form-control" name="img_hidden" value="<?=$page['img']?>" >
		    <img src="/<?=$pth?>/<?=$page['img']?>">
		    <input type="checkbox" name="img_delete" value="1"> Удалить файл
		<? } ?>
		</div> 
    
        <div class="form-group <?php if (form_error('title')) echo 'has-error'; ?>">
            <label for="title" class="control-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="<? echo htmlspecialchars($page['title']); ?>" placeholder="" >
        </div>
		<div class="form-group <?php if (form_error('anons')) echo 'has-error'; ?>">
            <label for="anons" class="control-label">Анонс</label>
			<textarea rows="7" id="anons" name="anons" class="form-control" placeholder=""><? echo $page['anons']; ?></textarea>
		</div>
        <div class="form-group <?php if (form_error('content')) echo 'has-error'; ?>">
            <label for="description" class="control-label">Текст новости</label>
			<textarea rows="20" id="content" name="content" class="form-control" placeholder=""><? echo $page['content']; ?></textarea>
		</div>
		<div class="form-group <?php if (form_error('alias')) echo 'has-error'; ?>">
			<label for="alias" class="control-label">Адрес</label>
            <input type="text" class="form-control" id="alias" name="alias" value="<? echo $page['alias']; ?>" placeholder="" >
		</div>
        <div class="checkbox">
            <label><input type="checkbox" id="enabled"  value="1" name="enabled" <? if ($page['enabled']) echo 'checked'; ?> > Enabled</label>
        </div>
        <? if (!empty($id)) {?> <input type="hidden" name="id" value="<?=$id?>"><?} else {?><input type="hidden" name="action" value="add"><?}?>
		<button type="submit" class="btn btn-success" style="float: left;">Сохранить</button>

    <?php echo form_close();?>
    
    <?
    if (!empty($id)) {
    	echo '<a href="#" style="float: right;" onclick="trash('.$id.');">'.$this->lang->line('delete_item_link').'</a>';
    }
    ?>

</div>

<script type="text/javascript">

    function trash (id) {
        //var li = $('#'+id).parent();
        //var tr = td.parent();
        if (confirm('Удалить запись?')) {
            $.ajax({
                type: 'post',
                url: '/airyo/news/delete',
                dataType: 'json',
                data: {id:id},
                complete: function() {

                },
                success: function(data, status) {
                    if (data.error) {
                        alert('Удалить запись не удалось');
                    }
                    if (data.success) {
                        location.replace('/airyo/news');
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