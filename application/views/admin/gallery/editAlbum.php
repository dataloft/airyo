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
							<button type="submit" class="btn btn-success">Сохранить изменения</button>
						</td>
					</tr>
					</tbody>
				</table>
				<input type="hidden" value="<?=$album->id; ?>" name="album[album_id]" />
			</form>
		</div>
	</div>
</div>