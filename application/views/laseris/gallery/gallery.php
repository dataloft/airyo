<? if(!empty($albums)) : ?>
	<ul class="list-group">
		<? foreach($albums as $album) : ?>
			<h1><?=$album->title; ?></h1>
			<p><?=$album->description; ?></p>
			
			<? if(!empty($images[$album->id])) : ?>
			<? foreach($images[$album->id] as $image) : ?>

				<a class="next" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" data-toggle="lightbox" data-gallery="multiimages" data-parent data-footer="<?=$image->description; ?>" data-title="<?=$image->title;?>">
					<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
				</a>
			
			<? endforeach; ?>
			<? endif ?>
			
		<? endforeach; ?>
	</ul>
<? endif ?>