<?php
/**
 * Created by PhpStorm.
 * User: N.Kulchinskiy
 * Date: 07.10.14
 * Time: 22:30
 */
?>
<div class="container">
	<h1 class="page-header">Галерея</h1>

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
				<div class="col-lg-3 col-md-4 col-xs-6 thumb">
					<a class="thumbnail next" href="/gallery/<?=$album->label; ?>/<?=$image->label; ?>" data-toggle="lightbox" data-gallery="multiimages" data-footer="<?=$image->description; ?>" data-title="<?=$image->title; ?>">
						<img class="img-responsive" src="/gallery/<?=$album->label; ?>/<?=$image->label; ?>" alt="" class="img-responsive" />
					</a>
				</div>
			<?php endforeach; ?>
		<?php endif ?>
	</div>
	<div class="text-center">
		<?=$pagination->create_links(); ?>
	</div>
</div>