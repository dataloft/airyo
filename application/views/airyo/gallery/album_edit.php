<?$this->load->view('airyo/common/header')?>

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
			<input type="text" name="create_date" class="form-control" value="<?=$album->create_date; ?>" maxlength="10" id="create_date" style="width: 10em"/>
		</div>
		
		<button type="submit" class="btn btn-success"><?= $this->lang->line('save')?></button>
		<a href="#" class="link-album-delete" style="float: right;" data-album="<?=$album->id; ?>">Удалить альбом</a>
		
		<input type="hidden" value="<?=$album->id; ?>" name="album_id" />
		<input type="hidden" name="form_edit" value="edit" />
	<?php echo form_close(); ?>

	<?php echo form_open("/airyo/gallery/ajaxRemoveAlbum", 'class="form-album-delete" method="POST" role="form"');?>
		<input type="hidden" value="<?=$album->id; ?>" name="album_id" />
	<?php echo form_close();?>

</div>

<?$this->load->view('airyo/common/footer')?>