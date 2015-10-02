<?

$this->css = '<link rel="stylesheet" href="/themes/startbootstrap/css/magnific-popup.css" />';
$this->js = '<script src="/themes/startbootstrap/js/jquery.magnific-popup.min.js"></script>';

?>

<? $this->load->view('startbootstrap/common/header')?>

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
	
});

</script>

<? $this->load->view('startbootstrap/common/footer')?>