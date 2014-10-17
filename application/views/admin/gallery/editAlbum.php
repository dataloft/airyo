<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 07.10.14
 * Time: 22:30
 */
?>
<div class="container">
	<h1 class="page-header">Редактирование альбома</h1>

	<?php if ($message) : ?>
		<div class="alert alert-<?=$message['type']?>">
			<a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php if ($message['type']=='success') : ?>
				<span class="glyphicon glyphicon-ok"></span>
			<?php endif; ?>
			<?=$message['text']?>
		</div>
	<? endif; ?>

	<ol class="breadcrumb">
		<li><a href="/admin/gallery">Галерея</a></li>
		<li><?=$album->title; ?></li>
		<li class="un-styled pull-right">
			<a href='#' id="upload_mage" class="pull-right">Добавить изображения</a>
			<input id="fileupload" class="file-upload-link" type="file" name="files[]" data-url="/admin/gallery/uploadimages" multiple />
			<input type="hidden" name="album_label" id="album_label" value="<?=$album->label; ?>" />
		</li>
	</ol>
	<div class="col-md-12">
		<br>
		<br>
		<!-- The global progress bar -->
		<div id="progress" class="hidden progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
	</div>
	<div class="row" id="links">
		<?php if(!empty($images)) : ?>
			<?php foreach($images as $image) : ?>
				<div id="photo_edit_row2180341_342853025" class="photo_edit_row"><div>
						<div class="fl_l photo_edit_thumb">
							<a href="/photo2180341_342853025" ><img class="photo_edit_img" src="http://cs618428.vk.me/v618428341/1e78b/41eHBkH1Sk0.jpg"></a>
						</div>
						<div class="fl_l photo_edit_data">
							<div class="photo_edit_header">
								<div class="fl_l" id="photo_save_result2180341_342853025">Описание</div>
								<div class="fl_l photo_save_progress progress" id="photo_save_progress2180341_342853025"></div>
							</div>
							<textarea class="photo_edit_caption" id="photo_caption2180341_342853025"></textarea>
							<div class="photos_move_block">
								<div class="fl_r progress" id="photo_edit_progress2180341_342853025"></div>
								<a class="fl_r" id="photo_delete_link2180341_342853025">Удалить</a>
								<div  style="cursor: auto">
									<a id="photos_move_link2180341_342853025">Поместить в альбом</a>
								</div>
							</div>
						</div>
						<br class="clear">
					</div></div>
			<?php endforeach; ?>
		<?php endif ?>
	</div>
</div>