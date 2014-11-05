<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 07.10.14
 * Time: 22:30
 */
?>
<div class="container">
	<h1 class="page-header">Галерея<small> / <a href="/admin/gallery/<?=$album->label; ?>">просмотр</a></small></h1>

	<div id="alert-message" class="alert">
		<span id="icon-message-success" class="glyphicon"></span>
		<span id="text-message"></span>
	</div>

	<ol class="breadcrumb">
		<li><a href="/admin/gallery">Галерея</a></li>
		<li><?=$album->title; ?></li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-body">
			<form method="POST" action="/admin/gallery/ajaxEditDescriptionAlbum" id="edit-description-album" role="form">
				<table>
					<tbody>
					<tr>
						<td>
							<?php if(!empty($album->random_image_label)) : ?>
								<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$album->random_image_label; ?>" class="img-thumbnail album-gallery-edit">
							<?php else : ?>
								<img class="img-thumbnail album-gallery-edit">
							<?php endif; ?>
							<div class="center-block" style="text-align: center;">
								<a href="#" class="link-album-remove" data-album="<?=$album->id; ?>">Удалить альбом</a>
							</div>
						</td>
						<td>
							<div class="form-group">
								<label for="inputName">Название</label>
								<input type="text" value="<?=$album->title; ?>" class="form-control" name="album[title]" id="inputName" placeholder="Название">
							</div>
							<div class="form-group">
								<label for="inputDescription">Описание</label>
								<textarea class="form-control" name="album[description]" id="inputDescription" cols="60" rows="5"><?=$album->description; ?></textarea>
							</div>
							<button type="submit" class="btn btn-info">Сохранить изменения</button>
						</td>
					</tr>
					</tbody>
				</table>
				<input type="hidden" value="<?=$album->id; ?>" name="album[album_id]" />
			</form>
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
	<div class="row" id="links">
		<h3>Редактирование изображений</h3>

			<form method="POST" action="/admin/gallery/ajaxEditAlbum" id="form-edit-album" style="display: <?=(!empty($images)) ? 'block' : 'none'; ?>">
				<table class="table table-responsive" id="table-edit-album">
					<?php foreach($images as $image) : ?>
						<tr class="image-edit-block">
							<td class="gallery-table-edit" style="padding: 20px;">
								<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" alt="" class="img-responsive image-gallery" />
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
					<button type="submit" class="btn btn-info">Сохранить изменения</button>
				</div>
			</form>

			<div class="center-block" id="block-empty-album" style="display: <?=(empty($images)) ? 'block' : 'none'; ?>">
				<p>В этом альбоме ещё нет фотографий</p>
			</div>
	</div>
</div>