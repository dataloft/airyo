<?

$this->css .= '
	<link href="/airyo/theme/css/datepicker/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
	';

$this->js = '
	<script src="/airyo/theme/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="/airyo/theme/js/datepicker/locales/bootstrap-datepicker.ru.js" type="text/javascript"></script>
	';
	
$this->js .= "
	<script type='text/javascript'>
	    
    $(function() {
        
        $('#create_date').datepicker({
        	format: 'dd.mm.yyyy',
        	language: 'ru'
        });
           
    });
	    
	</script>
	";
	
$this->load->view('common/header') ?>

<div class="container">
	<h1 class="page-header">Фотоальбомы</h1>

	<?php if (!empty($message)) : ?>
		<div class="alert alert-<?=$message['type']?>">
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php if ($message['type']=='success') : ?>
				<span class="glyphicon glyphicon-ok"></span>
			<?php endif; ?>
			<?=$message['text']?>
		</div>
	<? endif; ?>

	<ol class="breadcrumb">
		<li><a href="/airyo/gallery">Фотоальбомы</a></li>
		<li><a href="/airyo/gallery/<?=$album->label; ?>"><?=$album->title; ?></a></li>
		<li>редактирование</li>
	</ol>

	<?php echo form_open("", 'class="edit-description-album" method="POST" role="form"');?>

		<div class="form-group">
			<label for="inputName">Название</label>
			<input type="text" value="<?=htmlspecialchars($album->title); ?>" class="form-control" name="title" id="inputName" placeholder="Название">
		</div>
		<div class="form-group">
			<label for="inputDescription">Описание</label>
			<textarea class="form-control" name="description" id="inputDescription" cols="60" rows="5"><?=$album->description; ?></textarea>
		</div>
		<div class="form-group">
			<label for="inputDescription">Дата публикации (дд.мм.гггг)</label>
			<input type="text" name="create_date" class="form-control" value="<?=$album->create_date; ?>" maxlength="10" id="create_date" style="width: 20em"/>
		</div>
		
		<div class="form-group">
			<label for="inputDescription">Смарткод</label>
			<input type="text" readonly="true" onclick="this.select()" class="form-control" value="[[Gallery:<?=$album->label; ?>]]" style="width: 20em"/>
		</div>
		
		<button type="submit" class="btn btn-success"><?= $this->lang->line('save')?></button>
		<? if (!empty($album->id)) {?>
			<a href="#" style="float: right;" onclick="trash('<?=$album->id?>');">Удалить альбом</a>
		<?}?>
		
		<input type="hidden" value="<?=$album->id; ?>" name="album_id" />
		<input type="hidden" name="form_edit" value="edit" />
		
	<?php echo form_close(); ?>

</div>

<script type="text/javascript">

		function trash (id) {
			var postData = {"album_id": id};
			if (confirm('Удалить запись?')) {
				$.ajax({
					type: 'post',
					url: '/airyo/gallery/ajaxRemoveAlbum',
					data: postData,
					complete: function() {
						$("#pos_save").removeAttr("disable");

					},
					success: function(data, status) {
							location.replace('/airyo/gallery');
						},
					error: function (data,status, error)
					{
						alert(error);
					}
				});
			}
		}

</script>

<?$this->load->view('common/footer')?>