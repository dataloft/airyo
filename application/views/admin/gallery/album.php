<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 07.10.14
 * Time: 22:30
 */
?>
<div class="container">
	<h1 class="page-header">Фотоальбомы</h1>

	<div id="alert-message" class="alert">
		<span id="icon-message-success" class="glyphicon"></span>
		<span id="text-message"></span>
	</div>

	<ol class="breadcrumb">
		<li><a href="/admin/gallery">Фотоальбомы</a></li>
		<li><?=$album->title; ?></li>
	</ol>

	<div class="row">
		<div class="col-md-12" style="margin: 0 0 20px">
			<ul class="nav nav-pills pull-right">
				<li>
					<a href='#' id="upload_mage" class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> Добавить изображения</a>
					<input id="fileupload" class="file-upload-link" type="file" name="files[]" data-url="/admin/gallery/uploadimages" multiple />
					<input type="hidden" name="album_label" id="album_label" value="<?=$album->label; ?>" />
				</li>
				<li>
					<a href="/admin/gallery/<?=$album->label; ?>?action=edit"><span class="glyphicon glyphicon-film" style="color: #777"></span> Редактирование альбома</a>
				</li>

			</ul>
		</div>
	</div>

	<div class="col-md-12">
		<br>
		<br>
		<!-- The global progress bar -->
		<div id="progress" class="hidden progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
	</div>

	<?php if(!empty($album->description)) : ?>
		<div class="starter-template">
			<p class="lead"><?=$album->description; ?></p>
		</div>
	<?php endif; ?>

	<div class="row" id="links">
		<form method="POST" action="/admin/gallery/ajaxEditAlbum" id="form-edit-album" style="display: <?=(!empty($images)) ? 'block' : 'none'; ?>">
			<table class="table table-responsive" id="table-edit-album">
				<?php foreach($images as $image) : ?>
					<tr class="image-edit-block">
						<td class="gallery-table-edit" style="padding: 20px;">
							<a class="next" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" data-toggle="lightbox" data-gallery="multiimages" data-parent data-footer="<div class='pull-right'><small>Добавлена
								<?=date('H:i:s d.m.Y', strtotime($image->create_date));?><br/><?=$image->first_name; ?> <?=$image->last_name; ?></small></div><br/><?=$image->description; ?>" data-title="<?=$image->title;?>">
								<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['height']; ?>x<?=$preview_size['width']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
							</a>
						</td>
						<td>
							<div class="form-group input-group-sm">
								<label for="inputName">Название</label>
								<input type="text" value="<?=$image->title; ?>" class="form-control" name="album[title][]" id="inputName" placeholder="Название">
							</div>
							<div class="form-group">
								<label for="inputDescription">Описание</label>
								<textarea class="form-control" name="album[description][]" id="inputDescription" cols="60" rows="5"><?=$image->description; ?></textarea>
							</div>
							<a href="" class="pull-right link-image-remove" data-image="<?=$image->id; ?>">Удалить</a>
							<input type="hidden" name="album[id][]" value="<?=$image->id; ?>" />
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Сохранить изменения</button>
			</div>
		</form>

		<div class="center-block" id="block-empty-album" style="display: <?=(empty($images)) ? 'block' : 'none'; ?>">
			<p>В этом альбоме ещё нет фотографий</p>
		</div>
	</div>
</div>