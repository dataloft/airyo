<? $this->load->view('airyo/common/header') ?>

<div class="container">

    <? $this->load->view('airyo/common/notice')?>
	
    <h1 class="page-header"><?= $this->lang->line('module_title')?></h1>
    
    <ul class="breadcrumb">
		<li><a href="/airyo/<?= $main_menu?>/"><?= $this->lang->line('module_title')?></a></li>
		<li><?= @$page['title'] ? $page['title'] : 'Добавление фрагмента' ?></li>
	</ul>
    
    <?php echo form_open_multipart("", 'method="POST"');?>
    	
    	<div class="row">
	    	<div class="col-md-12">
		    	<div class="form-group <? if (form_error('title')) echo 'has-error'; ?>">
		            <label for="name" class="control-label">Название</label>
		            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars(@$page['name']); ?>" placeholder="" >
		        </div>
		        <div class="form-group <? if (form_error('content')) echo 'has-error'; ?>">
		            <label for="description" class="control-label">Наполнение</label>
					<textarea rows="20" id="content" name="content" class="form-control" placeholder=""><?= @$page['content']; ?></textarea>
				</div>
	
		        <? if (!empty($id)) { ?> <input type="hidden" name="id" value="<?=$id?>"><? } else { ?><input type="hidden" name="action" value="add"><? } ?>
				<button type="submit" name="submit" value="submit" class="btn btn-success" style="float: left;">Сохранить</button>
				
			</div> 
		</div> 

    <?php echo form_close();?>

</div>

<script type="text/javascript">

    function trash (id) {
        if (confirm('Удалить запись?')) {
            $.ajax({
                type: 'post',
                url: '/airyo/<?= $main_menu?>/delete',
                dataType: 'json',
                data: {id:id},
                complete: function() {

                },
                success: function(data, status) {
                    if (data.error) {
                        alert('Удалить запись не удалось');
                    }
                    if (data.success) {
                        location.replace('/airyo/<?= $main_menu?>');
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