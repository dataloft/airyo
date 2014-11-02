<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 07.10.14
 * Time: 22:30
 */
?>
<div class="container">
	<h1 class="page-header">Галерея<small> / <a href="/admin/gallery/<?=$album->label; ?>?action=edit">редактирование</a></small></h1>

	<div id="alert-message" class="alert">
		<span id="icon-message-success" class="glyphicon"></span>
		<span id="text-message"></span>
	</div>

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
	<?php if(!empty($album->description)) : ?>
		<div class="starter-template">
			<p class="lead"><?=$album->description; ?></p>
		</div>
	<?php endif; ?>
	<div class="row" id="links">
		<?php if(!empty($images)) : ?>
			<?php foreach($images as $image) : ?>
				<div class="col-lg-3 col-md-4 col-xs-6 thumb">
					<a class="thumbnail next" href="/gallery/<?=$album->label; ?>/<?=$image->label; ?>" data-toggle="lightbox" data-gallery="multiimages" data-parent data-footer="<div class='pull-right'><small>Добавлена
					<?=date('H:i:s d.m.Y', strtotime($image->create_date));?><br/><?=$image->first_name; ?> <?=$image->last_name; ?></small></div><br/><?=$image->description; ?>" data-title="<?=$image->title;?>">
						<img src="/gallery/<?=$album->label; ?>/<?=$image->label; ?>" alt="" class="img-responsive image-gallery" />
					</a>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
                <div class="clearfix"></div>
			<div id="album-empty"><p>В этом альбоме ещё нет фотографий</p></div>
		<?php endif ?>
	</div>
	<div class="text-center">
		<?=$pagination->create_links(); ?>
	</div>
</div>