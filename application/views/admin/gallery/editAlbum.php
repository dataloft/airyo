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
	<div class="jumbotron">
		<form role="form">
			<table>
				<tbody>
				<tr>
					<td>
						<img src="/gallery/<?=$album->label; ?>/<?=$album->random_image_label; ?>" class="album-gallery-edit">
					</td>
					<td>
						<div class="form-group">
							<label for="inputName">Название</label>
							<input type="text" value="<?=$album->title; ?>" class="form-control" name="title" id="inputName" placeholder="Название">
						</div>
						<div class="form-group">
							<label for="inputDescription">Описание</label>
							<textarea class="form-control" name="description" id="inputDescription" cols="60" rows="5"><?=$album->description; ?></textarea>
						</div>
						<button type="submit" class="btn btn-info">Сохранить изменения</button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
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
		<?php if(!empty($images)) : ?>
			<?php foreach($images as $image) : ?>
				<div>
					<img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" style="width: 64px; height: 64px;">
				</div>
			<?php endforeach; ?>
		<?php endif ?>
	</div>
</div>