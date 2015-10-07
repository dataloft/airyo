<?

$this->css = '<link rel="stylesheet" href="/themes/startbootstrap/css/blueimp-gallery.min.css" />';

$this->js = '<script src="/themes/startbootstrap/js/jquery.blueimp-gallery.min.js"></script>
<script src="/themes/startbootstrap/js/picturefill.min.js"></script>';

?>

<? $this->load->view('startbootstrap/common/header')?>

<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	<div class="slides"></div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
</div>

<!-- Код начала альбомов -->
<div class="container">

<? if(!empty($albums)) : ?>
	
	<? foreach($albums as $album) : ?>
		
		<div class="row">
        	<div class="col-lg-12">
				<h1 class="page-header"><?=$album->title; ?>
					<small><?=$album->description; ?></small>
				</h1>
			</div>
	
			<? if(!empty($images[$album->id])) : ?>
			<? foreach($images[$album->id] as $image) : ?>

			<div class="col-md-3 portfolio-item">
				<a title="<?=$image->description;?>" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" data-gallery="album<?=$album->id?>">
					<picture class="pictures-gallery"> 
                         <!--[if IE 9]><video style="display: none;"><![endif]-->
						<source srcset="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_small['width']; ?>x<?=$preview_size_small['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" media="(min-width: 1000px)">
						<source srcset="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_big['width']; ?>x<?=$preview_size_big['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" media="(min-width: 240px) and (max-width:991px)">
                        <!--[if IE 9]></video><![endif]-->
						<img srcset="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_small['width']; ?>x<?=$preview_size_small['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" class="img-responsive" alt="…">
                    </picture>
				</a>
			</div>
	
			<? endforeach; ?>
			<? endif ?>
	
		</div>
	
	<? endforeach; ?>

<? endif ?>

</div>
<!-- Код окончания альбомов -->

<? $this->load->view('startbootstrap/common/footer')?>