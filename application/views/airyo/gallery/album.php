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
		<li><?=$album->title; ?></li>
	</ol>

	<div class="row">
		<div class="col-md-12" style="margin: 0 0 20px">
			<ul class="nav nav-pills pull-right">
				<li>
					<a href='#' id="upload_mage" class="pull-right"><span class="glyphicon glyphicon-plus" style="color: #777"></span> Добавить изображения</a>
					<input id="fileupload" class="file-upload-link" type="file" name="files[]" data-url="/airyo/gallery/uploadimages" multiple />
					<input type="hidden" name="album_label" id="album_label" value="<?=$album->label; ?>" />
				</li>
				<li>
					<a href="/airyo/gallery/edit/<?=$album->label; ?>"><span class="glyphicon glyphicon-edit" style="color: #777"></span> Редактирование альбома</a>
				</li>
			</ul>
<!--			<?php /*if(!empty($images)) : */?>
				<ul class="nav nav-pills">
					<li>
						<a class="dropdown-toggle checkAllBtn checkAll" data-toggle="dropdown" href="#">
							<span class="glyphicon glyphicon-ok" style="color: #777"></span>&nbsp;&nbsp;Выделить все
						</a>
						<a class="dropdown-toggle uncheckAllBtn uncheckAll hidden" data-toggle="dropdown" href="#">
							<span class="glyphicon glyphicon-ok" style="color: #777"></span>&nbsp;&nbsp;Снять выделение
						</a>
					</li>
				</ul>
			--><?php /*endif; */?>
		</div>
	</div>

	<div class="row">
	<div class="col-md-12">
		<br>
		<br>
		<!-- The global progress bar -->
		<div id="progress" class="hidden progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
	</div>
	</div>

	<?/*php if(!empty($album->description)) : ?>
		<div class="starter-template">
			<p class="lead"><?=$album->description; ?></p>
		</div>
	<?php endif; */?>

	<div class="row" id="links">
	<div class="col-md-12">
		<form method="POST" action="/airyo/gallery/editAlbum" id="form-edit-album" style="display: <?=(!empty($images)) ? 'block' : 'none'; ?>">
			<table class="table table-responsive" id="table-edit-album">
				<?php foreach($images as $image) : ?>
					<tr class="image-edit-block">
						<td class="row-vertical-center">
							<input type="checkbox" class="check" name="selected[]" value="<?=$image->id; ?>" />
						</td>
						<td class="row-vertical-center">
							<a class="next" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" data-toggle="lightbox" data-gallery="multiimages" data-parent data-footer="<?=$image->description; ?>" data-title="<?=$image->title;?>">
								<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
							</a>
						</td>
						<td>
							<div class="form-group input-group-sm">
								<!--label for="inputName">Название</label-->
								<input type="hidden" value="<?=$image->title; ?>" class="form-control" name="album[title][]" id="inputName" placeholder="Название">
							</div>
							<div class="form-group">
								<label for="inputDescription">Описание</label>
								<textarea class="form-control" name="album[description][]" id="inputDescription" cols="60" rows="5"><?=$image->description; ?></textarea>
							</div>
							<input type="hidden" name="album[id][]" value="<?=$image->id; ?>" />
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<div>
				<button type="submit" class="btn btn-success">
					<span class="checkAll">Сохранить</span>
					<span class="uncheckAll hidden">Сохранить и удалить отмеченные</span>
				</button>
			</div>
		</form>

		<div class="center-block" id="block-empty-album" style="display: <?=(empty($images)) ? 'block' : 'none'; ?>">
			<p>В этом альбоме ещё нет фотографий</p>
		</div>
		
		<div class="text-center">
			<?=$pagination->create_links(); ?>
		</div>
		
	</div>
	</div>
	
</div>