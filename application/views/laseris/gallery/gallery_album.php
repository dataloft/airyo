<?

$this->css = '<link rel="stylesheet" href="/themes/laseris/css/magnific-popup.css" />';
$this->js = '<script src="/themes/laseris/js/jquery.magnific-popup.min.js"></script>';

?>

<? if(!empty($images)) : ?>

	<div class="album" id="<?=$album['name']?>">
	
		<? foreach($images as $image) : ?>
		
			<div class="image-thumb">
				<a name="<?=$album['name']?>" href="/<?=$home_folder; ?>/<?=$album['label'] ?>/<?=$image->label; ?>" title="<?=$image->description;?>">
					<img src="/<?=$home_folder; ?>/<?=$album['label']; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
				</a>
			</div>
		
		<? endforeach; ?>
		
	</div>
	
	<script>
	
	$(document).ready(function(){
	<?
	echo "
			$('#".$album['name']."').magnificPopup({
				delegate: 'a[name=".$album['name']."]', 
				type: 'image',
				gallery:{enabled:true}
			});
		";
	?>
	
	});
	
	</script>

<? endif ?>