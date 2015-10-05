<?

$this->css = '<link rel="stylesheet" href="/themes/startbootstrap/css/magnific-popup.css" />';

$this->js = '<script src="/themes/startbootstrap/js/jquery.magnific-popup.min.js"></script>
<script src="/themes/startbootstrap/js/picturefill.min.js"></script>';

?>

<? $this->load->view('startbootstrap/common/header')?>

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
				<a name="album<?=$album->id?>" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" title="<?=$image->description;?>">
					<picture class="gallery-img"> 
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
			$('#album".$album->id."').magnificPopup({
				delegate: 'a[name=album".$album->id."]', 
				type: 'image',
				gallery:{enabled:true}
			});
		";
		
	}
}
?>

function imgReplace(imagesrc) {
		$('.img-responsive').each(function () {
			var imgSrc = $( this).attr(imagesrc);
			$( this).parent().css({
				"background": "url(../.." + imgSrc + ") no-repeat center / cover",
				"width": "100%",
				"height": "100%",
				"display": "block"
			});
			$( this).remove();
		});
	}

	if($(window).width() >= 1000){
		imgReplace('srcset');
	}
	else {
		imgReplace('data-src');
	}

	$(window).resize(function(){
		if ($(window).width() >= 1000){
			imgReplace('srcset');
		}
		else {
			imgReplace('data-src');
		}
	});
	
});

</script>

<? $this->load->view('startbootstrap/common/footer')?>