
	
		
<? if(!empty($images)) : ?>
<div class="album" id="<?=$album['label']?>">
<? foreach($images as $image) : ?>

	<div class="image-thumb">
		<a name="<?=$album['label']?>" href="/<?=$home_folder; ?>/<?=$album['label'] ?>/<?=$image->label; ?>" title="<?=$image->description;?>">
			<img src="/<?=$home_folder; ?>/<?=$album['label']; ?>/thumbs<?=$preview_size['width']; ?>x<?=$preview_size['height']; ?>/thumbs<?=$image->id; ?><?=$preview_extension; ?>" alt="" class="img-responsive image-gallery" />
		</a>
	</div>

<? endforeach; ?>
</div>
<? endif ?>
		



<script>

$(document).ready(function(){
<?

if(!empty($images)) {
	echo "
		$('#".$album['label']."').magnificPopup({
			delegate: 'a[name=".$album['label']."]', 
			type: 'image',
			gallery:{enabled:true}
		});
	";
}
?>
	
});

</script>