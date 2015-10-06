<?

$this->css = '<link rel="stylesheet" href="/themes/startbootstrap/css/blueimp-gallery.min.css" />';

$this->js = '<script src="/themes/startbootstrap/js/blueimp-gallery.min.js"></script>
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
		
		<div class="row" id="album<?=$album->id?>">
        	<div class="col-lg-12">
				<h1 class="page-header"><?=$album->title; ?>
					<small><?=$album->description; ?></small>
				</h1>
			</div>
	
			<? if(!empty($images[$album->id])) : ?>
			<? foreach($images[$album->id] as $image) : ?>

			<div class="col-md-3 portfolio-item">
				<a name="album<?=$album->id?>" title="Blueimp gallery" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" title="<?=$image->description;?>">
					<picture class="pictures-gallery"> 
						<source srcset="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_small['width']; ?>x<?=$preview_size_small['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" media="(min-width: 1000px)">
						<source srcset="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_big['width']; ?>x<?=$preview_size_big['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" media="(min-width: 240px) and (max-width:991px)">
						<img srcset="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_small['width']; ?>x<?=$preview_size_small['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" data-src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size_big['width']; ?>x<?=$preview_size_big['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" class="img-responsive" alt="…">
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

<script>

$(document).ready(function(){

<?

if(!empty($albums)) {
	foreach($albums as $album) {
		echo "
			document.getElementById('album".$album->id."').onclick = function (event) {
    		event = event || window.event;
    		var target = event.target || event.srcElement,
        	link = target.src ? target.parentNode : target,
        	options = {index: link, event: event},
        	links = this.getElementsByTagName('a');
    		blueimp.Gallery(links, options);
		};
		";
		
	}
}
?>

});

</script>

<? $this->load->view('startbootstrap/common/footer')?>