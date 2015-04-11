<?

$this->css .= '
	<link href="/themes/airyo/css/datepicker/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
	';

$this->js = '
	<script src="/themes/airyo/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="/themes/airyo/js/datepicker/locales/bootstrap-datepicker.ru.js" type="text/javascript"></script>
	';
	
$this->js .= "
	<script type='text/javascript'>
	    
    $(function() {
        
        $('#date').datepicker({
        	format: 'dd.mm.yyyy',
        	language: 'ru'
        });
           
    });
	    
	</script>
	";

$this->load->view('airyo/common/header')

?>

<div class="container">

    <? $this->load->view('airyo/common/notice')?>
	
    <h1 class="page-header"><?= $this->lang->line('module_title_news')?></h1>
    
    <ul class="breadcrumb">
		<li><a href="/airyo/news/"><?= $this->lang->line('module_title_news')?></a></li>
		<li><?= @$page['title'] ? $page['title'] : 'Добавление новости' ?></li>
	</ul>
    
    <?php echo form_open_multipart("", 'method="POST"');?>
    	
    	<div class="row">
    	<div class="col-md-8">
    		<div class="form-group<? if (form_error('date')) echo ' has-error'; ?>">
				<label for="date">Дата публикации (дд.мм.гггг)</label>
				<input type="text" name="date" class="form-control" value="<?= @$page['date'] ?>" maxlength="10" id="date" />
			</div>
	    	<div class="form-group <? if (form_error('title')) echo 'has-error'; ?>">
	            <label for="title" class="control-label">Заголовок</label>
	            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars(@$page['title']); ?>" placeholder="" >
	        </div>
			<div class="form-group <? if (form_error('anons')) echo 'has-error'; ?>">
	            <label for="anons" class="control-label">Анонс</label>
				<textarea rows="7" id="anons" name="anons" class="form-control" placeholder=""><?= @$page['anons']; ?></textarea>
			</div>
		</div>
    	<div class="col-md-4">
	    	<div class="form-group">
	    		<label for="title" class="control-label">Картинка</label>
				<?
				if (!empty($thumbs['_s']))
				{ ?>
				    <div class="form-group">
				    	<img src="/public/news/<?= $thumbs['_s']['name']?>?<?= mt_rand()?>" width="<?= $thumbs['_s']['prop'][0]?>" height="<?= $thumbs['_s']['prop'][1]?>" class="img-thumbnail"><br>
				    	<input type="checkbox" id="img_delete" name="img_delete" value="1"> <label for="img_delete" class="control-label">Удалить картинку</label>
				    </div>
				<? } ?>
				<input type="file" name="img">
			</div> 
		</div>
		</div> 
		
		<div class="row">
	        <div class="col-md-12">
		        <div class="form-group <? if (form_error('content')) echo 'has-error'; ?>">
		            <label for="description" class="control-label">Текст новости</label>
					<textarea rows="20" id="content" name="content" class="form-control" placeholder=""><?= @$page['content']; ?></textarea>
				</div>
				<div class="form-group <? if (form_error('alias')) echo 'has-error'; ?>">
					<label for="alias" class="control-label">Адрес</label>
		            <input type="text" class="form-control" id="alias" name="alias" value="<?= @$page['alias']; ?>" placeholder="" >
				</div>
		        <div class="checkbox">
		            <label><input type="checkbox" id="enabled"  value="1" name="enabled" <? if (@$page['enabled']) echo 'checked'; ?> > Enabled</label>
		        </div>
		        <? if (!empty($id)) { ?> <input type="hidden" name="id" value="<?=$id?>"><? } else { ?><input type="hidden" name="action" value="add"><? } ?>
				<button type="submit" name="submit" value="submit" class="btn btn-success" style="float: left;">Сохранить</button>
				
				<?
			    if (!empty($page['id'])) {
			    	echo '<a href="#" style="float: right;" onclick="trash('.$page['id'].');">'.$this->lang->line('delete_item_link').'</a>';
			    }
			    ?>
				
			</div>
		</div> 

    <?php echo form_close();?>

</div>

<script type="text/javascript">

    function trash (id) {
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