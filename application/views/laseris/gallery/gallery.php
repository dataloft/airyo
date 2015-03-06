<?$this->load->view('laseris/common/header')?>

<? if(!empty($albums)) : ?>
	
	<? foreach($albums as $album) : ?>
		
	<div class="album" id="album<?=$album->id?>">
	
		<h2><?=$album->title; ?></h2>
		<p><?=$album->description; ?></p>
		
		<? if(!empty($images[$album->id])) : ?>
		<? foreach($images[$album->id] as $image) : ?>

			<div class="image-thumb">
				<a name="album<?=$album->id?>" href="/<?=$home_folder; ?>/<?=$album->label; ?>/<?=$image->label; ?>" title="<?=$image->description;?>">
					<img src="/<?=$home_folder; ?>/<?=$album->label; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
				</a>
			</div>
		
		<? endforeach; ?>
		<? endif ?>
		
	</div>
	<div style="clear: both; height: 20px;"></div>
	
	<? endforeach; ?>

<? endif ?>

<script>

$(document).ready(function(){

<?

//$album_string = '';

if(!empty($albums)) {
	foreach($albums as $album) {
		//$album_string .= '#album'.$album->id.',';
		
		echo "
			$('#album".$album->id."').magnificPopup({
				delegate: 'a[name=album".$album->id."]', 
				type: 'image',
				gallery:{enabled:true}
			});
		";
		
	}
	//$album_string = rtrim($album_string, ",");
}
?>
	
});

</script>

<?$this->load->view('laseris/common/footer')?>