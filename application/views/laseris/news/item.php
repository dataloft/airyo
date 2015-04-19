<? 

$this->css = '<link rel="stylesheet" href="/themes/laseris/css/magnific-popup.css" />';
$this->js = '<script src="/themes/laseris/js/jquery.magnific-popup.min.js"></script>';

$this->load->view('laseris/common/header');

?>

<a href="/news/">Вернуться к списку новостей</a>

<article class="inner_article">

<header><h1><?= $page['title']?></h1></header>

<? 
if (!empty($page['img_ext']) 
	&& file_exists($_SERVER['DOCUMENT_ROOT'].'/public/news/'.$page['id'].'_m'.$page['img_ext'])) 
	{
?>

<div class="album" id="<?=$page['alias']?>">
	<div class="image-thumb">
		<a name="<?=$page['alias']?>" href="/public/news/<?= $page['id']?>_m<?= $page['img_ext']?>" title="">
			<img src="/public/news/<?= $page['id']?>_s<?= $page['img_ext']?>" alt="" class="img-responsive image-gallery" />
		</a>
	</div>
</div>

<? 
}
?>

<div><?= $page['content']?></div>

</article>

<script>

$(document).ready(function(){
<?
echo "
		$('#".$page['alias']."').magnificPopup({
			delegate: 'a[name=".$page['alias']."]', 
			type: 'image',
			gallery:{enabled:true}
		});
	";
?>

});

</script>


<? $this->load->view('laseris/common/footer')?>