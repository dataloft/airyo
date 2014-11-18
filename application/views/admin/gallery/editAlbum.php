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
		<li><a href="/admin/gallery">Фотоальбомы</a></li>
		<li><a href="/admin/gallery/<?=$album->label; ?>"><?=$album->title; ?></a></li>
		<li>редактирование</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-body">
			<?php echo form_open("", 'class="edit-description-album" method="POST" role="form"');?>
				<table>
					<tbody>
					<tr>
						<td>
							<?php if(!empty($album->random_image_id)) : ?>
								<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$album->random_image_id; ?><?=$preview_extension; ?>" alt="" class="img-responsive
								album-gallery-edit" />
							<?php else : ?>
								<img class="img-thumbnail album-gallery-edit no-image">
							<?php endif; ?>
							<div class="center-block" style="text-align: center;">
								<a href="#" class="link-album-remove" data-album="<?=$album->id; ?>">Удалить альбом</a>
							</div>
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
							<button type="submit" class="btn btn-success">Сохранить изменения</button>
						</td>
					</tr>
					</tbody>
				</table>
				<input type="hidden" value="<?=$album->id; ?>" name="album_id" />
				<input type="hidden" name="form_edit" value="edit" />
			<?php echo form_close();?>
		</div>
	</div>
</div>